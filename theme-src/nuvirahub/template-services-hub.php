<?php
/**
 * Template Name: Nuvirahub Services Hub
 *
 * @package Nuvirahub
 */

get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );

$launch  = nuvirahub_get_page_by_title( 'Startup Launchpad' );
$logist  = nuvirahub_get_page_by_title( 'Logistics' );
$erp     = nuvirahub_get_page_by_title( 'ERP Solutions' );
$constr  = nuvirahub_get_page_by_title( 'Construction' );
$launch_url = $launch ? get_permalink( $launch->ID ) : '#startup';
$logist_url = $logist ? get_permalink( $logist->ID ) : '#logistics';
$erp_url    = $erp ? get_permalink( $erp->ID ) : '#erp';
$constr_url = $constr ? get_permalink( $constr->ID ) : home_url( '/construction' );
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Services</div>
	<h1>One team. <span>Eight disciplines.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">From a logo to a launched company, a freight shipment to a full ERP rollout — Nuvirahub delivers under one roof. Pick a pillar to jump into the detail.</p>
</div>

<!-- 7-PILLAR GRID -->
<div class="nv-section nv-reveal">
	<div class="nv-pillars">
		<a class="nv-pillar" href="#software"><div class="nv-pillar-num">01</div><div class="nv-pillar-icon">💻</div><h3>Software &amp; Apps</h3><p>Web, mobile, Windows apps — custom-built for your workflow.</p></a>
		<a class="nv-pillar" href="<?php echo esc_url( $launch_url ); ?>"><div class="nv-pillar-num">02</div><div class="nv-pillar-icon">🚀</div><h3>Startup Launchpad</h3><p>We start your business with you. Registration, docs, authorities, done.</p></a>
		<a class="nv-pillar" href="#consulting"><div class="nv-pillar-num">03</div><div class="nv-pillar-icon">📈</div><h3>Business Growth Consulting</h3><p>Strategy, processes, and the operational playbook to scale you up.</p></a>
		<a class="nv-pillar" href="<?php echo esc_url( $logist_url ); ?>"><div class="nv-pillar-num">04</div><div class="nv-pillar-icon">🚢</div><h3>Logistics — Sea &amp; Air</h3><p>End-to-end freight forwarding. Containers, courier, customs, delivered.</p></a>
		<a class="nv-pillar" href="#creative"><div class="nv-pillar-num">05</div><div class="nv-pillar-icon">🎨</div><h3>Creative &amp; Design</h3><p>Graphic design, 3D rendering, AutoCAD architectural &amp; house plans.</p></a>
		<a class="nv-pillar" href="#marketing"><div class="nv-pillar-num">06</div><div class="nv-pillar-icon">📣</div><h3>Brand &amp; Digital Marketing</h3><p>Identity, social media, SEO — the engine that brings customers in.</p></a>
		<a class="nv-pillar" href="<?php echo esc_url( $erp_url ); ?>"><div class="nv-pillar-num">07</div><div class="nv-pillar-icon">🏢</div><h3>ERP for Enterprise</h3><p>Finance, HR, inventory, CRM, production — one connected system.</p></a>
		<a class="nv-pillar" href="<?php echo esc_url( $constr_url ); ?>"><div class="nv-pillar-num">08</div><div class="nv-pillar-icon">🏗️</div><h3>Nuvira Construction</h3><p>House design, drawings, BIM, construction and property sales.</p></a>
	</div>
</div>

<div class="nv-divider"></div>

<!-- SOFTWARE -->
<div class="nv-section nv-reveal" id="software">
	<div class="nv-tag">01 — Software &amp; Apps</div>
	<h2 class="nv-title">Apps for every screen — and the desktop too.</h2>
	<p class="nv-sub">Whether your customers live in a browser, a phone, or a Windows shop floor, we ship the right tool.</p>
	<div class="nv-grid-3" style="margin-top:32px">
		<div class="nv-glass"><div class="nv-card-icon">🌐</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Websites &amp; Web Apps</h4><p style="font-size:13px;color:var(--muted2)">WordPress, React, Laravel, headless commerce. Fast, responsive, SEO-ready.</p></div>
		<div class="nv-glass"><div class="nv-card-icon">📱</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Mobile Apps</h4><p style="font-size:13px;color:var(--muted2)">Native iOS / Android and cross-platform Flutter &amp; React Native builds.</p></div>
		<div class="nv-glass"><div class="nv-card-icon">🖥️</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Windows Applications</h4><p style="font-size:13px;color:var(--muted2)">Desktop tools in C#/.NET, Qt, Electron — POS, inventory, custom utilities.</p></div>
	</div>
