<?php
/**
 * Newsletter signup — the homepage "Stay in the loop" form. Stored as a
 * simple, non-public post type so founders can review/export signups in
 * wp-admin without a mailing-list integration.
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the `nv_newsletter_lead` post type — admin-only list table, no
 * public-facing archive/single views.
 */
function nuvirahub_register_newsletter_cpt() {
	register_post_type(
		'nv_newsletter_lead',
		array(
			'label'           => 'Newsletter Signups',
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'menu_icon'       => 'dashicons-email',
			'supports'        => array( 'title' ),
			'capability_type' => 'post',
		)
	);
}
add_action( 'init', 'nuvirahub_register_newsletter_cpt' );

/**
 * Add a Signed-up column to the Newsletter Signups admin list table.
 *
 * @param array $columns Existing columns.
 * @return array
 */
function nuvirahub_newsletter_columns( $columns ) {
	$columns['nv_newsletter_date'] = 'Signed up';
	return $columns;
}
add_filter( 'manage_nv_newsletter_lead_posts_columns', 'nuvirahub_newsletter_columns' );

/**
 * Render the custom Newsletter Signups admin list column.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function nuvirahub_newsletter_column_content( $column, $post_id ) {
	if ( 'nv_newsletter_date' === $column ) {
		echo esc_html( get_the_date( 'M j, Y', $post_id ) );
	}
}
add_action( 'manage_nv_newsletter_lead_posts_custom_column', 'nuvirahub_newsletter_column_content', 10, 2 );

/**
 * Handle the homepage newsletter signup form submission.
 * Plain server-rendered POST → admin-post.php → redirect back with a
 * ?subscribed=success|error flag, same pattern as the contact form.
 */
function nuvirahub_handle_newsletter() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( array( 'subscribed' ), $back );

	if ( ! isset( $_POST['nuvirahub_newsletter_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nuvirahub_newsletter_nonce'] ) ), 'nuvirahub_newsletter' ) ) {
		wp_safe_redirect( add_query_arg( 'subscribed', 'error', $back ) );
		exit;
	}

	$email = isset( $_POST['nv_newsletter_email'] ) ? sanitize_email( wp_unslash( $_POST['nv_newsletter_email'] ) ) : '';

	if ( '' === $email || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'subscribed', 'error', $back ) );
		exit;
	}

	// Skip inserting an obvious duplicate — same email already on the list.
	$existing = get_page_by_title( $email, OBJECT, 'nv_newsletter_lead' );
	if ( ! $existing ) {
		wp_insert_post(
			array(
				'post_type'   => 'nv_newsletter_lead',
				'post_status' => 'publish',
				'post_title'  => $email,
			)
		);
	}

	wp_safe_redirect( add_query_arg( 'subscribed', 'success', $back ) );
	exit;
}
add_action( 'admin_post_nopriv_nuvirahub_newsletter', 'nuvirahub_handle_newsletter' );
add_action( 'admin_post_nuvirahub_newsletter', 'nuvirahub_handle_newsletter' );
