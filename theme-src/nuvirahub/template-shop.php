<?php
/**
 * Template Name: Nuvirahub Shop (Catalogue)
 *
 * E2/E3 — multi-category product catalogue. Products come from the central
 * model (inc/products.php). Category tabs filter the grid client-side
 * (see the shop filter in assets/main.js).
 *
 * @package Nuvirahub
 */

get_header();

$nv_cats     = nuvirahub_product_categories();
$nv_products = nuvirahub_products();

// Only show category tabs that actually have products.
$nv_counts = array();
foreach ( $nv_products as $p ) {
	$nv_counts[ $p['category'] ] = ( $nv_counts[ $p['category'] ] ?? 0 ) + 1;
}

$nv_badge_labels = array(
	'featured'   => 'Featured',
	'bestseller' => 'Best Seller',
	'new'        => 'New',
	'sale'       => 'Sale',
);
$nv_stock_labels = array(
	'in'  => array( 'In stock', 'in' ),
	'low' => array( 'Low stock', 'low' ),
	'out' => array( 'Out of stock', 'out' ),
);
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Shop</div>
	<h1>Ceylon goods,<br><span>shipped worldwide.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">Browse our catalogue across spices, food, tea &amp; coffee, herbal products and more. Single-origin, packed fresh, delivered tracked. Filter by category below.</p>
</div>

<div class="nv-section nv-reveal">

	<!-- Category filter tabs (E2) -->
	<div class="nv-tabs nv-shop-tabs" role="tablist" style="margin:0 auto 36px;justify-self:center">
		<button class="nv-tabp nv-shop-filter active" data-filter="all" type="button">All <span class="nv-shop-count"><?php echo count( $nv_products ); ?></span></button>
		<?php foreach ( $nv_cats as $slug => $label ) : ?>
			<?php if ( ! empty( $nv_counts[ $slug ] ) ) : ?>
				<button class="nv-tabp nv-shop-filter" data-filter="<?php echo esc_attr( $slug ); ?>" type="button"><?php echo esc_html( $label ); ?> <span class="nv-shop-count"><?php echo (int) $nv_counts[ $slug ]; ?></span></button>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

	<!-- Product grid -->
	<div class="nv-shop-grid">
		<?php
		foreach ( $nv_products as $p ) :
			$img      = nuvirahub_product_image_url( $p, 0 );
			$stock    = $nv_stock_labels[ $p['stock'] ] ?? $nv_stock_labels['in'];
			$wa_msg   = sprintf(
				"Hi %s! I'd like to order %s. Please share availability and delivery time. Thanks!",
				NUVIRAHUB_SPICE_BRAND,
				$p['name']
			);
			$wa_link  = nuvirahub_wa_link( $wa_msg );
			?>
			<article class="nv-shop-card" data-cat="<?php echo esc_attr( $p['category'] ); ?>" data-name="<?php echo esc_attr( $p['name'] ); ?>">
				<div class="nv-shop-thumb"<?php echo $img ? '' : ' style="background:' . esc_attr( $p['color'] ?? 'var(--glass2)' ) . '"'; ?>>
					<?php if ( $img ) : ?>
						<div class="nv-shop-thumb-img" style="background-image:url('<?php echo esc_url( $img ); ?>')"></div>
					<?php else : ?>
						<span class="nv-shop-thumb-emoji"><?php echo esc_html( $p['emoji'] ?? '📦' ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $p['badges'] ) ) : ?>
						<div class="nv-shop-badges">
							<?php foreach ( $p['badges'] as $b ) : ?>
								<span class="nv-shop-badge nv-badge-<?php echo esc_attr( $b ); ?>"><?php echo esc_html( $nv_badge_labels[ $b ] ?? $b ); ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<span class="nv-shop-stock nv-stock-<?php echo esc_attr( $stock[1] ); ?>"><?php echo esc_html( $stock[0] ); ?></span>
				</div>
				<div class="nv-shop-body">
					<div class="nv-shop-cat"><?php echo esc_html( $nv_cats[ $p['category'] ] ?? $p['category'] ); ?></div>
					<h3><?php echo esc_html( $p['name'] ); ?></h3>
					<p class="nv-shop-tagline"><?php echo esc_html( $p['tagline'] ?? '' ); ?></p>
					<?php if ( ! empty( $p['origin'] ) ) : ?>
						<div class="nv-shop-meta"><?php echo nv_icon( 'map-pin', 12 ); ?><?php echo esc_html( $p['origin'] ); ?></div>
					<?php endif; ?>
					<div class="nv-shop-foot">
						<span class="nv-shop-price"><?php echo esc_html( 'from ' . NUVIRAHUB_SPICE_CURRENCY . $p['price_from'] ); ?></span>
						<a class="nv-shop-order" href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener"><?php echo nv_icon( 'message-circle', 13 ); ?>Order</a>
					</div>
				</div>
			</article>
		<?php endforeach; ?>

		<!-- Empty state (shown by JS when a filter has no matches) -->
		<div class="nv-shop-empty" hidden>No products in this category yet — <a href="<?php echo esc_url( nuvirahub_wa_link( 'Hi! Do you stock products in this category?' ) ); ?>" target="_blank" rel="noopener">ask us on WhatsApp</a>.</div>
	</div>
</div>

<?php get_footer();
