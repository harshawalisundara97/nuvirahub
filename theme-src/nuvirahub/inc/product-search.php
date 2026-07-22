<?php
/**
 * Lightweight AJAX autocomplete for the shop search bar. The plain
 * get_product_search_form() GET-submit search still works untouched —
 * this only adds a live dropdown of suggestions as you type.
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns up to 6 published products matching the query, as JSON:
 * [{ name, url, price_html, image }]
 */
function nuvirahub_handle_product_search_suggest() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		wp_send_json_success( array() );
	}

	if ( nuvirahub_is_rate_limited( 'search_suggest', 30, MINUTE_IN_SECONDS ) ) {
		wp_send_json_success( array() );
	}

	$term = isset( $_GET['term'] ) ? sanitize_text_field( wp_unslash( $_GET['term'] ) ) : '';
	if ( mb_strlen( $term ) < 2 ) {
		wp_send_json_success( array() );
	}

	$products = wc_get_products(
		array(
			'status' => 'publish',
			's'      => $term,
			'limit'  => 6,
		)
	);

	$results = array();
	foreach ( $products as $product ) {
		$image_id  = $product->get_image_id();
		$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : '';
		$results[] = array(
			'name'       => $product->get_name(),
			'url'        => get_permalink( $product->get_id() ),
			'price_html' => wp_strip_all_tags( $product->get_price_html() ),
			'image'      => $image_url,
		);
	}

	wp_send_json_success( $results );
}
add_action( 'admin_post_nopriv_nuvirahub_product_search_suggest', 'nuvirahub_handle_product_search_suggest' );
add_action( 'admin_post_nuvirahub_product_search_suggest', 'nuvirahub_handle_product_search_suggest' );
