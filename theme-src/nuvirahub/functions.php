<?php
/**
 * Nuvirahub theme functions.
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'nuvirahub_setup' ) ) {
	/**
	 * Theme setup.
	 */
	function nuvirahub_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
		);
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 60,
				'width'       => 200,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'nuvirahub' ),
				'footer'  => __( 'Footer Menu', 'nuvirahub' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'nuvirahub_setup' );

/**
 * Version-safe replacement for the deprecated get_page_by_title().
 * Returns a WP_Post or null.
 *
 * @param string $title Page title to find.
 * @return WP_Post|null
 */
function nuvirahub_get_page_by_title( $title ) {
	$query = new WP_Query(
		array(
			'post_type'              => 'page',
			'title'                  => $title,
			'post_status'            => 'publish',
			'posts_per_page'         => 1,
			'no_found_rows'          => true,
			'ignore_sticky_posts'    => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
		)
	);
	return ! empty( $query->posts ) ? $query->posts[0] : null;
}

/**
 * Enqueue styles and scripts.
 */
function nuvirahub_assets() {
	wp_enqueue_style(
		'nuvirahub-fonts',
		'https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'nuvirahub-style', get_stylesheet_uri(), array( 'nuvirahub-fonts' ), '3.0.0' );
	wp_enqueue_script( 'nuvirahub-main', get_template_directory_uri() . '/assets/main.js', array(), '3.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'nuvirahub_assets' );

/**
 * Content width.
 */
function nuvirahub_content_width() {
	$GLOBALS['content_width'] = 1100;
}
add_action( 'after_setup_theme', 'nuvirahub_content_width', 0 );

/**
 * Fallback menu when no menu has been assigned to the "primary" location.
 */
function nuvirahub_fallback_menu() {
	echo '<ul id="primary-menu" class="nv-links">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li>';
	$pages = array(
		'Services'           => 'services',
		'Startup Launchpad'  => 'startup-launchpad',
		'Logistics'          => 'logistics',
		'ERP Solutions'      => 'erp-solutions',
		'Portfolio'          => 'portfolio',
		'About'              => 'about',
		'Blog'               => 'blog',
		'Contact'            => 'contact',
	);
	foreach ( $pages as $title => $slug ) {
		$page = nuvirahub_get_page_by_title( $title );
		$url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
		echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Simple, safe contact form handler.
 * Posts back to admin-post.php; sends an email to the site admin.
 */
function nuvirahub_handle_contact() {
	if ( ! isset( $_POST['nuvirahub_contact_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nuvirahub_contact_nonce'] ) ), 'nuvirahub_contact' ) ) {
		wp_safe_redirect( home_url( '/contact/?sent=error' ) );
		exit;
	}

	$first   = isset( $_POST['nv_first'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_first'] ) ) : '';
	$last    = isset( $_POST['nv_last'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_last'] ) ) : '';
	$email   = isset( $_POST['nv_email'] ) ? sanitize_email( wp_unslash( $_POST['nv_email'] ) ) : '';
	$type    = isset( $_POST['nv_type'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_type'] ) ) : '';
	$budget  = isset( $_POST['nv_budget'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_budget'] ) ) : '';
	$message = isset( $_POST['nv_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['nv_message'] ) ) : '';

	$to      = get_option( 'admin_email' );
	$subject = 'New enquiry from ' . $first . ' ' . $last;
	$body    = "Name: {$first} {$last}\nEmail: {$email}\nProject type: {$type}\nBudget: {$budget}\n\nMessage:\n{$message}";
	$headers = array( 'Reply-To: ' . $email );

	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( home_url( '/contact/?sent=success' ) );
	exit;
}
add_action( 'admin_post_nopriv_nuvirahub_contact', 'nuvirahub_handle_contact' );
add_action( 'admin_post_nuvirahub_contact', 'nuvirahub_handle_contact' );

/**
 * Excerpt length.
 */
function nuvirahub_excerpt_length( $length ) {
	return 22;
}
add_filter( 'excerpt_length', 'nuvirahub_excerpt_length' );

function nuvirahub_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'nuvirahub_excerpt_more' );
