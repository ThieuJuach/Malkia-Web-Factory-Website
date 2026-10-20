# Malkia Web Factory — Website

A static HTML/CSS/JavaScript site (with a PHP contact handler) built on the
Start Bootstrap "Personal" template, restyled with the Malkia Web Factory brand
(navy `#152238` + gold `#d9a441`) and populated with content from
malkiafactory.com.

## Pages
- `index.html` — Landing (hero) + About + Work teaser + CTA
- `resume.html` — What We Do + Process + Pricing + FAQ
- `projects.html` — Our Work (portfolio of built sites)
- `contact.php` — Contact details + project enquiry form
- `contact.php` — Hardened form handler (email + JSON/HTML responses)

## Security (contact.php)
OWASP-aligned controls, all configurable via environment variables (no
hard-coded secrets or API keys):
- **Rate limiting** — rolling-window limiter per client IP (5 / 10 min) and per
  email (3 / 10 min) with graceful `429` + `Retry-After` responses.
- **Strict input validation** — allow-listed fields only (unexpected fields
  rejected), type checks, length limits, and a budget value allow-list.
- **CSRF protection** — same-origin `Origin`/`Referer` enforcement.
- **Header/SMTP injection prevention** and security response headers
  (`X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`, etc.).
- **Honeypot** anti-spam field.

### Environment variables
- `MALKIA_CONTACT_RECIPIENT` — inbox for enquiries (default `hello@malkiafactory.com`)
- `MALKIA_MAIL_FROM` — envelope From address
- `MALKIA_MAIL_SUBJECT` — notification subject line
- `MALKIA_ALLOWED_HOSTS` — comma-separated hostnames allowed to submit the form
- `MALKIA_RATE_DIR` — writable directory for rate-limit counters (default: system temp)
- `MALKIA_SMTP_HOST` / `MALKIA_SMTP_PORT` / `MALKIA_SMTP_SECURE` / `MALKIA_SMTP_USER` /
  `MALKIA_SMTP_PASS` / `MALKIA_SMTP_FROM` — SMTP delivery (see below)

### Email delivery: use SMTP, not just mail()
PHP's native `mail()` is unreliable or outright restricted on many shared
hosts (Hostinger included) — it can return success while silently never
delivering anything, or land everything in spam. `send.php` now tries
**authenticated SMTP first** (via a small built-in client,
`includes/smtp_mailer.php`) and only falls back to `mail()` if SMTP isn't
configured.

To enable it without needing environment-variable support in your hosting
panel, copy `includes/mail-config.example.php` to `includes/mail-config.php`
and fill in your mailbox's SMTP credentials (see comments in that file for
Hostinger-specific settings). **Never commit `mail-config.php`** with real
credentials.

## Assets
- `assets/logo.png` — Malkia logo
- `css/styles.css` — Bootstrap 5 + template styles
- `css/malkia.css` — Brand overrides (colors, buttons, sections)
- `js/scripts.js` — Template script
- `js/contact.js` — AJAX form submission

## Deploy (any PHP host, e.g. Hostinger)
1. Upload the entire `malkia-site/` folder contents to your web root (`public_html`).
2. Open `contact.php` and set `$recipient` to your inbox (default `hello@malkiafactory.com`).
3. Ensure PHP `mail()` is enabled, or wire in SMTP. If delivery fails, the visitor
   is told to email you directly and the submission is logged to
   `contact-submissions.log` one level above `public_html` (not web-accessible).

The contact form works with JavaScript (AJAX, no page reload) and degrades
gracefully to a normal PHP form POST when JS is disabled.

## Local preview
The form's PHP won't run under a plain static server. To test everything:
```
php -S localhost:8000
```
then visit http://localhost:8000
