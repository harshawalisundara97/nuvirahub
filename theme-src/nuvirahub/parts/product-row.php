<?php
/**
 * Merchandising product row (E7).
 *
 * Renders a horizontal row of compact product cards for a badge group
 * (featured / bestseller / new / sale) or an explicit product list.
 * Auto-hides when there are no matching products.
 *
 * Usage:
 *   get_template_part( 'parts/product-row', null, array(
 *     'badge'     => 'bestseller',
 *     'eyebrow'   => 'Nuvira Spice Co.',
 *     'title'     => 'Best sellers',
 *     'cta_url'   => home_url( '/shop/' ),
 *     'cta_label' => 'Shop all',
 *   ) );
 *
 * @package Nuvirahub
 */

$args  = wp_parse_args(
	$args ?? array(),
	array(
		'badge'     => '',
		'products'  => null,
		'eyebrow'   => '',
		'title'     => '',
		'cta_url'   => '',
		'cta_label' => 'Shop all',
		'limit'     => 8,
	)
);

$items = is_array( $args['products'] )
	? $args['products']
	: ( $args['badge'] ? nuvirahub_products_with_badge( $args['badge'] ) : array() );

if ( empty( $items ) ) {
	return; // nothing to surface — render nothing
}

$items = array_slice( $items, 0, (int) $args['limit'] );

$badge_labels = array(
	'featured'   => 'Featured',
	'bestseller' => 'Best Seller',
	'new'        => 'New',
	'sale'       => 'Sale',
);
?>
<div class="nv-merch nv-reveal">
	<div class="nv-merch-head">
		<div>
			<?php if ( $args['eyebrow'] ) : ?>
				<div class="nv-tag" style="margin-bottom:8px"><?php echo esc_html( $args['eyebrow'] ); ?></div>
			<?php endif; ?>
			<h2 class="nv-merch-title"><?php echo esc_html( $args['title'] ); ?></h2>
		</div>
		<?php if ( $args['cta_url'] ) : ?>
			<a class="nv-merch-cta" href="<?php echo esc_url( $args['cta_url'] ); ?>">
				<?php echo esc_html( $args['cta_label'] ); ?> <span aria-hidden="true">→</span>
			</a>
		<?php endif; ?>
	</div>

	<div class="nv-merch-row">
		<?php foreach ( $items as $p ) :
			$img  = nuvirahub_product_image_url( $p, 0 );
			$url  = home_url( '/product/' . $p['slug'] . '/' );
			?>
			<a class="nv-merch-card" href="<?php echo esc_url( $url ); ?>">
				<div class="nv-merch-thumb"<?php echo $img ? '' : ' style="background:' . esc_attr( $p['color'] ?? 'var(--glass2)' ) . '"'; ?>>
					<?php if ( $img ) : ?>
						<div class="nv-merch-thumb-img" style="background-image:url('<?php echo esc_url( $img ); ?>')"></div>
					<?php else : ?>
						<span class="nv-merch-thumb-emoji"><?php echo esc_html( $p['emoji'] ?? '📦' ); ?></span>
					<?php endif; ?>
					<?php if ( ! empty( $p['badges'] ) ) : ?>
						<span class="nv-shop-badge nv-badge-<?php echo esc_attr( $p['badges'][0] ); ?> nv-merch-badge"><?php echo esc_html( $badge_labels[ $p['badges'][0] ] ?? $p['badges'][0] ); ?></span>
					<?php endif; ?>
				</div>
				<div class="nv-merch-body">
					<h3 class="nv-merch-name"><?php echo esc_html( $p['name'] ); ?></h3>
					<?php if ( ! empty( $p['rating']['count'] ) ) : ?>
						<div class="nv-merch-rating"><?php echo nuvirahub_stars( $p['rating']['avg'], 12 ); ?><span><?php echo esc_html( number_format( $p['rating']['avg'], 1 ) ); ?></span></div>
					<?php endif; ?>
					<div class="nv-merch-price"><?php echo esc_html( 'from ' . NUVIRAHUB_SPICE_CURRENCY . $p['price_from'] ); ?></div>
				</div>
			</a>
		<?php endforeach; ?>
	</div>
</div>
