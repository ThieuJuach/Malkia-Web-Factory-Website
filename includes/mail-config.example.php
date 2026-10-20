<?php
/**
 * Local mail configuration for send.php.
 *
 * Copy this file to `includes/mail-config.php` (same directory) and fill in
 * real values. That file is loaded automatically if present and lets you set
 * SMTP credentials without needing environment-variable support in your
 * hosting control panel. Never commit `mail-config.php` with real
 * credentials to a public repository.
 *
 * ---- Hostinger setup ----
 * 1. In hPanel, go to Emails and confirm hello@malkiafactory.com exists
 *    (or create a dedicated mailbox, e.g. website@malkiafactory.com).
 * 2. Use that mailbox's SMTP settings below — Hostinger's SMTP host is
 *    typically smtp.hostinger.com, port 587 (STARTTLS) or 465 (SSL).
 * 3. The password is the mailbox's own password (not your hPanel login).
 */

putenv('MALKIA_SMTP_HOST=smtp.hostinger.com');
putenv('MALKIA_SMTP_PORT=587');
putenv('MALKIA_SMTP_SECURE=tls'); // 'tls' for port 587 (STARTTLS), 'ssl' for port 465

putenv('MALKIA_SMTP_USER=hello@malkiafactory.com');
putenv('MALKIA_SMTP_PASS=REPLACE_WITH_MAILBOX_PASSWORD');

// Optional: envelope "From" address (defaults to the SMTP user above; Hostinger
// rejects a From address the authenticated mailbox doesn't own).
// putenv('MALKIA_SMTP_FROM=hello@malkiafactory.com');

// Optional overrides for other send.php settings:
// putenv('MALKIA_CONTACT_RECIPIENT=hello@malkiafactory.com');
// putenv('MALKIA_MAIL_SUBJECT=[Malkia Web Factory] New project enquiry');
