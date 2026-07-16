<?php
/**
 * Chat lead capture — a visitor can optionally leave a name/contact when
 * the AI chat widget hands off to WhatsApp. Stored as a simple, non-public
 * post type so founders can review leads in wp-admin without a CRM.
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the `nv_chat_lead` post type — admin-only list table, no
 * public-facing archive/single views.
 */
function nuvirahub_register_chat_lead_cpt() {
	register_post_type(
		'nv_chat_lead',
		array(
			'label'           => 'Chat Leads',
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'menu_icon'       => 'dashicons-format-chat',
			'supports'        => array( 'title' ),
			'capability_type' => 'post',
		)
	);
}
add_action( 'init', 'nuvirahub_register_chat_lead_cpt' );

/**
 * Add Email/Phone/Message columns to the Chat Leads admin list table so
 * founders can scan leads without opening each one.
 *
 * @param array $columns Existing columns.
 * @return array
 */
function nuvirahub_chat_lead_columns( $columns ) {
	$columns['nv_lead_contact'] = 'Contact';
	$columns['nv_lead_message'] = 'Message';
	return $columns;
}
add_filter( 'manage_nv_chat_lead_posts_columns', 'nuvirahub_chat_lead_columns' );

/**
 * Render the custom Chat Leads admin list columns.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function nuvirahub_chat_lead_column_content( $column, $post_id ) {
	if ( 'nv_lead_contact' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_nv_lead_contact', true ) );
	} elseif ( 'nv_lead_message' === $column ) {
		echo esc_html( wp_trim_words( get_post_meta( $post_id, '_nv_lead_message', true ), 12 ) );
	}
}
add_action( 'manage_nv_chat_lead_posts_custom_column', 'nuvirahub_chat_lead_column_content', 10, 2 );

/**
 * AJAX handler — saves an optional lead left at the WhatsApp handoff
 * moment. Best-effort: the visitor's WhatsApp handoff already succeeded
 * regardless of whether this call succeeds.
 */
function nuvirahub_handle_ai_chat_lead() {
	if ( ! isset( $_POST['nuvirahub_ai_chat_lead_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nuvirahub_ai_chat_lead_nonce'] ) ), 'nuvirahub_ai_chat_lead' ) ) {
		wp_send_json_error( array( 'message' => 'Invalid request.' ), 403 );
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$contact = isset( $_POST['contact'] ) ? sanitize_text_field( wp_unslash( $_POST['contact'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( '' === trim( $contact ) ) {
		wp_send_json_error( array( 'message' => 'Contact required.' ), 400 );
	}

	$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';

	$post_id = wp_insert_post(
		array(
			'post_type'   => 'nv_chat_lead',
			'post_status' => 'publish',
			'post_title'  => '' !== $name ? $name : $contact,
		)
	);

	if ( is_wp_error( $post_id ) || ! $post_id ) {
		wp_send_json_error( array( 'message' => 'Could not save lead.' ), 500 );
	}

	update_post_meta( $post_id, '_nv_lead_contact', $contact );
	update_post_meta( $post_id, '_nv_lead_message', $message );
	update_post_meta( $post_id, '_nv_lead_ip', $ip );

	wp_send_json_success( array( 'saved' => true ) );
}
add_action( 'admin_post_nopriv_nuvirahub_ai_chat_lead', 'nuvirahub_handle_ai_chat_lead' );
add_action( 'admin_post_nuvirahub_ai_chat_lead', 'nuvirahub_handle_ai_chat_lead' );
