<?php
/**
 * Template Name: Nuvirahub Creative & Design
 *
 * @package Nuvirahub
 */
get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Creative &amp; Design</div>
	<h1>Pixels, polygons,<br><span>and blueprints.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">Two-dimensional brand work, three-dimensional product &amp; interior visualisation, and full architectural drafting — all from one studio that ships on deadline.</p>
	<div style="margin-top:28px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1">
		<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Brief Us</a>
		<a class="nv-btn-ghost" href="#disciplines">See disciplines</a>
	</div>
</div>

<div class="nv-section nv-reveal" id="disciplines">
	<div class="nv-tag">Three disciplines</div>
	<h2 class="nv-title">From logo to load-bearing wall.</h2>
	<div class="nv-grid-3" style="margin-top:32px">
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'pen-tool', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Graphic Design</h4><p style="font-size:13px;color:var(--muted2)">Logos, packaging, print, social creatives, presentation decks. Hand-crafted, on-brand, production-ready files in every format you need.</p></div>
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'box', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">3D Rendering</h4><p style="font-size:13px;color:var(--muted2)">Product visualisation, interior walk-throughs, photoreal exterior shots. Marketing assets long before the physical product exists.</p></div>
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'ruler', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">AutoCAD &amp; House Plans</h4><p style="font-size:13px;color:var(--muted2)">Floor plans, elevations, working drawings. Submission-ready DWG &amp; PDF for residential and small commercial projects.</p></div>
	</div>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-tag">Our process</div>
	<h2 class="nv-title">Brief → concept → polish.</h2>
	<div class="nv-process">
		<div class="nv-step"><div class="nv-step-num">1</div><div class="nv-step-title">Brief</div><div class="nv-step-desc">A 30-min call. We mine your references, audience, deadline.</div></div>
		<div class="nv-step"><div class="nv-step-num">2</div><div class="nv-step-title">Concepts</div><div class="nv-step-desc">2–3 directions. You pick one. We don't show 30 options.</div></div>
		<div class="nv-step"><div class="nv-step-num">3</div><div class="nv-step-title">Refine</div><div class="nv-step-desc">Two rounds of focused revisions. We push back if needed.</div></div>
		<div class="nv-step"><div class="nv-step-num">4</div><div class="nv-step-title">Handover</div><div class="nv-step-desc">Final files in every format. Source files too. They're yours.</div></div>
	</div>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0">
		<div class="nv-tag" style="margin-bottom:12px">Got a brief?</div>
		<h2 class="nv-title" style="margin-bottom:12px">Tell us about your project.</h2>
		<p style="color:var(--muted2);max-width:520px;margin:0 auto">Pricing starts at LKR 25,000 for graphic work, LKR 80,000 for 3D scenes, LKR 60,000 for an AutoCAD plan set. Free quote in 24 hours.</p>
		<div style="margin-top:24px"><a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Get a Quote</a></div>
	</div>
</div>

<?php get_footer();
