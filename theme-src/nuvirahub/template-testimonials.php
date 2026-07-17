<?php
/**
 * Template Name: Nuvirahub Testimonials
 *
 * Full grid of every testimonial we've collected, sourced from the same
 * nuvirahub_testimonials() data the homepage carousel uses.
 *
 * @package Nuvirahub
 */

get_header();

$nv_contact = nuvirahub_get_page_by_title( 'Contact' );
$nv_contact_url = $nv_contact ? get_permalink( $nv_contact->ID ) : home_url( '/contact' );
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Honest words from real people</div>
	<h1>What our <span>clients &amp; customers</span> say</h1>
	<p style="font-size:15px;color:var(--muted2);max-width:520px;margin:0 auto">Every testimonial on this page is real — collected across our service pillars, from software clients to spice customers.</p>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-grid-3">
		<?php foreach ( nuvirahub_testimonials() as $t ) : ?>
			<div class="nv-testimonial">
				<p class="nv-testimonial-text"><?php echo esc_html( $t['text'] ); ?></p>
				<div class="nv-testimonial-author">
					<div class="nv-testimonial-avatar"<?php echo $t['avatar_style'] ? ' style="' . esc_attr( $t['avatar_style'] ) . '"' : ''; ?>><?php echo esc_html( $t['initials'] ); ?></div>
					<div>
						<div style="font-size:14px;font-weight:500"><?php echo esc_html( $t['name'] ); ?></div>
						<div style="font-size:11px;color:var(--muted)"><?php echo esc_html( $t['sub'] ); ?></div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<div style="text-align:center;margin-top:56px">
		<p class="nv-sub" style="margin-bottom:20px">Worked with us? We'd love to hear about it.</p>
		<a class="nv-btn-primary" href="<?php echo esc_url( $nv_contact_url ); ?>">Share Your Story</a>
	</div>
</div>

<?php get_footer();
