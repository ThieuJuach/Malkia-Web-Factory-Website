<?php
/**
 * Shared <head> partial with full SEO metadata.
 * Expected variables (set before including):
 *   $TITLE     string  — page <title>
 *   $DESC      string  — meta description
 *   $CANONICAL string  — relative path of this page (e.g. "index.php")
 *   $OG_TYPE   string  — optional, defaults to "website"
 *   $JSONLD    string  — optional pre-encoded JSON-LD block
 */
require_once __DIR__ . '/config.php';

$OG_TYPE   = $OG_TYPE   ?? 'website';
$CANONICAL = $CANONICAL ?? 'index.php';
$canonical_url = current_url($CANONICAL);
$og_image      = current_url('assets/logo.png');
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="<?= htmlspecialchars($DESC, ENT_QUOTES) ?>" />
<meta name="author" content="<?= SITE_NAME ?>" />
<meta name="robots" content="index, follow" />
<title><?= htmlspecialchars($TITLE, ENT_QUOTES) ?></title>
<link rel="canonical" href="<?= htmlspecialchars($canonical_url, ENT_QUOTES) ?>" />

<!-- Open Graph -->
<meta property="og:title" content="<?= htmlspecialchars($TITLE, ENT_QUOTES) ?>" />
<meta property="og:description" content="<?= htmlspecialchars($DESC, ENT_QUOTES) ?>" />
<meta property="og:type" content="<?= htmlspecialchars($OG_TYPE, ENT_QUOTES) ?>" />
<meta property="og:url" content="<?= htmlspecialchars($canonical_url, ENT_QUOTES) ?>" />
<meta property="og:site_name" content="<?= SITE_NAME ?>" />
<meta property="og:image" content="<?= htmlspecialchars($og_image, ENT_QUOTES) ?>" />

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?= htmlspecialchars($TITLE, ENT_QUOTES) ?>" />
<meta name="twitter:description" content="<?= htmlspecialchars($DESC, ENT_QUOTES) ?>" />
<meta name="twitter:image" content="<?= htmlspecialchars($og_image, ENT_QUOTES) ?>" />

<!-- Favicons -->
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
<link rel="icon" type="image/png" sizes="512x512" href="assets/favicon.png" />
<link rel="icon" type="image/png" sizes="192x192" href="assets/icon-192.png" />
<link rel="apple-touch-icon" href="assets/apple-touch-icon.png" />

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<link href="css/malkia.css" rel="stylesheet" />
<link href="css/motion.css" rel="stylesheet" />
<?php if (!empty($JSONLD)): ?>
<script type="application/ld+json"><?= $JSONLD ?></script>
<?php endif; ?>
