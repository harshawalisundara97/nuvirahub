<?php
/**
 * Template Name: Nuvirahub ERP
 *
 * @package Nuvirahub
 */

get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">ERP for Enterprise</div>
	<h1>One system.<br><span>Every department.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">Finance, HR, inventory, CRM, production — connected, real-time, and built around how your business actually runs.</p>
	<div style="margin-top:28px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1">
		<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Book ERP Demo</a>
		<a class="nv-btn-ghost" href="#modules">See the modules</a>
	</div>
</div>

<!-- MODULES -->
<div class="nv-section nv-reveal" id="modules">
	<div class="nv-tag">The Modules</div>
	<h2 class="nv-title">Six pillars. <span>Pick what you need.</span></h2>
	<p class="nv-sub">Roll out the whole suite or start with one. Everything talks to everything else from day one.</p>
	<div class="nv-erp-modules">
		<div class="nv-erp-module"><div class="nv-erp-icon">💵</div><h3>Finance &amp; Accounting</h3><p>GL, AR/AP, multi-currency, tax compliance, audit-ready reports.</p></div>
		<div class="nv-erp-module"><div class="nv-erp-icon">👥</div><h3>HR &amp; Payroll</h3><p>Employee records, attendance, EPF/ETF, payroll, leave, performance.</p></div>
		<div class="nv-erp-module"><div class="nv-erp-icon">📦</div><h3>Inventory &amp; Warehouse</h3><p>Multi-location stock, batch/serial tracking, barcode, stock movements.</p></div>
		<div class="nv-erp-module"><div class="nv-erp-icon">🤝</div><h3>CRM &amp; Sales</h3><p>Pipeline, quotations, sales orders, customer 360, commission tracking.</p></div>
		<div class="nv-erp-module"><div class="nv-erp-icon">🏭</div><h3>Production &amp; MRP</h3><p>BOM, work orders, capacity planning, shop-floor data collection.</p></div>
		<div class="nv-erp-module"><div class="nv-erp-icon">📊</div><h3>Reporting &amp; BI</h3><p>Live dashboards, custom reports, KPI alerts on phone &amp; desktop.</p></div>
	</div>
</div>

<!-- WHY ERP -->
<div class="nv-section nv-reveal">
	<div class="nv-tag">Why ERP</div>
	<h2 class="nv-title">Stop running your business on <span>15 spreadsheets.</span></h2>
	<div class="nv-grid-3" style="margin-top:32px">
		<div class="nv-glass"><div class="nv-card-icon">⏱️</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Save 10+ hrs/week</h4><p style="font-size:13px;color:var(--muted2)">No re-entry between systems. Approvals on the phone. Reports auto-generated.</p></div>
		<div class="nv-glass"><div class="nv-card-icon">🎯</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">One source of truth</h4><p style="font-size:13px;color:var(--muted2)">Every department reads &amp; writes the same data. No more "which Excel is correct?"</p></div>
		<div class="nv-glass"><div class="nv-card-icon">📈</div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Decisions on real data</h4><p style="font-size:13px;color:var(--muted2)">Live margin, cash position, inventory value, top customers — all on your homepage.</p></div>
	</div>
</div>

<!-- INDUSTRIES -->
<div class="nv-section nv-reveal">
	<div class="nv-tag">Industries we serve</div>
	<h2 class="nv-title">Built for businesses like yours.</h2>
	<div class="nv-grid-4" style="margin-top:32px">
		<div class="nv-glass" style="text-align:center"><div style="font-size:36px;margin-bottom:12px">🏭</div><h4 style="font-family:var(--display);font-size:15px">Manufacturing</h4></div>
		<div class="nv-glass" style="text-align:center"><div style="font-size:36px;margin-bottom:12px">🏪</div><h4 style="font-family:var(--display);font-size:15px">Retail &amp; Distribution</h4></div>
		<div class="nv-glass" style="text-align:center"><div style="font-size:36px;margin-bottom:12px">🚚</div><h4 style="font-family:var(--display);font-size:15px">Logistics</h4></div>
		<div class="nv-glass" style="text-align:center"><div style="font-size:36px;margin-bottom:12px">🏗️</div><h4 style="font-family:var(--display);font-size:15px">Construction</h4></div>
		<div class="nv-glass" style="text-align:center"><div style="font-size:36px;margin-bottom:12px">🏥</div><h4 style="font-family:var(--display);font-size:15px">Healthcare</h4></div>
		<div class="nv-glass" style="text-align:center"><div style="font-size:36px;margin-bottom:12px">🎓</div><h4 style="font-family:var(--display);font-size:15px">Education</h4></div>
		<div class="nv-glass" style="text-align:center"><div style="font-size:36px;margin-bottom:12px">🌾</div><h4 style="font-family:var(--display);font-size:15px">Agriculture</h4></div>
		<div class="nv-glass" style="text-align:center"><div style="font-size:36px;margin-bottom:12px">⚙️</div><h4 style="font-family:var(--display);font-size:15px">Services</h4></div>
	</div>
</div>

<!-- IMPLEMENTATION TIMELINE -->
<div class="nv-section nv-reveal">
	<div class="nv-tag">Implementation</div>
	<h2 class="nv-title">From kick-off to go-live in <span>8–12 weeks.</span></h2>
	<div class="nv-timeline">
		<div class="nv-timeline-step"><div class="nv-timeline-week">Wk 1–2</div><h4>Discovery</h4><p>Process mapping, gap analysis, module scoping.</p></div>
		<div class="nv-timeline-step"><div class="nv-timeline-week">Wk 3–4</div><h4>Configuration</h4><p>Chart of accounts, master data, workflows, permissions.</p></div>
		<div class="nv-timeline-step"><div class="nv-timeline-week">Wk 5–6</div><h4>Data Migration</h4><p>Customers, suppliers, opening balances, inventory.</p></div>
		<div class="nv-timeline-step"><div class="nv-timeline-week">Wk 7–8</div><h4>Training &amp; UAT</h4><p>Role-based training, user acceptance, sign-off.</p></div>
		<div class="nv-timeline-step"><div class="nv-timeline-week">Wk 9–12</div><h4>Go-Live &amp; Support</h4><p>Cutover weekend, hyper-care, optimisation. 3 months free support.</p></div>
	</div>
</div>

<!-- CTA -->
<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0">
		<div class="nv-tag" style="margin-bottom:12px">See it in action</div>
		<h2 class="nv-title" style="margin-bottom:12px">Book a 45-minute demo<br>tailored to your business.</h2>
		<p style="color:var(--muted2);max-width:520px;margin:0 auto">Tell us your industry and pain points. We'll prepare a personalised walk-through — not a generic sales deck.</p>
		<div style="margin-top:24px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
			<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Book Personalised Demo</a>
		</div>
	</div>
</div>

<?php get_footer();
