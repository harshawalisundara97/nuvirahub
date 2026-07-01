<?php
/**
 * Template Name: Nuvirahub Terms of Service
 *
 * Plain-language T&Cs covering services + physical product sales (spices).
 *
 * @package Nuvirahub
 */

get_header();
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Legal</div>
	<h1>Terms of <span>Service</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">The agreement between you and Nuvirahub (Pvt) Ltd when you use our website, hire our services, or buy from Nuvira Spice Co.</p>
</div>

<div class="nv-section">
	<div class="nv-legal">
		<p class="nv-legal-meta">Last updated: <?php echo esc_html( get_the_modified_date( 'F j, Y' ) ?: gmdate( 'F j, Y' ) ); ?></p>

		<h2>1. Acceptance</h2>
		<p>By using <a href="<?php echo esc_url( home_url() ); ?>">nuvirahub.com</a> or engaging us for services or products, you agree to these Terms. If you do not agree, please do not use the site.</p>

		<h2>2. Who we are</h2>
		<p>Nuvirahub (Pvt) Ltd, 27/2E Pieris Avenue, Kalubowila, Dehiwala, Sri Lanka 10350. Contact: <a href="mailto:nuvirahub@gmail.com">nuvirahub@gmail.com</a> · +94 71 672 2599.</p>

		<h2>3. Services we offer</h2>
		<ul>
			<li>Software development (web, mobile, Windows apps)</li>
			<li>Business growth consulting</li>
			<li>Startup Launchpad (business registration, documentation, advisory)</li>
			<li>Sea &amp; air freight logistics</li>
			<li>Creative &amp; design (graphic, 3D, AutoCAD)</li>
			<li>Brand &amp; digital marketing</li>
			<li>Enterprise ERP implementation</li>
			<li>Physical products under <strong>Nuvira Spice Co.</strong> (Ceylon spices shipped to Latvia and other countries)</li>
		</ul>

		<h2>4. Quotes and engagement</h2>
		<p>All quotes are valid for 30 days unless stated otherwise. A signed proposal or written email confirmation constitutes a binding engagement. A deposit (typically 50%) is required before work begins; the balance is due on delivery unless milestone payments are agreed in writing.</p>

		<h2>5. Deliverables &amp; revisions</h2>
		<p>Each engagement specifies what is delivered. We include up to <strong>two rounds</strong> of revisions per deliverable; additional rounds are billed at our standard hourly rate. Scope changes are quoted separately.</p>

		<h2>6. Intellectual property</h2>
		<ul>
			<li>On final payment, ownership of deliverables (designs, code, content) transfers to you, except for third-party assets (fonts, stock photos, licensed plugins) which retain their original licences.</li>
			<li>We retain the right to display non-confidential work in our portfolio and case studies unless you ask us not to in writing.</li>
			<li>Pre-existing tools, libraries and templates we use remain our property.</li>
		</ul>

		<h2>7. Nuvira Spice Co. — product orders</h2>
		<ul>
			<li>Orders are placed via WhatsApp at <a href="<?php echo esc_url( nuvirahub_wa_link( 'Hi Nuvira Spice Co., I would like to order:' ) ); ?>">+94 71 672 2599</a>. We confirm price, availability and shipping cost before payment.</li>
			<li>Payment is by SEPA bank transfer, Wise, or Revolut. We ship only after payment clears.</li>
			<li>Delivery estimates are 5–8 working days to Latvia; we are not liable for carrier delays beyond our control (customs, weather, strikes).</li>
			<li>You are responsible for ensuring importation of food products is permitted at your address. EU duties and VAT are pre-paid by us and included in the listed price.</li>
		</ul>

		<h2>8. Returns &amp; refunds</h2>
		<p>See our full <a href="<?php echo esc_url( home_url( '/shipping-refunds/' ) ); ?>">Shipping &amp; Refunds policy</a>. In short: services are non-refundable once work has begun, but unhappy clients can request a free revision round. Physical product purchases follow EU consumer law — see the policy page for full terms.</p>

		<h2>9. Confidentiality</h2>
		<p>We treat all information you share as confidential and use it only to deliver your project. A formal NDA is available on request.</p>

		<h2>10. Liability</h2>
		<p>Our total liability for any engagement is capped at the fees paid by you for that engagement in the 12 months preceding the claim. We are not liable for indirect, consequential or punitive damages, including loss of profits, data or business opportunity.</p>

		<h2>11. Termination</h2>
		<p>Either party may end an engagement with 14 days' written notice. You pay for work completed up to the termination date plus any non-cancellable third-party costs we have committed to.</p>

		<h2>12. Governing law</h2>
		<p>These Terms are governed by the laws of the Democratic Socialist Republic of Sri Lanka. Disputes are subject to the exclusive jurisdiction of the courts of Colombo, except where mandatory consumer-protection laws in your country of residence (e.g. EU consumer protection) require otherwise.</p>

		<h2>13. Changes</h2>
		<p>We may update these Terms. The "Last updated" date above shows the current version. Material changes affecting existing engagements are communicated to active clients by email.</p>

		<h2>14. Contact</h2>
		<p>Questions about these Terms? Email <a href="mailto:nuvirahub@gmail.com">nuvirahub@gmail.com</a>.</p>
	</div>
</div>

<?php get_footer();
