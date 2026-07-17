<?php
/**
 * Template Name: Nuvirahub FAQ
 *
 * Site-wide FAQ. Uses native <details>/<summary> for the accordion — no
 * JS needed, accessible by default. Content consolidated from the
 * contact, wholesale, and shipping pages rather than duplicated blindly.
 *
 * @package Nuvirahub
 */

get_header();

$nv_contact  = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $nv_contact ? get_permalink( $nv_contact->ID ) : home_url( '/contact' );

$faqs = nuvirahub_faq_items();
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">FAQ</div>
	<h1>Questions,<br><span>answered</span></h1>
	<p style="font-size:15px;color:var(--muted2);max-width:520px;margin:0 auto">Can't find what you're looking for? Ask our chat assistant (bottom-right) or <a href="<?php echo esc_url( $contact_url ); ?>">message us directly</a>.</p>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-faq-list">
		<?php foreach ( $faqs as $item ) : ?>
			<details class="nv-faq-item">
				<summary class="nv-faq-q"><?php echo esc_html( $item['q'] ); ?><span class="nv-faq-caret"><?php echo nv_icon( 'arrow-right', 16 ); ?></span></summary>
				<div class="nv-faq-a"><p><?php echo wp_kses_post( $item['a'] ); ?></p></div>
			</details>
		<?php endforeach; ?>
	</div>
</div>

<?php get_footer();
