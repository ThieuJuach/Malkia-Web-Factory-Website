<?php
/**
 * Malkia Web Factory — contact form handler (security-hardened)
 * ---------------------------------------------------------------------------
 * Receives the project enquiry form (contact.php), validates and sanitizes
 * the input, emails it to the studio, and returns JSON (AJAX) or a friendly
 * HTML fallback for no-JS submissions.
 *
 * Security controls (OWASP-aligned):
 *   - Secure configuration via environment variables (no hard-coded secrets).
 *   - Security response headers (nosniff, no-referrer, frame denial, etc.).
 *   - Same-origin (CSRF) enforcement via Origin/Referer validation.
 *   - Rate limiting per client IP AND per submitted email, with graceful 429s.
 *   - Strict, schema-based input validation: allow-listed fields only,
 *     type checks, length limits, and rejection of unexpected fields.
 *   - Output/header sanitization to prevent header (SMTP) injection.
 *   - Honeypot anti-spam field.
 *
 * There are NO third-party API keys in this handler. All deployment-specific
 * values (recipient, allowed origin, SMTP, etc.) are read from environment
 * variables so nothing sensitive is committed to source control.
 * ---------------------------------------------------------------------------
 */

declare(strict_types=1);

// Optional local overrides (SMTP credentials, recipient, etc.) that don't
// require hosting-panel environment-variable support. See
// includes/mail-config.example.php for the template. This file is safe to
// omit; every setting below already has a working default.
$__mail_config = __DIR__ . '/includes/mail-config.php';
if (is_file($__mail_config)) {
    require $__mail_config;
}

// ---- Configuration (environment-driven; safe fallbacks) -----------------
/** Where enquiries are sent. Set MALKIA_CONTACT_RECIPIENT in the environment. */
$recipient       = getenv('MALKIA_CONTACT_RECIPIENT') ?: 'hello@malkiafactory.com';
/** Envelope "From" address used in the outbound mail headers. */
$mail_from       = getenv('MALKIA_MAIL_FROM') ?: 'no-reply@malkiafactory.com';
/** Subject line for studio notifications. */
$subject_line    = getenv('MALKIA_MAIL_SUBJECT') ?: '[Malkia Web Factory] New project enquiry';
/**
 * Comma-separated list of hostnames allowed to POST this form (CSRF guard).
 * Defaults cover local development and the production domain.
 */
$allowed_hosts   = array_filter(array_map('trim', explode(',',
    getenv('MALKIA_ALLOWED_HOSTS') ?: 'malkiafactory.com,www.malkiafactory.com,localhost,127.0.0.1'
)));
/** Directory for rate-limit counters (must be writable). */
$rate_dir        = getenv('MALKIA_RATE_DIR') ?: (sys_get_temp_dir() . '/malkia_rate');

// Rate-limit policy (sensible defaults).
const RATE_WINDOW_SECONDS = 600;  // 10-minute rolling window
const RATE_MAX_PER_IP     = 5;    // max submissions per IP per window
const RATE_MAX_PER_EMAIL  = 3;    // max submissions per email per window

// Field-level validation limits.
const MAX_NAME    = 100;
const MAX_EMAIL   = 255;
const MAX_ORG     = 150;
const MAX_MESSAGE = 5000;

/** Allowed budget values (server-side allow-list, mirrors the <select>). */
const ALLOWED_BUDGETS = [
    '',
    '$300 – $500 (Starter)',
    '$800 – $1,500 (Standard)',
    'Custom (Advanced)',
];

/** Schema: the ONLY fields accepted from the client (plus honeypot "website"). */
const ALLOWED_FIELDS = ['name', 'email', 'organization', 'budget', 'message', 'website'];
// -------------------------------------------------------------------------

// ---- Security response headers ------------------------------------------
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: no-referrer');
header('Cross-Origin-Resource-Policy: same-origin');
header('Cache-Control: no-store');

/** Detect whether the client expects a JSON response (AJAX). */
function wants_json(): bool {
    $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
    $xrw    = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? '';
    return stripos($accept, 'application/json') !== false
        || strtolower($xrw) === 'xmlhttprequest';
}

