<?php
/**
 * WooCommerce integration (Phase 2).
 *
 * Makes the custom Nuvirahub theme render WooCommerce shop, product, cart,
 * checkout and account screens inside the site shell, styled to match the
 * dark glassmorphism brand. WooCommerce is the source of truth for products,
 * cart, orders and payments from Phase 2 onward.
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Bail out gracefully if WooCommerce isn't active yet. */
add_action( 'after_setup_theme', function () {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 600,
		'single_image_width'    => 900,
		'product_grid'          => array(
			'default_columns' => 3,
			'default_rows'    => 3,
		),
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
} );

/* Replace WooCommerce's default content wrappers with the theme's container. */
add_action( 'init', function () {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

	add_action( 'woocommerce_before_main_content', function () {
		echo '<div class="nv-section nv-woo"><div class="nv-woo-inner">';
	}, 10 );
	add_action( 'woocommerce_after_main_content', function () {
		echo '</div></div>';
	}, 10 );
} );

/* Products per page on the shop archive. */
add_filter( 'loop_shop_per_page', function () {
	return 12;
} );

/* Show 3 columns in the shop grid. */
add_filter( 'loop_shop_columns', function () {
	return 3;
} );
