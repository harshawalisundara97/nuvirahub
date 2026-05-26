<?php
/**
 * Header template.
 *
 * @package Nuvirahub
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#05080f">

	<!-- Favicons (generated from brand/logo.png) -->
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/favicons/favicon-32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/favicons/favicon-16.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/favicons/apple-touch-icon.png">
	<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/favicons/site.webmanifest">

	<?php
	/* -----------------------------------------------------------
	 * Open Graph + Twitter card meta — for pretty link previews
	 * on WhatsApp, LinkedIn, Facebook, X, Slack, etc.
	 * ----------------------------------------------------------- */
	$nv_title = wp_get_document_title();
	if ( is_singular() ) {
		$nv_desc = wp_strip_all_tags( get_the_excerpt() );
		if ( empty( $nv_desc ) ) $nv_desc = get_bloginfo( 'description' );
	} else {
		$nv_desc = 'Nuvirahub — one partner for software, business growth, freight logistics, creative, marketing, ERP and a complete startup launch service in Sri Lanka. Plus Nuvira Spice Co. — Ceylon spices delivered to Latvia.';
	}
	$nv_og_image = get_template_directory_uri() . '/assets/favicons/og-image.png';
	$nv_url = is_singular() ? get_permalink() : home_url( $_SERVER['REQUEST_URI'] ?? '/' );
	?>
	<meta property="og:type" content="<?php echo ( is_front_page() || is_home() || is_archive() ) ? 'website' : 'article'; ?>">
	<meta property="og:site_name" content="Nuvirahub">
	<meta property="og:title" content="<?php echo esc_attr( $nv_title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $nv_desc ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $nv_url ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $nv_og_image ); ?>">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
	<meta property="og:locale" content="en_US">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr( $nv_title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $nv_desc ); ?>">
	<meta name="twitter:image" content="<?php echo esc_url( $nv_og_image ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Page loader — fades out on window.load (see main.js) -->
<div class="nv-loader" id="nv-loader" aria-hidden="true">
	<div class="nv-loader-inner">
		<svg class="nv-loader-ring" viewBox="0 0 60 60" width="60" height="60">
			<circle cx="30" cy="30" r="26" stroke="rgba(108,99,255,.15)" stroke-width="3" fill="none"/>
			<circle class="nv-loader-spin" cx="30" cy="30" r="26" stroke="url(#nv-loader-grad)" stroke-width="3" fill="none" stroke-linecap="round" stroke-dasharray="60 200" />
			<defs>
				<linearGradient id="nv-loader-grad" x1="0" y1="0" x2="1" y2="1">
					<stop offset="0%" stop-color="#a78bfa"/>
					<stop offset="100%" stop-color="#38bdf8"/>
				</linearGradient>
			</defs>
		</svg>
		<div class="nv-loader-label">Nuvirahub</div>
	</div>
</div>

<nav class="nv-nav" id="nv-nav">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nv-logo" aria-label="Nuvirahub home">
		<?php
		if ( has_custom_logo() ) {
			the_custom_logo();
		} else {
			?><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.png' ); ?>" alt="Nuvirahub" width="180"><?php
		}
		?>
	</a>

	<button class="nv-toggle" id="nv-toggle" aria-label="Menu">&#9776;</button>

	<?php
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'nv-links',
			)
		);
	} else {
		nuvirahub_fallback_menu();
	}
	?>

	<?php
	$contact = nuvirahub_get_page_by_title( 'Contact' );
	$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );
	?>
	<a href="<?php echo esc_url( $contact_url ); ?>" class="nv-cta">Get Started</a>
</nav>
