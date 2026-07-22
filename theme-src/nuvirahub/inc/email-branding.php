<?php
/**
 * Brand WooCommerce's transactional emails (order confirmations, etc.)
 * to match Nuvirahub — via WooCommerce's own email settings/options rather
 * than overriding the plugin's template files.
 *
 * WooCommerce warns that overriding woocommerce/emails/*.php directly is
 * fragile: "on occasion WooCommerce will need to update template files and
 * you will need to copy the new files to your theme to maintain
 * compatibility." Setting the documented options/filters instead survives
 * WooCommerce updates and still fully brands the header logo, accent
 * color, and footer text on every order email.
 *
 * Runs once (checked via a flag option) so it never fights with manual
 * changes made later in WooCommerce → Settings → Emails.
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function () {
	if ( ! class_exists( 'WooCommerce' ) || get_option( 'nuvirahub_email_branding_applied' ) ) {
		return;
	}

	if ( ! get_option( 'woocommerce_email_from_name' ) ) {
		update_option( 'woocommerce_email_from_name', 'Nuvirahub' );
	}
	if ( ! get_option( 'woocommerce_email_from_address' ) ) {
		update_option( 'woocommerce_email_from_address', 'nuvirahub@gmail.com' );
	}

	// Header logo: the theme's OG image doubles as a clean square/wide logo.
	update_option( 'woocommerce_email_header_image', get_template_directory_uri() . '/assets/favicons/og-image.png' );

	// Brand accent + a light, high-deliverability body (dark HTML emails
	// render inconsistently across clients — keep the site's dark theme
	// on the web, keep transactional email light and legible).
	update_option( 'woocommerce_email_base_color', '#6c63ff' );        // --accent
	update_option( 'woocommerce_email_background_color', '#f5f5f7' );
	update_option( 'woocommerce_email_body_background_color', '#ffffff' );
	update_option( 'woocommerce_email_text_color', '#1a1a2e' );
	update_option( 'woocommerce_email_footer_text_color', '#6b6b80' );

	update_option( 'nuvirahub_email_branding_applied', 1 );
} );

/**
 * Footer text on every WooCommerce email — contact + WhatsApp line.
 */
add_filter( 'woocommerce_email_footer_text', function () {
	return sprintf(
		'%s — 27/2E Pieris Avenue, Kalubowila, Dehiwala, Sri Lanka · %s · WhatsApp: +94 71 672 2599',
		get_bloginfo( 'name' ),
		'nuvirahub@gmail.com'
	);
} );
