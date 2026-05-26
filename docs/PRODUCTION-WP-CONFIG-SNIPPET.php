<?php
/**
 * Paste this block into your LIVE wp-config.php on Namecheap,
 * REPLACING the existing `define( 'WP_DEBUG', ... );` line.
 *
 * Keep the original line on your LOCAL wp-config.php — local dev needs debug ON,
 * live needs it OFF.
 *
 * Where: between the DB_COLLATE line and the salt keys block.
 */

/* ====================================================================
 * PRODUCTION SECURITY DEFAULTS — Nuvirahub live site (Namecheap)
 * ==================================================================== */

// Hide all errors from visitors (still logs them to wp-content/debug.log for you).
define( 'WP_DEBUG',         false );
define( 'WP_DEBUG_LOG',     false );
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', '0' );

// Lock the WordPress version + plugin code from being edited via wp-admin
// (an attacker who steals an admin login still can't paste malware via Theme Editor).
define( 'DISALLOW_FILE_EDIT', true );

// Force the dashboard + login over HTTPS once the SSL cert is active.
// IMPORTANT: enable only AFTER you confirm https://nuvirahub.com/wp-admin works.
// define( 'FORCE_SSL_ADMIN', true );

// Limit the number of post revisions WordPress stores (saves database space).
define( 'WP_POST_REVISIONS', 5 );

// Auto-empty trash after 14 days.
define( 'EMPTY_TRASH_DAYS', 14 );

// Set memory limit if your host allows.
define( 'WP_MEMORY_LIMIT',     '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );

/* End production defaults */
