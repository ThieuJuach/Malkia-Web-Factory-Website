<?php
/**
 * Minimal, dependency-free SMTP client (AUTH LOGIN, STARTTLS/SSL).
 * Used because PHP's native mail() is unreliable/restricted on many shared
 * hosts (including Hostinger) — sending via the real mailbox's SMTP
 * credentials is far more likely to actually be delivered.
 */

declare(strict_types=1);

/**
 * Format "Name <email>" for a mail header. The display name is quoted (so
 * commas etc. don't split the address) and RFC 2047-encoded if non-ASCII.
 */
function format_address(string $email, string $name = ''): string {
    if ($name === '') {
        return $email;
    }
    if (preg_match('/[^\x20-\x7E]/', $name)) {
        // Encode the whole name (mb_encode_mimeheader leaves ASCII runs like
        // "Smith, " bare, which would split the address). 10-char chunks keep
        // each encoded word under RFC 2047's 75-char limit.
        $words = array_map(
            fn($chunk) => '=?UTF-8?B?' . base64_encode($chunk) . '?=',
            mb_str_split($name, 10, 'UTF-8')
        );
        $name = implode("\r\n ", $words);
    } else {
        $name = '"' . addcslashes($name, '"\\') . '"';
    }
    return $name . ' <' . $email . '>';
}

/**
 * Send one plain-text email over SMTP.
 * Returns [bool $sent, string $error] — $error is empty on success.
 */
function smtp_send_mail(
    string $host,
    int $port,
    string $secure,      // 'ssl' (implicit TLS, typically port 465), 'tls' (STARTTLS, typically port 587), or '' (none)
    string $username,
    string $password,
    string $fromEmail,
    string $fromName,
    string $toEmail,
    string $subject,
    string $body,
    string $replyToEmail = '',
    string $replyToName = ''
): array {
    $timeout = 15;
    $transport = $secure === 'ssl' ? 'ssl://' : '';

    $socket = @stream_socket_client($transport . $host . ':' . $port, $errno, $errstr, $timeout);
    if (!$socket) {
        return [false, "Connection failed: {$errstr} ({$errno})"];
    }
    stream_set_timeout($socket, $timeout);

    $readResponse = function () use ($socket): string {
        $data = '';
        while (($line = fgets($socket, 515)) !== false) {
            $data .= $line;
            // Multi-line SMTP responses use "250-..."; the final line has a space in position 4.
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }
        return $data;
    };

    $sendCommand = function (string $cmd, string $expectedCode) use ($socket, $readResponse): ?string {
        if ($cmd !== '') {
            fwrite($socket, $cmd . "\r\n");
        }
        $resp = $readResponse();
        if (substr($resp, 0, 3) !== $expectedCode) {
            return null;
        }
        return $resp;
    };

    $fail = function (string $message) use ($socket): array {
        fclose($socket);
        return [false, $message];
    };

    $banner = $readResponse();
    if (substr($banner, 0, 3) !== '220') {
        return $fail('No SMTP banner from server.');
    }

    // Identify as the sender's domain; "localhost" raises spam scores.
    $heloHost = substr(strrchr($fromEmail, '@') ?: '@localhost', 1);
    if ($sendCommand('EHLO ' . $heloHost, '250') === null) {
        return $fail('EHLO rejected.');
    }

    if ($secure === 'tls') {
        if ($sendCommand('STARTTLS', '220') === null) {
            return $fail('STARTTLS rejected.');
        }
        if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
            return $fail('TLS negotiation failed.');
        }
        if ($sendCommand('EHLO ' . $heloHost, '250') === null) {
            return $fail('EHLO after STARTTLS rejected.');
        }
    }

    if ($username !== '') {
        if ($sendCommand('AUTH LOGIN', '334') === null) {
            return $fail('AUTH LOGIN not accepted.');
        }
        if ($sendCommand(base64_encode($username), '334') === null) {
            return $fail('SMTP username rejected.');
        }
        if ($sendCommand(base64_encode($password), '235') === null) {
            return $fail('SMTP authentication failed (check username/password).');
        }
    }

    if ($sendCommand('MAIL FROM:<' . $fromEmail . '>', '250') === null) {
        return $fail('MAIL FROM rejected.');
    }
    if ($sendCommand('RCPT TO:<' . $toEmail . '>', '250') === null) {
        return $fail('RCPT TO rejected.');
    }
    if ($sendCommand('DATA', '354') === null) {
        return $fail('DATA command rejected.');
    }

    $headers   = [];
    $headers[] = 'From: ' . format_address($fromEmail, $fromName);
    $headers[] = 'To: <' . $toEmail . '>';
    if ($replyToEmail !== '') {
        $headers[] = 'Reply-To: ' . format_address($replyToEmail, $replyToName);
    }
    $headers[] = 'Subject: ' . mb_encode_mimeheader($subject, 'UTF-8', 'B', "\r\n");
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/plain; charset=utf-8';
    $headers[] = 'Date: ' . date('r');
    $headers[] = 'Message-ID: <' . bin2hex(random_bytes(16)) . '@' . $heloHost . '>';

    // SMTP requires CRLF line endings; many servers reject bare LF. Normalize
    // first, then dot-stuff any line that starts with '.' per RFC 5321.
    $escapedBody = preg_replace("/\r\n|\r|\n/", "\r\n", $body);
    $escapedBody = preg_replace('/^\./m', '..', $escapedBody);

    $payload = implode("\r\n", $headers) . "\r\n\r\n" . $escapedBody . "\r\n.";
    if ($sendCommand($payload, '250') === null) {
        return $fail('Message rejected by server after DATA.');
    }

    fwrite($socket, "QUIT\r\n");
    fclose($socket);
    return [true, ''];
}
