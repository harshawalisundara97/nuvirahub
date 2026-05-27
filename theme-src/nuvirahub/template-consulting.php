<?php
/**
 * Template Name: Nuvirahub Growth Consulting
 *
 * @package Nuvirahub
 */
get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Business Growth Consulting</div>
	<h1>Strategy that becomes <span>a Monday-morning to-do list.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">We don't hand you a 60-page slide deck. We work alongside your team, install the systems, and stay until the metric you actually care about moves.</p>
	<div style="margin-top:28px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1">
		<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Book Free Consult</a>
		<a class="nv-btn-ghost" href="#scope">What we cover</a>
	</div>
</div>

<div class="nv-section nv-reveal" id="scope">
	<div class="nv-tag">Three pillars</div>
	<h2 class="nv-title">Where we add value, fast.</h2>
	<div class="nv-grid-3" style="margin-top:32px">
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'target', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Growth Strategy</h4><p style="font-size:13px;color:var(--muted2)">Market positioning, pricing, channel selection, 90-day execution plans. We benchmark you, then ship the playbook.</p></div>
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'settings', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Operations &amp; Process</h4><p style="font-size:13px;color:var(--muted2)">SOPs, automation, KPIs, role clarity. Clean up the back office so the front line can sell without friction.</p></div>
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'pie-chart', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Financial Modelling</h4><p style="font-size:13px;color:var(--muted2)">Cash-flow forecasts, unit economics, investor-ready P&amp;L. Decisions on real numbers, not gut feel.</p></div>
	</div>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-tag">How we engage</div>
	<h2 class="nv-title">Two ways to work with us.</h2>
	<div class="nv-grid-3" style="grid-template-columns:1fr 1fr;margin-top:32px;gap:24px">
		<div class="nv-glass" style="padding:32px">
			<h4 style="font-family:var(--display);font-size:22px;margin-bottom:6px">Diagnostic Sprint</h4>
			<p style="color:var(--accent2);font-size:13px;margin-bottom:18px">2 weeks · fixed price</p>
			<p style="font-size:14px;color:var(--muted2);line-height:1.7">Deep-dive into your business. We deliver a written diagnosis, 5–7 prioritised recommendations, and a 90-day roadmap. Walk away with clarity even if we never work together again.</p>
		</div>
		<div class="nv-glass" style="padding:32px">
			<h4 style="font-family:var(--display);font-size:22px;margin-bottom:6px">Embedded Advisor</h4>
			<p style="color:var(--accent2);font-size:13px;margin-bottom:18px">3–6 months · monthly retainer</p>
			<p style="font-size:14px;color:var(--muted2);line-height:1.7">We sit inside your team weekly. Run the operating cadence, coach leadership, build the dashboards, hire the right people. We leave when the wheels keep turning without us.</p>
		</div>
	</div>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0">
		<div class="nv-tag" style="margin-bottom:12px">Free 30-min call</div>
		<h2 class="nv-title" style="margin-bottom:12px">What's the one number<br>that needs to move?</h2>
		<p style="color:var(--muted2);max-width:520px;margin:0 auto">Tell us. We'll tell you whether we can help — honestly. No pitch deck.</p>
		<div style="margin-top:24px"><a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Book the Call</a></div>
	</div>
</div>

<?php get_footer();
