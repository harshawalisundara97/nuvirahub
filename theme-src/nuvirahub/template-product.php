<?php
/**
 * Template Name: Nuvirahub Product Detail
 *
 * E4 — Single product page rendered at /product/{slug}/.
 * The slug comes from the nv_product query var (see inc/product-routing.php).
 *
 * @package Nuvirahub
 */

get_header();

$slug    = nuvirahub_current_product_slug();
$product = $slug ? nuvirahub_product( $slug ) : null;

// Invalid slug → soft 404 with a link back to the shop.
if ( ! $product ) :
	?>
	<div class="nv-section nv-reveal" style="text-align:center;min-height:50vh;display:flex;flex-direction:column;justify-content:center">
		<div class="nv-tag">Not found</div>
		<h1 class="nv-title">Product not found</h1>
		<p class="nv-sub">That product doesn't exist (yet). Browse the full catalogue:</p>
		<div style="margin-top:24px"><a class="nv-btn-primary" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Back to Shop</a></div>
	</div>
	<?php
	get_footer();
	return;
endif;

$cats    = nuvirahub_product_categories();
$cat_lbl = $cats[ $product['category'] ] ?? $product['category'];
$stocks  = array(
	'in'  => array( 'In stock', 'in' ),
	'low' => array( 'Low stock', 'low' ),
	'out' => array( 'Out of stock', 'out' ),
);
$stock   = $stocks[ $product['stock'] ] ?? $stocks['in'];
$shop_p  = nuvirahub_get_page_by_title( 'Shop' );
$shop_u  = $shop_p ? get_permalink( $shop_p->ID ) : home_url( '/shop/' );

// Related products: same category, exclude self, max 4.
$related = array_values( array_filter(
	nuvirahub_products_by_category( $product['category'] ),
	static function ( $p ) use ( $product ) {
		return $p['slug'] !== $product['slug'];
	}
) );
$related = array_slice( $related, 0, 4 );

// Pre-build WhatsApp order link for the default (first) weight option.
$default_opt   = $product['options'][0] ?? array( 'weight' => '', 'price' => '' );
$default_total = number_format( (float) $default_opt['price'], 2 );
$wa_default    = nuvirahub_wa_link( sprintf(
	"Hi %s! I'd like to order:\n\n%s\nWeight: %s\nQuantity: 1\nUnit price: %s%s\nSubtotal: %s%s\n\nPlease confirm availability and delivery time. Thanks!",
	NUVIRAHUB_SPICE_BRAND,
	$product['name'],
	$default_opt['weight'],
	NUVIRAHUB_SPICE_CURRENCY,
	$default_opt['price'],
	NUVIRAHUB_SPICE_CURRENCY,
	$default_total
) );
$wa_bulk = nuvirahub_wa_link( sprintf(
	"Hi %s! I'd like wholesale pricing for %s. My estimated quantity is __ kg, shipping to __. Thanks!",
	NUVIRAHUB_SPICE_BRAND,
	$product['name']
) );
$main_img = nuvirahub_product_image_url( $product, 0 );
?>

