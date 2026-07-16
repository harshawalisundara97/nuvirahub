<?php
/**
 * Template Name: Nuvirahub Wholesale (B2B)
 *
 * E6 — Wholesale / B2B quotation inquiry. Fields per spec §14:
 * Company, Contact Person, Product Required, Quantity Required,
 * Destination Country, Special Requirements. Submits via email
 * (admin-post.php → nuvirahub_handle_wholesale) OR a one-tap WhatsApp
 * deep-link built client-side from the same fields.
 *
 * @package Nuvirahub
 */

get_header();

$status = isset( $_GET['wholesale'] ) ? sanitize_text_field( wp_unslash( $_GET['wholesale'] ) ) : '';

// Product dropdown options — live from the WooCommerce dashboard, with the
// theme's static catalogue as a fallback if WooCommerce is unavailable.
$nv_products = array();
if ( function_exists( 'wc_get_products' ) ) {
	foreach ( wc_get_products( array( 'status' => 'publish', 'limit' => 50, 'orderby' => 'title', 'order' => 'ASC' ) ) as $nv_wc_p ) {
		$nv_products[] = array( 'name' => $nv_wc_p->get_name() );
	}
}
if ( empty( $nv_products ) && function_exists( 'nuvirahub_products' ) ) {
	$nv_products = nuvirahub_products();
}
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Wholesale &amp; B2B</div>
	<h1>Bulk orders,<br><span>better pricing.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">Restaurants, shops, distributors and resellers — tell us what you need and we'll send a custom quotation with tiered pricing, packed and shipped to your country. Bulk rates kick in from 2&nbsp;kg per product.</p>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-wholesale-grid">

		<!-- Left: why bulk with us -->
		<div class="nv-wholesale-aside">
			<h2 class="nv-title" style="font-size:24px;text-align:left">Why buy wholesale<br>from Nuvirahub?</h2>
			<ul class="nv-wholesale-points">
				<li><span class="nv-wh-ico"><?php echo nv_icon( 'sprout', 18 ); ?></span><div><strong>Single-origin, traceable</strong><p>Every batch traced to one farm or co-op in Sri Lanka.</p></div></li>
				<li><span class="nv-wh-ico"><?php echo nv_icon( 'package', 18 ); ?></span><div><strong>Tiered bulk pricing</strong><p>From 2&nbsp;kg per product — the more you order, the lower the unit price.</p></div></li>
				<li><span class="nv-wh-ico"><?php echo nv_icon( 'plane', 18 ); ?></span><div><strong>Worldwide shipping</strong><p>Tracked freight with duties handled. We quote landed cost up front.</p></div></li>
				<li><span class="nv-wh-ico"><?php echo nv_icon( 'message-circle', 18 ); ?></span><div><strong>Same-day reply</strong><p>Send the form or message us on WhatsApp — quotes within hours.</p></div></li>
			</ul>
		</div>

		<!-- Right: the inquiry form -->
		<div class="nv-form nv-wholesale-form" id="quote">
			<h3 style="font-family:var(--display);font-size:20px;font-weight:700;margin-bottom:6px">Request a wholesale quotation</h3>
			<p style="font-size:13px;color:var(--muted2);margin-bottom:22px">Fields marked * are required. We'll reply by email and can continue on WhatsApp.</p>

			<?php if ( 'success' === $status ) : ?>
				<div class="nv-form-alert nv-form-alert-ok">
					<?php echo nv_icon( 'check-circle', 18 ); ?>
					<div><strong>Request received!</strong> We'll send your quotation shortly. For a faster reply, ping us on WhatsApp.</div>
				</div>
			<?php elseif ( 'error' === $status ) : ?>
				<div class="nv-form-alert nv-form-alert-err">
					<?php echo nv_icon( 'alert-triangle', 18 ); ?>
					<div><strong>Something went wrong.</strong> Please try again, or send your request via WhatsApp below.</div>
				</div>
			<?php endif; ?>

			<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="nv-wholesale-form">
				<input type="hidden" name="action" value="nuvirahub_wholesale">
				<?php wp_nonce_field( 'nuvirahub_wholesale', 'nuvirahub_wholesale_nonce' ); ?>

				<div class="nv-form-row">
					<div class="nv-form-group"><label>Company name *</label><input type="text" name="nv_company" id="wh-company" placeholder="Acme Foods Ltd" required></div>
					<div class="nv-form-group"><label>Contact person *</label><input type="text" name="nv_contact" id="wh-contact" placeholder="Jane Smith" required></div>
				</div>

				<div class="nv-form-group"><label>Email address *</label><input type="email" name="nv_email" id="wh-email" placeholder="jane@acmefoods.com" required></div>

				<div class="nv-form-row">
					<div class="nv-form-group"><label>Product required *</label>
						<select name="nv_product" id="wh-product" required>
							<option value="">Select a product…</option>
							<?php foreach ( $nv_products as $p ) : ?>
								<option value="<?php echo esc_attr( $p['name'] ); ?>"><?php echo esc_html( $p['name'] ); ?></option>
							<?php endforeach; ?>
							<option value="Multiple products">Multiple products</option>
							<option value="Other / custom">Other / custom</option>
						</select>
					</div>
					<div class="nv-form-group"><label>Quantity required *</label><input type="text" name="nv_qty" id="wh-qty" placeholder="e.g. 25 kg / month" required></div>
				</div>

				<div class="nv-form-group"><label>Destination country *</label><input type="text" name="nv_country" id="wh-country" placeholder="Latvia" required></div>

				<div class="nv-form-group"><label>Special requirements</label><textarea name="nv_notes" id="wh-notes" placeholder="Packaging, labelling, certifications, delivery schedule, target price…"></textarea></div>

				<div class="nv-wholesale-actions">
					<button class="nv-btn-primary" type="submit">Request Wholesale Quotation</button>
					<a class="nv-btn-ghost nv-wholesale-wa" id="nv-wholesale-wa" href="<?php echo esc_url( nuvirahub_wa_link( 'Hi Nuvira Spice Co.! I would like a wholesale quotation.' ) ); ?>" target="_blank" rel="noopener"><?php echo nv_icon( 'message-circle', 16 ); ?>Send via WhatsApp</a>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
/* Build a WhatsApp deep-link from the live form values (E6). */
(function () {
	var form = document.getElementById('nv-wholesale-form');
	var wa   = document.getElementById('nv-wholesale-wa');
	if (!form || !wa) return;
	var base = <?php echo wp_json_encode( 'https://wa.me/' . NUVIRAHUB_WHATSAPP . '?text=' ); ?>;
	var get = function (id) { var el = document.getElementById(id); return el ? el.value.trim() : ''; };
	wa.addEventListener('click', function (e) {
		var msg = 'Hi Nuvira Spice Co.! I\'d like a wholesale quotation:\n\n'
			+ 'Company: ' + (get('wh-company') || '—') + '\n'
			+ 'Contact: ' + (get('wh-contact') || '—') + '\n'
			+ 'Email: ' + (get('wh-email') || '—') + '\n'
			+ 'Product: ' + (get('wh-product') || '—') + '\n'
			+ 'Quantity: ' + (get('wh-qty') || '—') + '\n'
			+ 'Destination: ' + (get('wh-country') || '—') + '\n'
			+ 'Notes: ' + (get('wh-notes') || '—');
		wa.href = base + encodeURIComponent(msg);
		// let the default anchor open with the freshly-set href
	});
})();
</script>

<?php
get_footer();
