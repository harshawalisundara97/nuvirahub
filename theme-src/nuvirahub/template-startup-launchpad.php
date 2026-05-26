<?php
/**
 * Template Name: Nuvirahub Startup Launchpad
 *
 * @package Nuvirahub
 */

get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Startup Launchpad</div>
	<h1>Start your business.<br><span>We'll walk every step.</span></h1>
	<p class="nv-sub" style="margin: 0 auto; text-align: center;">A complete launch service for founders in Sri Lanka — registration, documents, government authorities, banking, accounting, branding, and the digital tools you need on day one.</p>
	<div style="margin-top:28px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1">
		<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Book a Free Consultation</a>
		<a class="nv-btn-ghost" href="#roadmap">View the 5-Step Roadmap</a>
	</div>
</div>

<!-- 5-STEP ROADMAP -->
<div class="nv-section nv-reveal" id="roadmap">
	<div class="nv-tag">The Roadmap</div>
	<h2 class="nv-title">From idea to operational — in <span style="background:linear-gradient(135deg,var(--accent2),var(--accent3));-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent">5 stages</span></h2>
	<p class="nv-sub">Every founder needs this. We've packaged it.</p>

	<div class="nv-launchpad-grid">
		<div class="nv-launchpad-step">
			<div class="nv-launchpad-num">01</div>
			<h3>Idea Validation</h3>
			<p>Market research, competitor mapping, target audience definition, MVP scoping.</p>
			<ul>
				<li>Industry research report</li>
				<li>Competitor SWOT analysis</li>
				<li>Customer persona deck</li>
				<li>Go/no-go recommendation</li>
			</ul>
		</div>
		<div class="nv-launchpad-step">
			<div class="nv-launchpad-num">02</div>
			<h3>Business Registration</h3>
			<p>Name reservation, BR registration, Tax ID, EPF/ETF — all handled.</p>
			<ul>
				<li>Sole Proprietorship / Partnership / (Pvt) Ltd</li>
				<li>Registrar of Companies filing</li>
				<li>Inland Revenue TIN &amp; VAT</li>
				<li>Provincial &amp; local authority permits</li>
			</ul>
		</div>
		<div class="nv-launchpad-step">
			<div class="nv-launchpad-num">03</div>
			<h3>Documents &amp; Compliance</h3>
			<p>The paperwork that keeps you audit-ready and protected.</p>
			<ul>
				<li>Shareholder &amp; director agreements</li>
				<li>Employment contracts</li>
				<li>NDAs, SLAs, T&amp;Cs, privacy policy</li>
				<li>Trademark &amp; IP registration</li>
			</ul>
		</div>
		<div class="nv-launchpad-step">
			<div class="nv-launchpad-num">04</div>
			<h3>Operations Setup</h3>
			<p>Banking, accounting, payroll, digital infrastructure — switched on.</p>
			<ul>
				<li>Corporate bank account opening</li>
				<li>QuickBooks / Zoho / ERP setup</li>
				<li>Domain, email, Google Workspace</li>
				<li>Brand identity &amp; website launch</li>
			</ul>
		</div>
		<div class="nv-launchpad-step">
			<div class="nv-launchpad-num">05</div>
			<h3>Growth &amp; Scale</h3>
			<p>Marketing, sales engine, and the analytics to know what's working.</p>
			<ul>
				<li>SEO &amp; Google Business profile</li>
				<li>Social media launch campaign</li>
				<li>Lead-capture funnels</li>
				<li>Monthly growth retainer (optional)</li>
			</ul>
		</div>
	</div>
</div>

<!-- DOCUMENT CHECKLIST -->
<div class="nv-section nv-reveal" id="documents">
	<div class="nv-tag">Documents Checklist</div>
	<h2 class="nv-title">Every paper you'll need.</h2>
	<p class="nv-sub">We prepare, file, and follow up — you sign.</p>

	<div class="nv-doc-grid">
		<div class="nv-doc-col">
			<h4>Registration</h4>
			<ul class="nv-checklist">
				<li>National Identity Card (NIC) copies</li>
				<li>Proposed company name (3 options)</li>
				<li>Registered business address proof</li>
				<li>Director/shareholder details</li>
				<li>Form 1 (Application for Incorporation)</li>
				<li>Form 18 &amp; 19 (Director consent)</li>
				<li>Articles of Association</li>
			</ul>
		</div>
		<div class="nv-doc-col">
			<h4>Tax &amp; Finance</h4>
			<ul class="nv-checklist">
				<li>Tax Identification Number (TIN)</li>
				<li>VAT registration (if turnover &gt; LKR 80M)</li>
				<li>EPF/ETF employer registration</li>
				<li>Corporate bank account documents</li>
				<li>Audited opening balance sheet</li>
				<li>Withholding tax registration</li>
			</ul>
		</div>
		<div class="nv-doc-col">
			<h4>Operational</h4>
			<ul class="nv-checklist">
				<li>Trade licence (Pradeshiya Sabha / MC)</li>
				<li>BOI registration (for exports/FDI)</li>
				<li>Import / Export licence (if applicable)</li>
				<li>Industry-specific permits</li>
				<li>Trademark &amp; logo registration (NIPO)</li>
				<li>Data protection registration</li>
			</ul>
		</div>
	</div>