</div>

<div class="nv-divider"></div>

<!-- CONSULTING -->
<div class="nv-section nv-reveal" id="consulting">
	<div class="nv-tag">03 — Business Growth Consulting</div>
	<h2 class="nv-title">Strategy that becomes a Monday-morning to-do list.</h2>
	<p class="nv-sub">We don't hand you a 60-page slide deck. We work alongside your team, install the systems, and stay until the metric you care about moves.</p>
	<div class="nv-grid-3" style="margin-top:32px">
		<div class="nv-glass"><div class="nv-card-icon">🎯</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Growth Strategy</h4><p style="font-size:13px;color:var(--muted2)">Market positioning, pricing, channel selection, 90-day execution plans.</p></div>
		<div class="nv-glass"><div class="nv-card-icon">⚙️</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Operations &amp; Process</h4><p style="font-size:13px;color:var(--muted2)">SOPs, automation, KPIs — clean up the back office so the front can sell.</p></div>
		<div class="nv-glass"><div class="nv-card-icon">📊</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Financial Modelling</h4><p style="font-size:13px;color:var(--muted2)">Cash-flow forecasts, unit economics, investor-ready P&amp;L.</p></div>
	</div>
</div>

<div class="nv-divider"></div>

<!-- CREATIVE -->
<div class="nv-section nv-reveal" id="creative">
	<div class="nv-tag">05 — Creative &amp; Design</div>
	<h2 class="nv-title">Pixels, polygons, and blueprints.</h2>
	<p class="nv-sub">Two-dimensional brand work, three-dimensional product &amp; interior visualisation, and full architectural drafting.</p>
	<div class="nv-grid-3" style="margin-top:32px">
		<div class="nv-glass"><div class="nv-card-icon">🖌️</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Graphic Design</h4><p style="font-size:13px;color:var(--muted2)">Logos, packaging, print, social creatives, presentation decks.</p></div>
		<div class="nv-glass"><div class="nv-card-icon">🧊</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">3D Rendering</h4><p style="font-size:13px;color:var(--muted2)">Product visualisation, interior walk-throughs, photoreal exterior shots.</p></div>
		<div class="nv-glass"><div class="nv-card-icon">📐</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">AutoCAD &amp; House Plans</h4><p style="font-size:13px;color:var(--muted2)">Floor plans, elevations, working drawings — submission-ready DWG &amp; PDF.</p></div>
	</div>
</div>

<div class="nv-divider"></div>

<!-- MARKETING -->
<div class="nv-section nv-reveal" id="marketing">
	<div class="nv-tag">06 — Brand &amp; Digital Marketing</div>
	<h2 class="nv-title">Get found. Be remembered. Sell more.</h2>
	<p class="nv-sub">A brand that holds together, a content engine that doesn't stop, and SEO that compounds.</p>
	<div class="nv-grid-3" style="margin-top:32px">
		<div class="nv-glass"><div class="nv-card-icon">🆔</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Brand Identity</h4><p style="font-size:13px;color:var(--muted2)">Naming, logo systems, colour, type, brand guidelines, asset libraries.</p></div>
		<div class="nv-glass"><div class="nv-card-icon">📲</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Social Media</h4><p style="font-size:13px;color:var(--muted2)">Content calendars, reels, paid campaigns, community management.</p></div>
		<div class="nv-glass"><div class="nv-card-icon">🔍</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">SEO &amp; Analytics</h4><p style="font-size:13px;color:var(--muted2)">Technical SEO, content strategy, Google Business Profile, GA4 dashboards.</p></div>
	</div>
</div>

<!-- CTA -->
<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0">
		<div class="nv-tag" style="margin-bottom:12px">Let's scope your project</div>
		<h2 class="nv-title" style="margin-bottom:12px">Tell us what you need.<br>We'll tell you what it takes.</h2>
		<p style="color:var(--muted2);max-width:520px;margin:0 auto">Every engagement starts with a free 30-minute call. We listen, we ask the awkward questions, and you walk away with a clear path forward — paid or not.</p>
		<div style="margin-top:24px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
			<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Start a Conversation</a>
		</div>
	</div>
</div>

<?php get_footer();