/** Send a response in the format the client expects, then exit. */
function respond(bool $ok, string $message, int $status = 200, array $extra = []): void {
    http_response_code($status);
    if (wants_json()) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array_merge(['success' => $ok, 'message' => $message], $extra));
    } else {
        header('Content-Type: text/html; charset=utf-8');
        $color = $ok ? '#152238' : '#b00020';
        echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8">'
            . '<meta name="viewport" content="width=device-width, initial-scale=1">'
            . '<title>Malkia Web Factory</title></head><body style="font-family:sans-serif;'
            . 'max-width:640px;margin:80px auto;padding:0 24px;text-align:center;color:#2b3648">'
            . '<h1 style="color:' . $color . '">' . ($ok ? 'Thank you!' : 'Something went wrong')
            . '</h1><p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>'
            . '<p><a href="contact.php" style="color:#d9a441;font-weight:700">&larr; Back to the site</a></p>'
            . '</body></html>';
    }
    exit;
}

/** Best-effort client IP (trusts the first hop only; adjust if behind a proxy). */
function client_ip(): string {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
}

/**
 * Rolling-window rate limiter backed by a small JSON file per key.
 * Returns [allowed(bool), retry_after_seconds(int)].
 */
function rate_check(string $dir, string $key, int $max, int $window): array {
    if (!is_dir($dir)) {
        @mkdir($dir, 0700, true);
    }
    $file = $dir . '/' . hash('sha256', $key) . '.json';
    $now  = time();

    $fp = @fopen($file, 'c+');
    if ($fp === false) {
        // Fail open (availability) but never crash if storage is unavailable.
        return [true, 0];
    }
    flock($fp, LOCK_EX);
    $raw   = stream_get_contents($fp);
    $stamps = $raw ? (json_decode($raw, true) ?: []) : [];
    // Drop timestamps outside the current window.
    $stamps = array_values(array_filter($stamps, fn($t) => is_int($t) && ($now - $t) < $window));

    $allowed = count($stamps) < $max;
    $retry   = 0;
    if ($allowed) {
        $stamps[] = $now;
    } else {
        $retry = $window - ($now - min($stamps));
    }

    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($stamps));
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);

    return [$allowed, max(1, $retry)];
}

// ---- Method enforcement --------------------------------------------------
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Allow: POST');
    respond(false, 'Method not allowed.', 405);
}

// ---- CSRF: same-origin enforcement --------------------------------------
// Require that Origin/Referer (when present) matches an allow-listed host.
// Absent headers are tolerated (some privacy tools strip them) but the
// request is still rate-limited and validated below.
$source_host = '';
if (!empty($_SERVER['HTTP_ORIGIN'])) {
    $source_host = parse_url($_SERVER['HTTP_ORIGIN'], PHP_URL_HOST) ?: '';
} elseif (!empty($_SERVER['HTTP_REFERER'])) {
    $source_host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) ?: '';
}
if ($source_host !== '' && !in_array(strtolower($source_host), array_map('strtolower', $allowed_hosts), true)) {
    respond(false, 'Request blocked: invalid origin.', 403);
}

// ---- Rate limiting (per IP) ---------------------------------------------
[$ip_ok, $ip_retry] = rate_check($rate_dir, 'ip:' . client_ip(), RATE_MAX_PER_IP, RATE_WINDOW_SECONDS);
if (!$ip_ok) {
    header('Retry-After: ' . $ip_retry);
    respond(false, 'Too many requests. Please try again in a few minutes.', 429, ['retryAfter' => $ip_retry]);
}

// ---- Reject unexpected fields (strict schema) ---------------------------
$unexpected = array_diff(array_keys($_POST), ALLOWED_FIELDS);
if (!empty($unexpected)) {
    respond(false, 'Unexpected fields in submission.', 422);
}

// ---- Honeypot: bots fill hidden fields ----------------------------------
if (!empty($_POST['website'] ?? '')) {
    // Pretend success to avoid tipping off bots.
    respond(true, 'Thank you — we will get back to you within 24 hours.');
}

// ---- Collect & normalize input ------------------------------------------
$name         = trim((string)($_POST['name'] ?? ''));
$email        = trim((string)($_POST['email'] ?? ''));
$organization = trim((string)($_POST['organization'] ?? ''));
$budget       = trim((string)($_POST['budget'] ?? ''));
$message      = trim((string)($_POST['message'] ?? ''));