</div>

<!-- AUTHORITIES DIRECTORY -->
<div class="nv-section nv-reveal" id="authorities">
	<div class="nv-tag">Authorities Directory</div>
	<h2 class="nv-title">Who you deal with — and what for.</h2>
	<p class="nv-sub">We handle the back-and-forth. Here's who's actually behind the desks.</p>

	<div class="nv-auth-grid">
		<div class="nv-auth-card">
			<div class="nv-auth-icon">🏛️</div>
			<h4>Registrar of Companies (ROC)</h4>
			<p>Business name reservation, incorporation, annual returns.</p>
			<div class="nv-auth-meta"><span>📍 Colombo 02</span><span>🌐 drc.gov.lk</span></div>
		</div>
		<div class="nv-auth-card">
			<div class="nv-auth-icon">💰</div>
			<h4>Inland Revenue Department</h4>
			<p>TIN, VAT, income tax, withholding tax, SSCL.</p>
			<div class="nv-auth-meta"><span>📍 Maitland Crescent</span><span>🌐 ird.gov.lk</span></div>
		</div>
		<div class="nv-auth-card">
			<div class="nv-auth-icon">👥</div>
			<h4>EPF / ETF — Dept. of Labour</h4>
			<p>Employer registration, monthly contributions, member queries.</p>
			<div class="nv-auth-meta"><span>📍 Narahenpita</span><span>🌐 epf.lk</span></div>
		</div>
		<div class="nv-auth-card">
			<div class="nv-auth-icon">🌍</div>
			<h4>Board of Investment (BOI)</h4>
			<p>Tax holidays, FDI approval, export-oriented enterprises.</p>
			<div class="nv-auth-meta"><span>📍 World Trade Center</span><span>🌐 investsrilanka.com</span></div>
		</div>
		<div class="nv-auth-card">
			<div class="nv-auth-icon">📦</div>
			<h4>Sri Lanka Customs</h4>
			<p>Import/export declarations, duty payments, clearance.</p>
			<div class="nv-auth-meta"><span>📍 Times Building</span><span>🌐 customs.gov.lk</span></div>
		</div>
		<div class="nv-auth-card">
			<div class="nv-auth-icon">©️</div>
			<h4>NIPO — IP Office</h4>
			<p>Trademarks, patents, industrial designs, copyrights.</p>
			<div class="nv-auth-meta"><span>📍 Sampathpaya</span><span>🌐 nipo.gov.lk</span></div>
		</div>
		<div class="nv-auth-card">
			<div class="nv-auth-icon">🏪</div>
			<h4>Local Authority (PS / MC / UC)</h4>
			<p>Trade licence, building approvals, environmental clearance.</p>
			<div class="nv-auth-meta"><span>📍 Your area</span><span>🌐 lgpc.gov.lk</span></div>
		</div>
		<div class="nv-auth-card">
			<div class="nv-auth-icon">🛡️</div>
			<h4>Data Protection Authority</h4>
			<p>PDPA compliance, controller registration, breach reporting.</p>
			<div class="nv-auth-meta"><span>📍 Colombo</span><span>🌐 dpa.gov.lk</span></div>
		</div>
	</div>
</div>

<!-- CTA -->
<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0">
		<div class="nv-tag" style="margin-bottom:12px">Ready when you are</div>
		<h2 class="nv-title" style="margin-bottom:12px">Skip the paperwork. Launch in 14 days.</h2>
		<p style="color:var(--muted2);max-width:520px;margin:0 auto">Book a free 30-minute consultation. We map your business, quote the launch package, and start the same week.</p>
		<div style="margin-top:24px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
			<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Book Free Consultation</a>
			<a class="nv-btn-ghost" href="tel:+94000000000">📞 Call us directly</a>
		</div>
	</div>
</div>

<?php get_footer();