<div class="nv-product-page nv-reveal"
	data-slug="<?php echo esc_attr( $product['slug'] ); ?>"
	data-name="<?php echo esc_attr( $product['name'] ); ?>"
	data-brand="<?php echo esc_attr( NUVIRAHUB_SPICE_BRAND ); ?>"
	data-currency="<?php echo esc_attr( NUVIRAHUB_SPICE_CURRENCY ); ?>"
	data-wa-base="<?php echo esc_attr( 'https://wa.me/' . NUVIRAHUB_WHATSAPP . '?text=' ); ?>">

	<!-- Breadcrumbs -->
	<nav class="nv-breadcrumbs" aria-label="Breadcrumb">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
		<span class="nv-breadcrumb-sep">›</span>
		<a href="<?php echo esc_url( $shop_u ); ?>">Shop</a>
		<span class="nv-breadcrumb-sep">›</span>
		<a href="<?php echo esc_url( $shop_u . '?cat=' . $product['category'] ); ?>"><?php echo esc_html( $cat_lbl ); ?></a>
		<span class="nv-breadcrumb-sep">›</span>
		<span aria-current="page"><?php echo esc_html( $product['name'] ); ?></span>
	</nav>

	<div class="nv-product-grid">
		<!-- Gallery -->
		<div class="nv-product-gallery">
			<div class="nv-product-main"<?php echo $main_img ? '' : ' style="background:' . esc_attr( $product['color'] ?? 'var(--glass2)' ) . '"'; ?>>
				<?php if ( $main_img ) : ?>
					<img class="nv-product-main-img" src="<?php echo esc_url( $main_img ); ?>" alt="<?php echo esc_attr( $product['name'] ); ?>">
				<?php else : ?>
					<span class="nv-product-main-emoji"><?php echo esc_html( $product['emoji'] ?? '📦' ); ?></span>
				<?php endif; ?>
				<?php if ( ! empty( $product['badges'] ) ) : ?>
					<div class="nv-product-badges">
						<?php
						$badge_labels = array(
							'featured'   => 'Featured',
							'bestseller' => 'Best Seller',
							'new'        => 'New',
							'sale'       => 'Sale',
						);
						foreach ( $product['badges'] as $b ) :
							?>
							<span class="nv-shop-badge nv-badge-<?php echo esc_attr( $b ); ?>"><?php echo esc_html( $badge_labels[ $b ] ?? $b ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $product['gallery'] ) && count( $product['gallery'] ) > 1 ) : ?>
				<div class="nv-product-thumbs">
					<?php foreach ( $product['gallery'] as $i => $file ) :
						$tu = nuvirahub_product_image_url( $product, $i );
						if ( ! $tu ) continue; ?>
						<button class="nv-product-thumb <?php echo $i === 0 ? 'active' : ''; ?>" type="button"
							data-img="<?php echo esc_url( $tu ); ?>"
							aria-label="Show image <?php echo (int) ( $i + 1 ); ?>">
							<img src="<?php echo esc_url( $tu ); ?>" alt="">
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<!-- Info column -->
		<div class="nv-product-info">
			<div class="nv-product-meta-top">
				<a class="nv-product-cat" href="<?php echo esc_url( $shop_u . '?cat=' . $product['category'] ); ?>"><?php echo esc_html( $cat_lbl ); ?></a>
				<span class="nv-shop-stock nv-stock-<?php echo esc_attr( $stock[1] ); ?>"><?php echo esc_html( $stock[0] ); ?></span>
			</div>

			<h1 class="nv-product-name"><?php echo esc_html( $product['name'] ); ?></h1>
			<?php if ( ! empty( $product['tagline'] ) ) : ?>
				<p class="nv-product-tagline"><?php echo esc_html( $product['tagline'] ); ?></p>
			<?php endif; ?>

			<?php if ( ! empty( $product['rating']['count'] ) ) : ?>
				<a class="nv-product-rating-link" href="#reviews">
					<?php echo nuvirahub_stars( $product['rating']['avg'], 16 ); ?>
					<span class="nv-product-rating-text">
						<strong><?php echo esc_html( number_format( $product['rating']['avg'], 1 ) ); ?></strong>
						<span class="nv-product-rating-sep">·</span>
						<?php echo (int) $product['rating']['count']; ?> review<?php echo $product['rating']['count'] === 1 ? '' : 's'; ?>
					</span>
				</a>
			<?php endif; ?>

			<!-- Price -->
			<div class="nv-product-price-row">
				<span class="nv-product-price" id="nv-product-price"><?php echo esc_html( NUVIRAHUB_SPICE_CURRENCY . $default_opt['price'] ); ?></span>
				<span class="nv-product-price-unit">/ <span id="nv-product-weight"><?php echo esc_html( $default_opt['weight'] ); ?></span></span>
				<a class="nv-shop-wholesale" href="<?php echo esc_url( $wa_bulk ); ?>" target="_blank" rel="noopener">Bulk pricing</a>
			</div>

			<!-- Weight options -->
			<?php if ( count( $product['options'] ) > 1 ) : ?>
				<div class="nv-product-opts-label">Choose weight</div>
				<div class="nv-product-opts" role="radiogroup" aria-label="Weight option">
					<?php foreach ( $product['options'] as $i => $opt ) : ?>
						<button class="nv-product-opt <?php echo $i === 0 ? 'active' : ''; ?>" type="button"
							role="radio" aria-checked="<?php echo $i === 0 ? 'true' : 'false'; ?>"
							data-weight="<?php echo esc_attr( $opt['weight'] ); ?>"
							data-price="<?php echo esc_attr( $opt['price'] ); ?>"
							data-bulk="<?php echo esc_attr( $opt['bulk_price'] ?? '' ); ?>">
							<span class="nv-opt-weight"><?php echo esc_html( $opt['weight'] ); ?></span>
							<span class="nv-opt-price"><?php echo esc_html( NUVIRAHUB_SPICE_CURRENCY . $opt['price'] ); ?></span>
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<!-- Quantity stepper -->
			<div class="nv-product-qty">
				<span class="nv-product-qty-label">Quantity</span>
				<div class="nv-product-stepper">
					<button class="nv-step nv-step-down" type="button" aria-label="Decrease">−</button>
					<input id="nv-product-qty" type="number" value="1" min="1" max="99" aria-label="Quantity">
					<button class="nv-step nv-step-up" type="button" aria-label="Increase">+</button>
				</div>
				<div class="nv-product-subtotal">
					Subtotal <strong id="nv-product-subtotal"><?php echo esc_html( NUVIRAHUB_SPICE_CURRENCY . $default_total ); ?></strong>
				</div>
			</div>

			<!-- Actions -->
			<div class="nv-product-actions">
				<a class="nv-btn-primary nv-product-order" id="nv-product-order" href="<?php echo esc_url( $wa_default ); ?>" target="_blank" rel="noopener">
					<?php echo nv_icon( 'message-circle', 16 ); ?>Order on WhatsApp
				</a>
				<button class="nv-product-icon-btn nv-shop-wishlist" type="button" data-slug="<?php echo esc_attr( $product['slug'] ); ?>" aria-label="Add to wishlist" aria-pressed="false" title="Add to wishlist">
					<svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
						<path d="M12.1 8.64l-.1.1-.1-.1a4 4 0 1 0-5.66 5.66l5.05 5.06a1 1 0 0 0 1.42 0l5.06-5.06a4 4 0 0 0-5.67-5.66z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
					</svg>
				</button>
				<button class="nv-product-icon-btn nv-product-share" type="button" aria-label="Share product" title="Share">
					<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/>
						<line x1="8.6" y1="13.5" x2="15.4" y2="17.5"/><line x1="15.4" y1="6.5" x2="8.6" y2="10.5"/>
					</svg>
				</button>
			</div>

			<!-- At-a-glance facts -->
			<dl class="nv-product-facts">
				<?php if ( ! empty( $product['sku'] ) ) : ?>
					<div><dt>SKU</dt><dd><?php echo esc_html( $product['sku'] ); ?></dd></div>
				<?php endif; ?>
				<?php if ( ! empty( $product['origin'] ) ) : ?>
					<div><dt>Origin</dt><dd><?php echo esc_html( $product['origin'] ); ?></dd></div>
				<?php endif; ?>
				<?php if ( ! empty( $product['country'] ) ) : ?>
					<div><dt>Country</dt><dd><?php echo esc_html( $product['country'] ); ?></dd></div>
				<?php endif; ?>
				<?php if ( ! empty( $product['certificates'] ) ) : ?>
					<div><dt>Certificates</dt><dd><?php echo esc_html( implode( ', ', $product['certificates'] ) ); ?></dd></div>
				<?php endif; ?>
			</dl>
		</div>
	</div>

	<!-- Tabs -->
	<div class="nv-product-tabs nv-reveal">
		<div class="nv-product-tablist" role="tablist">
			<button class="nv-product-tab active" role="tab" aria-selected="true" data-tab="desc">Description</button>
			<button class="nv-product-tab" role="tab" aria-selected="false" data-tab="specs">Specifications</button>
			<button class="nv-product-tab" role="tab" aria-selected="false" data-tab="shipping">Shipping</button>
			<button class="nv-product-tab" role="tab" aria-selected="false" data-tab="reviews" id="nv-tab-reviews">Reviews <?php echo $product['rating']['count'] ? '(' . (int) $product['rating']['count'] . ')' : ''; ?></button>
		</div>

		<div class="nv-product-tabpanel active" data-panel="desc">
			<p><?php echo esc_html( $product['desc'] ); ?></p>
			<?php if ( ! empty( $product['features'] ) ) : ?>
				<h3>Features &amp; benefits</h3>
				<ul class="nv-product-features">
					<?php foreach ( $product['features'] as $f ) : ?>
						<li><?php echo esc_html( $f ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if ( ! empty( $product['tags'] ) ) : ?>
				<div class="nv-tags" style="margin-top:18px">
					<?php foreach ( $product['tags'] as $t ) : ?>
						<span class="nv-tag-pill"><?php echo esc_html( $t ); ?></span>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="nv-product-tabpanel" data-panel="specs" hidden>
			<dl class="nv-spec-table">
				<?php if ( ! empty( $product['sku'] ) ) : ?>
					<div><dt>SKU</dt><dd><?php echo esc_html( $product['sku'] ); ?></dd></div>
				<?php endif; ?>
				<?php if ( ! empty( $product['origin'] ) ) : ?>
					<div><dt>Origin</dt><dd><?php echo esc_html( $product['origin'] ); ?></dd></div>
				<?php endif; ?>
				<?php if ( ! empty( $product['country'] ) ) : ?>
					<div><dt>Country of origin</dt><dd><?php echo esc_html( $product['country'] ); ?></dd></div>
				<?php endif; ?>
				<?php if ( ! empty( $product['packaging'] ) ) : ?>
					<div><dt>Packaging</dt><dd><?php echo esc_html( $product['packaging'] ); ?></dd></div>
				<?php endif; ?>
				<?php if ( ! empty( $product['options'] ) ) : ?>
					<div><dt>Available weights</dt><dd><?php echo esc_html( implode( ', ', array_column( $product['options'], 'weight' ) ) ); ?></dd></div>
				<?php endif; ?>
				<?php if ( ! empty( $product['certificates'] ) ) : ?>
					<div><dt>Certificates</dt><dd><?php echo esc_html( implode( ', ', $product['certificates'] ) ); ?></dd></div>
				<?php endif; ?>
				<div><dt>Stock</dt><dd><?php echo esc_html( $stock[0] ); ?></dd></div>
			</dl>
		</div>

		<div class="nv-product-tabpanel" data-panel="reviews" id="reviews" hidden>
			<?php
			$review_wa = nuvirahub_wa_link( sprintf(
				"Hi %s! I'd like to leave a review for %s:\n\nRating (1-5): \nMy review: \n\nThanks!",
				NUVIRAHUB_SPICE_BRAND,
				$product['name']
			) );
			?>
			<?php if ( $product['rating']['count'] > 0 ) : ?>
				<div class="nv-reviews-summary">
					<div class="nv-reviews-summary-score">
						<span class="nv-reviews-avg"><?php echo esc_html( number_format( $product['rating']['avg'], 1 ) ); ?></span>
						<span class="nv-reviews-of5">/ 5</span>
					</div>
					<div>
						<?php echo nuvirahub_stars( $product['rating']['avg'], 20 ); ?>
						<div class="nv-reviews-count"><?php echo (int) $product['rating']['count']; ?> review<?php echo $product['rating']['count'] === 1 ? '' : 's'; ?></div>
					</div>
					<a class="nv-btn-primary nv-reviews-cta" href="<?php echo esc_url( $review_wa ); ?>" target="_blank" rel="noopener">
						<?php echo nv_icon( 'message-circle', 14 ); ?>Write a review
					</a>
				</div>

				<ul class="nv-review-list">
					<?php foreach ( $product['reviews'] as $r ) :
						$rdate = ! empty( $r['date'] ) ? date_i18n( 'F j, Y', strtotime( $r['date'] ) ) : '';
						$init  = mb_strtoupper( mb_substr( $r['author'] ?? 'A', 0, 1 ) );
						?>
						<li class="nv-review">
							<div class="nv-review-head">
								<div class="nv-review-avatar"><?php echo esc_html( $init ); ?></div>
								<div class="nv-review-meta">
									<div class="nv-review-author">
										<?php echo esc_html( $r['author'] ?? 'Anonymous' ); ?>
										<?php if ( ! empty( $r['verified'] ) ) : ?>
											<span class="nv-review-verified" title="Verified buyer">
												<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
												Verified buyer
											</span>
										<?php endif; ?>
									</div>
									<div class="nv-review-sub">
										<?php echo nuvirahub_stars( (float) ( $r['rating'] ?? 0 ), 12 ); ?>
										<?php if ( $rdate ) : ?><span class="nv-review-sub-sep">·</span><span class="nv-review-date"><?php echo esc_html( $rdate ); ?></span><?php endif; ?>
										<?php if ( ! empty( $r['location'] ) ) : ?><span class="nv-review-sub-sep">·</span><span class="nv-review-location"><?php echo esc_html( $r['location'] ); ?></span><?php endif; ?>
									</div>
								</div>
							</div>
							<?php if ( ! empty( $r['title'] ) ) : ?>
								<h4 class="nv-review-title"><?php echo esc_html( $r['title'] ); ?></h4>
							<?php endif; ?>
							<p class="nv-review-text"><?php echo esc_html( $r['text'] ?? '' ); ?></p>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<div class="nv-reviews-empty">
					<div class="nv-reviews-empty-icon"><?php echo nv_icon( 'message-circle', 28 ); ?></div>
					<h3>No reviews yet</h3>
					<p>Be the first to share what you think about <?php echo esc_html( $product['name'] ); ?>. We collect reviews over WhatsApp — same-day reply.</p>
					<a class="nv-btn-primary" href="<?php echo esc_url( $review_wa ); ?>" target="_blank" rel="noopener">
						<?php echo nv_icon( 'message-circle', 14 ); ?>Write the first review
					</a>
				</div>
			<?php endif; ?>
		</div>

		<div class="nv-product-tabpanel" data-panel="shipping" hidden>
			<p><?php echo esc_html( $product['shipping'] ?? 'Tracked international shipping. Contact us on WhatsApp for a delivery quote to your country.' ); ?></p>
			<ul class="nv-product-features">
				<li>Packed within 14 days of harvest where applicable</li>
				<li>Vacuum-sealed to lock in oils and aroma</li>
				<li>Tracked courier — typically 5–8 business days within Europe</li>
				<li>EU duties &amp; VAT included where shown</li>
			</ul>
		</div>
	</div>

	<!-- Related products -->
	<?php if ( ! empty( $related ) ) : ?>
		<div class="nv-product-related nv-reveal">
			<h2 class="nv-title" style="font-size:24px;text-align:left;margin-bottom:20px">You may also like</h2>
			<div class="nv-shop-grid" style="grid-template-columns:repeat(auto-fill,minmax(220px,1fr))">
				<?php
				$badge_labels = array( 'featured' => 'Featured', 'bestseller' => 'Best Seller', 'new' => 'New', 'sale' => 'Sale' );
				foreach ( $related as $r ) :
					$rimg = nuvirahub_product_image_url( $r, 0 );
					$rurl = home_url( '/product/' . $r['slug'] . '/' );
					?>
					<article class="nv-shop-card">
						<a class="nv-shop-thumb-link" href="<?php echo esc_url( $rurl ); ?>">
							<div class="nv-shop-thumb"<?php echo $rimg ? '' : ' style="background:' . esc_attr( $r['color'] ?? 'var(--glass2)' ) . '"'; ?>>
								<?php if ( $rimg ) : ?>
									<div class="nv-shop-thumb-img" style="background-image:url('<?php echo esc_url( $rimg ); ?>')"></div>
								<?php else : ?>
									<span class="nv-shop-thumb-emoji"><?php echo esc_html( $r['emoji'] ?? '📦' ); ?></span>
								<?php endif; ?>
							</div>
						</a>
						<div class="nv-shop-body">
							<a class="nv-shop-title-link" href="<?php echo esc_url( $rurl ); ?>"><h3><?php echo esc_html( $r['name'] ); ?></h3></a>
							<div class="nv-shop-foot">
								<span class="nv-shop-price"><?php echo esc_html( 'from ' . NUVIRAHUB_SPICE_CURRENCY . $r['price_from'] ); ?></span>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</div>

<!-- Mobile sticky bar -->
<div class="nv-product-stickybar" aria-hidden="true">
	<div>
		<div class="nv-stickybar-name"><?php echo esc_html( $product['name'] ); ?></div>
		<div class="nv-stickybar-price" id="nv-stickybar-price"><?php echo esc_html( NUVIRAHUB_SPICE_CURRENCY . $default_total ); ?></div>
	</div>
	<a class="nv-btn-primary nv-stickybar-cta" id="nv-stickybar-order" href="<?php echo esc_url( $wa_default ); ?>" target="_blank" rel="noopener">
		<?php echo nv_icon( 'message-circle', 16 ); ?>Order
	</a>
</div>

<?php get_footer();
