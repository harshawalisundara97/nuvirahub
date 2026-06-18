<?php
/**
 * Template Name: Nuvirahub Shop (Catalogue)
 *
 * E2/E3 — multi-category product catalogue. Products come from the central
 * model (inc/products.php). Category tabs filter the grid client-side
 * (see the shop filter in assets/main.js).
 *
 * E3 additions: search box (live), sort dropdown, wishlist heart
 * (localStorage), per-card wholesale link, breadcrumbs, result count.
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

$nv_wholesale = nuvirahub_get_page_by_title( 'Wholesale' );
$nv_wholesale_url = $nv_wholesale ? get_permalink( $nv_wholesale->ID ) : '';
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Shop</div>
	<h1>Ceylon goods,<br><span>shipped worldwide.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">Browse our catalogue across spices, food, tea &amp; coffee, herbal products and more. Single-origin, packed fresh, delivered tracked.</p>
</div>

<div class="nv-section nv-reveal" id="catalog">

	<!-- Breadcrumbs -->
	<nav class="nv-breadcrumbs" aria-label="Breadcrumb">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
		<span class="nv-breadcrumb-sep">›</span>
		<span aria-current="page">Shop</span>
	</nav>

	<!-- Category filter tabs (E2) -->
	<div class="nv-tabs nv-shop-tabs" role="tablist">
		<button class="nv-tabp nv-shop-filter active" data-filter="all" type="button">All <span class="nv-shop-count"><?php echo count( $nv_products ); ?></span></button>
		<?php foreach ( $nv_cats as $slug => $label ) : ?>
			<?php if ( ! empty( $nv_counts[ $slug ] ) ) : ?>
				<button class="nv-tabp nv-shop-filter" data-filter="<?php echo esc_attr( $slug ); ?>" type="button"><?php echo esc_html( $label ); ?> <span class="nv-shop-count"><?php echo (int) $nv_counts[ $slug ]; ?></span></button>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

	<!-- E3 toolbar: search · sort · result count -->
	<div class="nv-shop-toolbar">
		<label class="nv-shop-search" aria-label="Search products">
			<?php echo nv_icon( 'search', 16 ); ?>
			<input type="search" id="nv-shop-search" placeholder="Search products, origin or tags…" autocomplete="off">
		</label>
		<div class="nv-shop-sort">
			<label for="nv-shop-sort" class="nv-shop-sort-label">Sort by</label>
			<select id="nv-shop-sort">
				<option value="featured">Featured</option>
				<option value="price-asc">Price · low → high</option>
				<option value="price-desc">Price · high → low</option>
				<option value="name-asc">Name · A → Z</option>
			</select>
		</div>
		<div class="nv-shop-result-count" aria-live="polite"><span id="nv-shop-shown"><?php echo count( $nv_products ); ?></span> of <?php echo count( $nv_products ); ?> products</div>
	</div>

	<!-- Product grid -->
	<div class="nv-shop-grid" id="nv-shop-grid">
		<?php
		$nv_sort_index = 0;
		foreach ( $nv_products as $p ) :
			$img        = nuvirahub_product_image_url( $p, 0 );
			$stock      = $nv_stock_labels[ $p['stock'] ] ?? $nv_stock_labels['in'];
			$is_feat    = in_array( 'featured', (array) $p['badges'], true );
			$is_best    = in_array( 'bestseller', (array) $p['badges'], true );
			$is_new     = in_array( 'new', (array) $p['badges'], true );
			$is_sale    = in_array( 'sale', (array) $p['badges'], true );
			// Featured-sort weight: featured > bestseller > new > rest
			$feat_rank  = $is_feat ? 0 : ( $is_best ? 1 : ( $is_new ? 2 : 3 ) );
			$detail_url = home_url( '/product/' . $p['slug'] . '/' );
			$wa_msg     = sprintf(
				"Hi %s! I'd like to order %s. Please share availability and delivery time. Thanks!",
				NUVIRAHUB_SPICE_BRAND,
				$p['name']
			);
			$wa_link    = nuvirahub_wa_link( $wa_msg );
			$bulk_msg   = sprintf(
				"Hi %s! I'd like wholesale pricing for %s. My estimated quantity is __ kg, shipping to __. Thanks!",
				NUVIRAHUB_SPICE_BRAND,
				$p['name']
			);
			$bulk_link  = nuvirahub_wa_link( $bulk_msg );
			$search_str = strtolower( implode( ' ', array(
				$p['name'],
				$p['tagline'] ?? '',
				$p['origin'] ?? '',
				$nv_cats[ $p['category'] ] ?? '',
				implode( ' ', (array) ( $p['tags'] ?? array() ) ),
			) ) );
			$nv_sort_index++;
			?>
			<article class="nv-shop-card"
				data-cat="<?php echo esc_attr( $p['category'] ); ?>"
				data-name="<?php echo esc_attr( $p['name'] ); ?>"
				data-slug="<?php echo esc_attr( $p['slug'] ); ?>"
				data-search="<?php echo esc_attr( $search_str ); ?>"
				data-price="<?php echo esc_attr( $p['price_from'] ); ?>"
				data-feat-rank="<?php echo (int) $feat_rank; ?>"
				data-orig-index="<?php echo (int) $nv_sort_index; ?>"
				style="order:<?php echo (int) $nv_sort_index; ?>">
				<a class="nv-shop-thumb-link" href="<?php echo esc_url( $detail_url ); ?>" aria-label="View <?php echo esc_attr( $p['name'] ); ?> details">
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
						<span class="nv-shop-overlay-cta">View details →</span>
					</div>
				</a>
				<button class="nv-shop-wishlist" type="button" data-slug="<?php echo esc_attr( $p['slug'] ); ?>" aria-label="Add <?php echo esc_attr( $p['name'] ); ?> to wishlist" aria-pressed="false" title="Add to wishlist">
					<svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
						<path d="M12.1 8.64l-.1.1-.1-.1a4 4 0 1 0-5.66 5.66l5.05 5.06a1 1 0 0 0 1.42 0l5.06-5.06a4 4 0 0 0-5.67-5.66z"
						      fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
					</svg>
				</button>
				<div class="nv-shop-body">
					<div class="nv-shop-cat"><?php echo esc_html( $nv_cats[ $p['category'] ] ?? $p['category'] ); ?></div>
					<a class="nv-shop-title-link" href="<?php echo esc_url( $detail_url ); ?>"><h3><?php echo esc_html( $p['name'] ); ?></h3></a>
					<p class="nv-shop-tagline"><?php echo esc_html( $p['tagline'] ?? '' ); ?></p>
					<?php if ( ! empty( $p['origin'] ) ) : ?>
						<div class="nv-shop-meta"><?php echo nv_icon( 'map-pin', 12 ); ?><?php echo esc_html( $p['origin'] ); ?></div>
					<?php endif; ?>
					<div class="nv-shop-foot">
						<div>
							<span class="nv-shop-price"><?php echo esc_html( 'from ' . NUVIRAHUB_SPICE_CURRENCY . $p['price_from'] ); ?></span>
							<a class="nv-shop-wholesale" href="<?php echo esc_url( $bulk_link ); ?>" target="_blank" rel="noopener" title="Request wholesale pricing">Bulk</a>
						</div>
						<a class="nv-shop-order" href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener"><?php echo nv_icon( 'message-circle', 13 ); ?>Order</a>
					</div>
				</div>
			</article>
		<?php endforeach; ?>

		<!-- Empty state (shown by JS when filter/search yields no matches) -->
		<div class="nv-shop-empty" hidden>
			<p>No products match your filters yet.</p>
			<p><a href="<?php echo esc_url( nuvirahub_wa_link( 'Hi! Do you stock products like this?' ) ); ?>" target="_blank" rel="noopener">Ask us on WhatsApp</a> &nbsp;·&nbsp; <button type="button" class="nv-shop-reset" id="nv-shop-reset">Reset filters</button></p>
		</div>
	</div>
</div>

<?php get_footer();
