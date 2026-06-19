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

	// The brand design is full-width — drop WooCommerce's sidebar entirely.
	// (Also stops the get_sidebar() deprecation + default-widget dump on a
	// theme that has no sidebar.php.)
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
} );

/* Products per page on the shop archive. */
add_filter( 'loop_shop_per_page', function () {
	return 12;
} );

/* Show 3 columns in the shop grid. */
add_filter( 'loop_shop_columns', function () {
	return 3;
} );

/**
 * Shop header: product search bar + "Shop by category" tiles.
 * Tiles show on the main Shop page (all categories, even empty ones, so new
 * lines like Samahan/Biscuits/Pharmacy appear before they have products).
 * Search bar shows on the shop and category archives.
 */
add_action( 'woocommerce_before_shop_loop', function () {
	if ( ! function_exists( 'is_shop' ) || ( ! is_shop() && ! is_product_category() ) ) {
		return;
	}

	// Search bar (products only).
	echo '<div class="nv-shop-searchbar">' . get_product_search_form( false ) . '</div>';

	if ( ! is_shop() ) {
		return; // category tiles only on the main Shop landing
	}

	$terms = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
		'exclude'    => array( (int) get_option( 'default_product_cat' ) ),
	) );
	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return;
	}

	$emoji = array(
		'spices'            => '🌶️',
		'herbal-ayurveda'   => '🌿',
		'biscuits-snacks'   => '🍪',
		'health-pharmacy'   => '💊',
		'tea-coffee'        => '☕',
		'beverages'         => '🥤',
		'household-grocery' => '🧺',
	);

	echo '<div class="nv-cat-block"><div class="nv-tag" style="margin-bottom:10px">Shop by category</div>';
	echo '<div class="nv-cat-grid">';
	foreach ( $terms as $t ) {
		$link     = get_term_link( $t );
		$thumb_id = get_term_meta( $t->term_id, 'thumbnail_id', true );
		$img      = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : '';
		$e        = $emoji[ $t->slug ] ?? '📦';
		echo '<a class="nv-cat-tile" href="' . esc_url( $link ) . '">';
		if ( $img ) {
			echo '<div class="nv-cat-thumb" style="background-image:url(\'' . esc_url( $img ) . '\')"></div>';
		} else {
			echo '<div class="nv-cat-thumb nv-cat-thumb-fallback"><span>' . esc_html( $e ) . '</span></div>';
		}
		echo '<div class="nv-cat-info"><h3>' . esc_html( $t->name ) . '</h3>';
		echo '<span>' . (int) $t->count . ' ' . _n( 'product', 'products', (int) $t->count, 'nuvirahub' ) . '</span></div>';
		echo '</a>';
	}
	echo '</div></div>';
	echo '<h2 class="nv-shop-allheading">All products</h2>';
}, 5 );
