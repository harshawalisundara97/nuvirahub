<?php
/**
 * Product permalink routing — /product/{slug}/ → template-product.php
 *
 * Registers a rewrite rule that maps the friendly product URL to the
 * "product" WordPress page (which carries template-product.php). The
 * matched slug is exposed via get_query_var('nv_product').
 *
 * Rewrites are flushed once when the theme version bumps — see the
 * NUVIRAHUB_REWRITE_VERSION marker below.
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'NUVIRAHUB_REWRITE_VERSION' ) ) {
	define( 'NUVIRAHUB_REWRITE_VERSION', '1.0.0' );
}

add_action( 'init', function () {
	add_rewrite_tag( '%nv_product%', '([^&]+)' );
	add_rewrite_rule(
		'^product/([^/]+)/?$',
		'index.php?pagename=product&nv_product=$matches[1]',
		'top'
	);
} );

// Make WP recognise our custom query var.
add_filter( 'query_vars', function ( $vars ) {
	$vars[] = 'nv_product';
	return $vars;
} );

// Auto-flush rewrites when the version bumps.
add_action( 'init', function () {
	if ( get_option( 'nuvirahub_rewrite_version' ) !== NUVIRAHUB_REWRITE_VERSION ) {
		flush_rewrite_rules( false );
		update_option( 'nuvirahub_rewrite_version', NUVIRAHUB_REWRITE_VERSION );
	}
}, 99 );

/**
 * Return the product slug from the current request, or '' if none.
 *
 * @return string
 */
function nuvirahub_current_product_slug() {
	return (string) get_query_var( 'nv_product' );
}

/**
 * Set up SEO title + meta description for a product permalink.
 */
add_filter( 'document_title_parts', function ( $parts ) {
	$slug = nuvirahub_current_product_slug();
	if ( ! $slug ) {
		return $parts;
	}
	$p = nuvirahub_product( $slug );
	if ( $p ) {
		$parts['title'] = $p['name'] . ' — ' . NUVIRAHUB_SPICE_BRAND;
	}
	return $parts;
} );