// ---- Strict, schema-based validation ------------------------------------
$errors = [];
if ($name === '' || mb_strlen($name) > MAX_NAME) {
    $errors[] = 'a valid name';
}
if ($email === '' || mb_strlen($email) > MAX_EMAIL || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'a valid email address';
}
if (mb_strlen($organization) > MAX_ORG) {
    $errors[] = 'a shorter organization name';
}
if (!in_array($budget, ALLOWED_BUDGETS, true)) {
    $errors[] = 'a valid budget option';
}
if ($message === '' || mb_strlen($message) > MAX_MESSAGE) {
    $errors[] = 'a project description';
}
if ($errors) {
    respond(false, 'Please provide ' . implode(', ', $errors) . '.', 422);
}

// ---- Rate limiting (per email) ------------------------------------------
[$email_ok, $email_retry] = rate_check($rate_dir, 'email:' . strtolower($email), RATE_MAX_PER_EMAIL, RATE_WINDOW_SECONDS);
if (!$email_ok) {
    header('Retry-After: ' . $email_retry);
    respond(false, 'We already received a message from this email recently. Please try again later.', 429, ['retryAfter' => $email_retry]);
}

// ---- Sanitize values used in mail headers (prevent header injection) ----
$safe_name  = preg_replace('/[\r\n]+/', ' ', $name);
$safe_email = preg_replace('/[\r\n]+/', '', $email);

// Provides format_address() for headers below, plus smtp_send_mail().
require_once __DIR__ . '/includes/smtp_mailer.php';

// ---- Build the email -----------------------------------------------------
$body  = "New project enquiry from the Malkia Web Factory website\n";
$body .= str_repeat('-', 52) . "\n\n";
$body .= "Name:         {$name}\n";
$body .= "Email:        {$email}\n";
$body .= 'Organization: ' . ($organization !== '' ? $organization : '—') . "\n";
$body .= 'Budget:       ' . ($budget !== '' ? $budget : '—') . "\n\n";
$body .= "Message:\n{$message}\n";

$headers  = "From: Malkia Website <{$mail_from}>\r\n";
$headers .= 'Reply-To: ' . format_address($safe_email, $safe_name) . "\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";
$headers .= "MIME-Version: 1.0\r\n";

// ---- Primary delivery: authenticated SMTP -------------------------------
// PHP's native mail() is unreliable/restricted on many shared hosts
// (Hostinger included) and fails silently. If SMTP credentials are
// configured (env vars or includes/mail-config.php), use them first.
$sent       = false;
$smtp_host  = getenv('MALKIA_SMTP_HOST') ?: '';
if ($smtp_host !== '') {
    [$sent, $smtp_error] = smtp_send_mail(
        $smtp_host,
        (int)(getenv('MALKIA_SMTP_PORT') ?: 587),
        strtolower(getenv('MALKIA_SMTP_SECURE') ?: 'tls'),
        getenv('MALKIA_SMTP_USER') ?: '',
        getenv('MALKIA_SMTP_PASS') ?: '',
        // Default to the authenticated mailbox: SMTP servers (Hostinger included)
        // reject a From address the logged-in user doesn't own.
        getenv('MALKIA_SMTP_FROM') ?: (getenv('MALKIA_SMTP_USER') ?: $mail_from),
        'Malkia Website',
        $recipient,
        $subject_line,
        $body,
        $safe_email,
        $safe_name
    );
    if (!$sent) {
        error_log('Malkia contact form SMTP error: ' . $smtp_error);
    }
}

// ---- Fallback delivery: native mail() ------------------------------------
if (!$sent) {
    $sent = @mail($recipient, $subject_line, $body, $headers);
}

if ($sent) {
    respond(true, 'Thank you — your message is on its way. We will reply within 24 hours.');
}

// Delivery failed: keep a copy outside the web root (one level above
// public_html) so the enquiry isn't lost, and tell the visitor the truth.
@file_put_contents(
    dirname(__DIR__) . '/contact-submissions.log',
    '[' . date('c') . "]\n" . $body . "\n\n",
    FILE_APPEND | LOCK_EX
);
error_log('Malkia contact form: all delivery methods failed; submission logged.');
respond(false, 'Sorry, we could not send your message right now. Please email us directly at hello@malkiafactory.com.', 500);
