<?php
/**
 * Template Name: Nuvirahub Spices (Nuvira Spice Co.)
 *
 * Catalog of Ceylon spices sold to Latvia.
 * Edit the $spices array to add/remove products or adjust prices.
 * The WhatsApp number is set in functions.php via NUVIRAHUB_WHATSAPP.
 *
 * @package Nuvirahub
 */

get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );

/* -------------------------------------------------------------------------
 * Products now come from the central catalogue model (inc/products.php).
 * Edit prices/weights/items there. This page renders the 'spices' category.
 * ------------------------------------------------------------------------- */
$spices = nuvirahub_products_by_category( 'spices' );
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Nuvira Spice Co.</div>
	<h1>Ceylon spices —<br><span>delivered to Latvia.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">Single-origin spices from the hills of Sri Lanka, packed within 7 days of harvest, shipped tracked to your door in Riga, Daugavpils or anywhere across Latvia. Click any spice to order on WhatsApp — same-day reply.</p>
	<div style="margin-top:28px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1">
		<a class="nv-btn-primary" href="#catalog">Browse Catalog</a>
		<a class="nv-btn-ghost" href="<?php echo esc_url( nuvirahub_wa_link( 'Hi Nuvira Spice Co.! I would like a custom spice order.' ) ); ?>" target="_blank" rel="noopener"><?php echo nv_icon( 'message-circle', 16 ); ?>Chat on WhatsApp</a>
	</div>
</div>

<!-- TRUST STRIP -->
<div class="nv-section nv-reveal" style="padding-top:32px;padding-bottom:32px">
	<div class="nv-spice-trust">
		<div><span class="nv-trust-icon"><?php echo nv_icon( 'sprout', 22 ); ?></span><strong>Single-origin</strong>Traced to one farm or co-op</div>
		<div><span class="nv-trust-icon"><?php echo nv_icon( 'package', 22 ); ?></span><strong>Vacuum sealed</strong>Locks in oils &amp; aroma</div>
		<div><span class="nv-trust-icon"><?php echo nv_icon( 'plane', 22 ); ?></span><strong>5–8 day delivery</strong>Tracked, Riga to anywhere in LV</div>
		<div><span class="nv-trust-icon"><?php echo nv_icon( 'message-circle', 22 ); ?></span><strong>WhatsApp ordering</strong>One message, no checkout forms</div>
	</div>
</div>

<!-- SPICE CATALOG -->
<div class="nv-section nv-reveal" id="catalog">
	<div class="nv-tag">The Catalog</div>
	<h2 class="nv-title">9 spices. <span>Pick your favourites.</span></h2>
	<p class="nv-sub">All prices include packaging &amp; tracked shipping to Latvia. Click any weight option to send your order via WhatsApp — we reply within 2 hours during business hours.</p>

	<div class="nv-spice-grid">
		<?php foreach ( $spices as $s ) : ?>
			<div class="nv-spice" id="<?php echo esc_attr( $s['slug'] ); ?>">
				<div class="nv-spice-cover" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/img/spices/' . $s['slug'] . '.jpg' ); ?>');">
					<div class="nv-spice-origin"><?php echo nv_icon( 'map-pin', 12 ); ?><?php echo esc_html( $s['origin'] ); ?></div>
				</div>
				<div class="nv-spice-body">
					<h3><?php echo esc_html( $s['name'] ); ?></h3>
					<p class="nv-spice-tagline"><?php echo esc_html( $s['tagline'] ); ?></p>
					<p class="nv-spice-desc"><?php echo esc_html( $s['desc'] ); ?></p>
					<div class="nv-spice-tags">
						<?php foreach ( $s['tags'] as $t ) : ?>
							<span class="nv-tag-pill"><?php echo esc_html( $t ); ?></span>
						<?php endforeach; ?>
					</div>
					<div class="nv-spice-options-label">Pick a weight to order:</div>
					<div class="nv-spice-options">
						<?php foreach ( $s['options'] as $opt ) :
							$msg = sprintf(
								"Hi Nuvira Spice Co.! I'd like to order:\n\n🌶️ %s\nWeight: %s\nPrice: %s%s (incl. shipping to Latvia)\n\nPlease confirm availability and delivery time. Thanks!",
								$s['name'], $opt['weight'], NUVIRAHUB_SPICE_CURRENCY, $opt['price']
							);
							$link = nuvirahub_wa_link( $msg );
						?>
							<a class="nv-spice-opt" href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener">
								<span class="nv-spice-weight"><?php echo esc_html( $opt['weight'] ); ?></span>
								<span class="nv-spice-price"><?php echo esc_html( NUVIRAHUB_SPICE_CURRENCY . $opt['price'] ); ?></span>
								<span class="nv-spice-buy"><?php echo nv_icon( 'message-circle', 13 ); ?>Order</span>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<!-- HOW IT WORKS -->
