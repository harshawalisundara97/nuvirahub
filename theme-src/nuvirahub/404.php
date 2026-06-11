<?php
/**
 * Custom 404 — matches the dark glassmorphism theme.
 *
 * @package Nuvirahub
 */

get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );
?>

<section class="nv-404">
	<div class="nv-hero-bg" aria-hidden="true">
		<div class="nv-hero-grid"></div>
		<div class="nv-orb nv-orb1"></div>
		<div class="nv-orb nv-orb2"></div>
	</div>
	<div class="nv-404-content nv-reveal">
		<div class="nv-404-glyph">404</div>
		<h1>This page wandered off.</h1>
		<p>The URL you tried doesn't exist — maybe the link is old, mistyped, or the page moved. Try one of these instead:</p>
		<div class="nv-404-actions">
			<a class="nv-btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">← Back to Home</a>
			<a class="nv-btn-ghost" href="<?php echo esc_url( $contact_url ); ?>">Contact Us</a>
		</div>
	</div>
</section>

<?php get_footer();
