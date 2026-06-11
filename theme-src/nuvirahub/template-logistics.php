<?php
/**
 * Template Name: Nuvirahub Logistics
 *
 * @package Nuvirahub
 */

get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Logistics — Sea &amp; Air</div>
	<h1>Door to door.<br><span>Port to port.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">Freight forwarding with paperwork done, customs cleared, and a single person who actually picks up the phone.</p>
	<div style="margin-top:28px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1">
		<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Request a Quote</a>
		<a class="nv-btn-ghost" href="#process">How it works</a>
	</div>
</div>

<!-- FREIGHT MODES -->
<div class="nv-section nv-reveal">
	<div class="nv-tag">Two modes. One coordinator.</div>
	<h2 class="nv-title">Move it by <span>sea</span> or by <span>air</span> — your call.</h2>

	<div class="nv-grid-3" style="grid-template-columns:repeat(auto-fit,minmax(240px,1fr));margin-top:40px;gap:24px">
		<div class="nv-freight-card">
			<div class="nv-freight-icon"><?php echo nv_icon( "ship", 44 ); ?></div>
			<h3>Sea Freight</h3>
			<p>Cost-effective for larger shipments. We handle FCL, LCL, refrigerated and project cargo.</p>
			<ul class="nv-checklist">
				<li>Full Container Load (20'/40'/40HC)</li>
				<li>Less than Container Load (LCL consolidation)</li>
				<li>Reefer &amp; temperature-controlled cargo</li>
				<li>Project cargo &amp; out-of-gauge</li>
				<li>Marine insurance &amp; documentation</li>
			</ul>
		</div>
		<div class="nv-freight-card">
			<div class="nv-freight-icon"><?php echo nv_icon( "plane", 44 ); ?></div>
			<h3>Air Freight</h3>
			<p>Fast, reliable, time-critical. Door-to-door express or standard general cargo.</p>
			<ul class="nv-checklist">
				<li>Express courier (1–3 days)</li>
				<li>Standard air cargo (3–7 days)</li>
				<li>Charter for oversized shipments</li>
				<li>Dangerous goods (IATA certified)</li>
				<li>Air cargo insurance</li>
			</ul>
		</div>
	</div>
</div>

<!-- PROCESS -->
<div class="nv-section nv-reveal" id="process">
	<div class="nv-tag">How it works</div>
	<h2 class="nv-title">Five steps. One contact.</h2>
	<div class="nv-process">
		<div class="nv-step"><div class="nv-step-num">1</div><div class="nv-step-title">Enquire</div><div class="nv-step-desc">Send origin, destination, weight, dimensions, urgency. Quote in &lt; 4 hours.</div></div>
		<div class="nv-step"><div class="nv-step-num">2</div><div class="nv-step-title">Book</div><div class="nv-step-desc">Confirm carrier, sailing/flight, insurance &amp; pickup window. Pay deposit.</div></div>
		<div class="nv-step"><div class="nv-step-num">3</div><div class="nv-step-title">Pickup &amp; Documentation</div><div class="nv-step-desc">We collect, label, palletise. BL, AWB, commercial invoice, packing list — all filed.</div></div>
		<div class="nv-step"><div class="nv-step-num">4</div><div class="nv-step-title">Customs &amp; Transit</div><div class="nv-step-desc">Clearance at origin &amp; destination. Live tracking updates pushed to you daily.</div></div>
		<div class="nv-step"><div class="nv-step-num">5</div><div class="nv-step-title">Delivered</div><div class="nv-step-desc">Last-mile delivery, photo proof, signed POD. Invoice settled, done.</div></div>
	</div>
</div>

<!-- COVERAGE -->
<div class="nv-section nv-reveal">
	<div class="nv-tag">Coverage</div>
	<h2 class="nv-title">Where we move things.</h2>
	<p class="nv-sub">Partner network across major trade lanes. If we don't have a desk there, we have a verified agent who does.</p>
	<div class="nv-coverage-list">
		<div class="nv-coverage-region"><h4><?php echo nv_icon( "globe", 16 ); ?>Asia–Pacific</h4><p>China, India, Singapore, Malaysia, Thailand, Vietnam, Indonesia, Australia, Japan, South Korea</p></div>
		<div class="nv-coverage-region"><h4><?php echo nv_icon( "globe", 16 ); ?>Middle East &amp; Africa</h4><p>UAE, Saudi Arabia, Qatar, Oman, Kenya, South Africa, Egypt</p></div>
		<div class="nv-coverage-region"><h4><?php echo nv_icon( "globe", 16 ); ?>Europe</h4><p>UK, Germany, Netherlands, France, Italy, Spain, Belgium, Poland</p></div>
		<div class="nv-coverage-region"><h4><?php echo nv_icon( "globe", 16 ); ?>Americas</h4><p>USA (East &amp; West), Canada, Mexico, Brazil</p></div>
	</div>
</div>

<!-- CTA -->
<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0">
		<div class="nv-tag" style="margin-bottom:12px">Quote in 4 hours</div>
		<h2 class="nv-title" style="margin-bottom:12px">Got a shipment?<br>Get a price.</h2>
		<p style="color:var(--muted2);max-width:520px;margin:0 auto">Send us the route, weight, and timing. We'll come back with the best rate across our carrier mix — no obligation.</p>
		<div style="margin-top:24px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
			<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Request Freight Quote</a>
		</div>
	</div>
</div>

<?php get_footer();