<div class="nv-section nv-reveal">
	<div class="nv-tag">How ordering works</div>
	<h2 class="nv-title">Four steps. <span>No checkout forms.</span></h2>
	<div class="nv-process">
		<div class="nv-step"><div class="nv-step-num">1</div><div class="nv-step-title">Click a spice</div><div class="nv-step-desc">Pick the weight you want. The order opens pre-filled in WhatsApp.</div></div>
		<div class="nv-step"><div class="nv-step-num">2</div><div class="nv-step-title">Confirm with us</div><div class="nv-step-desc">We confirm availability and total (including any bundle discounts). Same-day reply.</div></div>
		<div class="nv-step"><div class="nv-step-num">3</div><div class="nv-step-title">Pay via bank transfer</div><div class="nv-step-desc">SEPA transfer to our Latvian-friendly bank, or Wise / Revolut. Receipt issued.</div></div>
		<div class="nv-step"><div class="nv-step-num">4</div><div class="nv-step-title">Delivered in 5–8 days</div><div class="nv-step-desc">Vacuum-sealed, packed fresh, tracked shipping to your door anywhere in Latvia.</div></div>
	</div>
</div>

<!-- FAQ -->
<div class="nv-section nv-reveal">
	<div class="nv-tag">FAQs</div>
	<h2 class="nv-title">Good questions, real answers.</h2>
	<div class="nv-grid-3" style="margin-top:32px">
		<div class="nv-glass">
			<h4 style="font-family:var(--display);font-size:17px;margin-bottom:10px">How fresh are the spices?</h4>
			<p style="font-size:14px;color:var(--muted2);line-height:1.6">Every batch is harvested, dried, packed and shipped within 14 days. Shelf life (sealed) is 12–24 months depending on the spice.</p>
		</div>
		<div class="nv-glass">
			<h4 style="font-family:var(--display);font-size:17px;margin-bottom:10px">Do you ship anywhere in Latvia?</h4>
			<p style="font-size:14px;color:var(--muted2);line-height:1.6">Yes — Riga, Daugavpils, Liepāja, Jelgava, all 4 cities and rural addresses. Tracked Latvian Post or DPD courier.</p>
		</div>
		<div class="nv-glass">
			<h4 style="font-family:var(--display);font-size:17px;margin-bottom:10px">Can I order in bulk for my restaurant / shop?</h4>
			<p style="font-size:14px;color:var(--muted2);line-height:1.6">Absolutely. Bulk pricing kicks in at 2kg per spice. Message us on WhatsApp with your wishlist and we'll quote.</p>
		</div>
		<div class="nv-glass">
			<h4 style="font-family:var(--display);font-size:17px;margin-bottom:10px">Are they organic / certified?</h4>
			<p style="font-size:14px;color:var(--muted2);line-height:1.6">Our cinnamon, turmeric and cardamom are organic-certified. Others are sourced from small farms without synthetic pesticides.</p>
		</div>
		<div class="nv-glass">
			<h4 style="font-family:var(--display);font-size:17px;margin-bottom:10px">What about customs / duties?</h4>
			<p style="font-size:14px;color:var(--muted2);line-height:1.6">All EU duties &amp; VAT are pre-paid and included in our prices. No surprises at the door.</p>
		</div>
		<div class="nv-glass">
			<h4 style="font-family:var(--display);font-size:17px;margin-bottom:10px">Can I gift a spice box?</h4>
			<p style="font-size:14px;color:var(--muted2);line-height:1.6">Yes — we offer a curated 5-spice gift box in a wooden case with a handwritten card for €45. Message us to arrange.</p>
		</div>
	</div>
</div>

<!-- BIG WHATSAPP CTA -->
<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0;background:linear-gradient(135deg,rgba(37,211,102,.15),rgba(20,184,166,.08));border-color:rgba(37,211,102,.3)">
		<div class="nv-tag" style="margin-bottom:12px;color:#25D366;border-color:#25D366">Ready to order?</div>
		<h2 class="nv-title" style="margin-bottom:12px">Message us on WhatsApp.<br>We reply <span>within 2 hours.</span></h2>
		<p style="color:var(--muted2);max-width:560px;margin:0 auto">Tell us which spices, which weights, and your Latvian address. We'll confirm the total and shipping date. Bundle discounts available.</p>
		<div style="margin-top:28px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
			<a class="nv-btn-primary" style="background:#25D366;border-color:#25D366" href="<?php echo esc_url( nuvirahub_wa_link( 'Hi Nuvira Spice Co.! I would like to place an order. Here is my wishlist:' ) ); ?>" target="_blank" rel="noopener"><?php echo nv_icon( 'message-circle', 16 ); ?>Start Your Order on WhatsApp</a>
			<a class="nv-btn-ghost" href="<?php echo esc_url( $contact_url ); ?>">Or use the contact form</a>
		</div>
	</div>
</div>

<?php get_footer();
