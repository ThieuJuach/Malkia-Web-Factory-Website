<?php
/**
 * Malkia Web Factory — shared site configuration.
 * Central place for site-wide constants used across all pages (SEO, base URL,
 * navigation). Keeping this in one file avoids duplication and drift.
 */
declare(strict_types=1);

// Canonical production base URL (no trailing slash). Used for canonical + OG tags.
const SITE_URL   = 'https://malkiafactory.com';
const SITE_NAME  = 'Malkia Web Factory';
const SITE_EMAIL = 'hello@malkiafactory.com';

/**
 * Resolve the absolute URL for the current request path so canonical/OG tags
 * are always correct regardless of how the file is named.
 */
function current_url(string $path): string {
    return SITE_URL . '/' . ltrim($path, '/');
}
