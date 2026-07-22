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
	<meta name="theme-color" content="#05080f" id="nv-theme-color">

	<?php /* No-flash theme: apply saved/system preference before CSS paints. */ ?>
	<script>
	(function(){
		try {
			var saved = localStorage.getItem('nv-theme');
			var theme = saved || (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');
			document.documentElement.setAttribute('data-theme', theme);
		} catch (e) {
			document.documentElement.setAttribute('data-theme', 'dark');
		}
	})();
	</script>

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

	<?php if ( NUVIRAHUB_GSC_VERIFICATION ) : ?>
	<meta name="google-site-verification" content="<?php echo esc_attr( NUVIRAHUB_GSC_VERIFICATION ); ?>">
	<?php endif; ?>

	<?php if ( NUVIRAHUB_GA4_ID ) : ?>
	<!-- Google Analytics (GA4) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( NUVIRAHUB_GA4_ID ); ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', <?php echo wp_json_encode( NUVIRAHUB_GA4_ID ); ?>);
	</script>
	<?php endif; ?>

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

	<?php if ( class_exists( 'WooCommerce' ) ) :
		$nv_cart_url  = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' );
		$nv_cart_qty  = ( WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
	?>
	<button class="nv-cart-toggle" id="nv-cart-toggle" type="button" aria-label="Open cart" data-cart-url="<?php echo esc_url( $nv_cart_url ); ?>">
		<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
		<span class="nv-cart-count<?php echo $nv_cart_qty ? ' has-items' : ''; ?>"><?php echo (int) $nv_cart_qty; ?></span>
	</button>
	<?php endif; ?>

	<button class="nv-theme-toggle" id="nv-theme-toggle" type="button" aria-label="Switch between light and dark theme" title="Toggle theme">
		<svg class="nv-icon-sun" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="4.2"/><line x1="12" y1="2.5" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="21.5"/><line x1="2.5" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="21.5" y2="12"/><line x1="5.2" y1="5.2" x2="6.9" y2="6.9"/><line x1="17.1" y1="17.1" x2="18.8" y2="18.8"/><line x1="5.2" y1="18.8" x2="6.9" y2="17.1"/><line x1="17.1" y1="6.9" x2="18.8" y2="5.2"/></svg>
		<svg class="nv-icon-moon" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
	</button>

	<button class="nv-toggle" id="nv-toggle" aria-label="Menu" aria-expanded="false">
		<span></span><span></span><span></span>
	</button>

	<div class="nv-menu-panel" id="nv-menu-panel">
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
	</div>
</nav>
