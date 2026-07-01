<?php
/**
 * Template Name: Nuvirahub Shipping & Refunds
 *
 * Spice-specific shipping + EU consumer rights refund policy.
 *
 * @package Nuvirahub
 */

get_header();
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Nuvira Spice Co.</div>
	<h1>Shipping &amp; <span>Refunds</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">Clear rules for spice orders from Sri Lanka to Latvia and beyond. Compliant with EU consumer law.</p>
</div>

<div class="nv-section">
	<div class="nv-legal">
		<p class="nv-legal-meta">Last updated: <?php echo esc_html( get_the_modified_date( 'F j, Y' ) ?: gmdate( 'F j, Y' ) ); ?></p>

		<h2>1. Shipping coverage</h2>
		<p>We currently ship Nuvira Spice Co. products to <strong>Latvia</strong> (Riga, Daugavpils, Liepāja, Jelgava and any rural address). Other EU destinations available on request — message us on WhatsApp for a quote.</p>

		<h2>2. Carriers &amp; timing</h2>
		<ul>
			<li><strong>Standard tracked:</strong> Sri Lanka Post → Latvian Post, 5–8 working days, included in price.</li>
			<li><strong>Express:</strong> DHL or DPD, 3–5 working days, +€12 surcharge.</li>
			<li>Orders ship within <strong>3 working days</strong> of payment confirmation.</li>
		</ul>

		<h2>3. Customs, duties &amp; VAT</h2>
		<p>Our listed prices <strong>include all EU duties and VAT</strong>. There is nothing to pay at the door. We file the customs paperwork (CN22 / CN23) on your behalf using your shipping details.</p>

		<h2>4. Packaging &amp; product safety</h2>
		<p>All spices are vacuum-sealed in food-grade pouches, then placed in a rigid outer box. Best-before dates and batch codes are printed on each pouch. Allergen and origin information is disclosed in line with EU Regulation (EU) No 1169/2011.</p>

		<h2>5. Right of withdrawal (EU consumers)</h2>
		<p>Under Directive 2011/83/EU, EU consumers have <strong>14 days</strong> from receiving the order to withdraw without giving a reason — <strong>except for sealed food products that have been opened</strong> or are perishable, which are excluded by Article 16(d) of the Directive.</p>
		<p>In practice:</p>
		<ul>
			<li>If the product arrives <strong>damaged, spoiled or wrong</strong> — full refund or replacement, you do not return anything (photo proof sent via WhatsApp is enough).</li>
			<li>If you simply changed your mind and the packaging is <strong>still sealed</strong> — you may return within 14 days at your cost, and we refund the product price (not shipping) within 14 days of receiving the return.</li>
			<li>If the seal is broken — for food safety reasons, we cannot accept the return. This is a legal exception, not a policy choice.</li>
		</ul>

		<h2>6. Damaged or lost shipments</h2>
		<p>Photograph the damaged package and its contents and message us on WhatsApp within 7 days of delivery. We will either reship at our cost or refund in full, including shipping. Lost shipments (no tracking update for 14+ days) are resolved the same way.</p>

		<h2>7. Refund method &amp; timing</h2>
		<p>Refunds are issued via the same payment method used for the original order (SEPA, Wise, Revolut). You receive the refund within <strong>14 working days</strong> of our refund approval.</p>

		<h2>8. Bulk and B2B orders</h2>
		<p>Restaurant, deli and importer orders (≥ 2 kg per spice) are governed by individual purchase agreements. Returns are not accepted on bulk orders unless products are defective.</p>

		<h2>9. Service refunds (non-product)</h2>
		<p>For software, consulting and other professional services, see <a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>">our Terms of Service</a> — services are billed in milestones, with deposits non-refundable once work has begun, but unhappy clients receive complimentary revisions.</p>

		<h2>10. Contact for shipping issues</h2>
		<p>WhatsApp: <a href="<?php echo esc_url( nuvirahub_wa_link( 'Hi Nuvira Spice Co., I have a shipping issue with my order:' ) ); ?>">+94 71 672 2599</a> · Email: <a href="mailto:nuvirahub@gmail.com">nuvirahub@gmail.com</a></p>
	</div>
</div>

<?php get_footer();
