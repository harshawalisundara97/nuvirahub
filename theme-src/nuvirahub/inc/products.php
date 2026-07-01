<?php
/**
 * Product data model (E1) — single source of truth for the shop.
 *
 * Pure-PHP catalogue (no WooCommerce). Every shop surface — catalogue grid,
 * product detail, merchandising rows, wholesale form — reads from here via the
 * helper functions at the bottom. Add products by appending to the array in
 * nuvirahub_products_raw(); add categories in nuvirahub_product_categories().
 *
 * Per-product fields:
 *   slug, name, sku, category, tagline, origin, country, desc,
 *   features[], specs{label=>value}, packaging, certificates[], nutrition (opt),
 *   shipping, stock ('in'|'low'|'out'), badges[] (featured|bestseller|new|sale),
 *   tags[], emoji, color (gradient fallback), gallery[] (filenames in
 *   assets/img/products/{category}/), options[] {weight, price, bulk_price?}.
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Category registry — slug => label. Order = display order.
 *
 * @return array<string,string>
 */
function nuvirahub_product_categories() {
	return apply_filters(
		'nuvirahub_product_categories',
		array(
			'spices'    => 'Spices',
			'food'      => 'Food Products',
			'tea-coffee' => 'Tea & Coffee',
			'herbal'    => 'Herbal Products',
			'logistics' => 'Logistics Equipment',
			'other'     => 'Other Business Products',
		)
	);
}

/**
 * Raw product list. Edit here to add/remove products or change prices.
 *
 * @return array<int,array>
 */
function nuvirahub_products_raw() {
	$spices = array(
		array(
			'slug'    => 'ceylon-cinnamon',
			'name'    => 'Ceylon Cinnamon',
			'tagline' => 'True cinnamon — sweet, delicate, premium',
			'origin'  => 'Negombo · Galle',
			'emoji'   => '🪵',
			'color'   => 'linear-gradient(135deg, #d97706, #92400e)',
			'desc'    => 'Hand-rolled quills of pure Cinnamomum verum — softer, sweeter, less harsh than the cassia sold in European supermarkets. The real thing.',
			'features' => array( 'Pure Cinnamomum verum (true cinnamon)', 'Hand-rolled whole quills', 'Sweeter & milder than cassia' ),
			'tags'    => array( 'Premium', 'Organic', 'Whole quills' ),
			'badges'  => array( 'bestseller', 'featured' ),
			'certificates' => array( 'Organic' ),
			'options' => array(
				array( 'weight' => '100g', 'price' => '6.50' ),
				array( 'weight' => '250g', 'price' => '14.00' ),
				array( 'weight' => '500g', 'price' => '26.00' ),
			),
		),
		array(
			'slug'    => 'black-pepper',
			'name'    => 'Ceylon Black Pepper',
			'tagline' => 'Sun-dried whole peppercorns',
			'origin'  => 'Matale · Kandy',
			'emoji'   => '⚫',
			'color'   => 'linear-gradient(135deg, #292524, #44403c)',
			'desc'    => 'Plump, aromatic, bursting with heat and citrus notes. Grind fresh for the best flavour. Far more vibrant than supermarket pepper.',
			'features' => array( 'Plump, oil-rich peppercorns', 'Heat with citrus top-notes', 'Best ground fresh' ),
			'tags'    => array( 'Whole', 'Strong aroma' ),
			'badges'  => array( 'bestseller' ),
			'options' => array(
				array( 'weight' => '100g', 'price' => '3.50' ),
				array( 'weight' => '250g', 'price' => '7.50' ),
				array( 'weight' => '500g', 'price' => '13.50' ),
			),
		),
		array(
			'slug'    => 'cardamom',
			'name'    => 'Green Cardamom',
			'tagline' => 'The "queen of spices"',
			'origin'  => 'Knuckles Range',
			'emoji'   => '🟢',
			'color'   => 'linear-gradient(135deg, #16a34a, #166534)',
			'desc'    => 'Hand-picked green pods with intensely floral, citrus-laced seeds inside. Essential for chai, biryani, baking, and Scandinavian sweet breads.',
			'features' => array( 'Hand-picked whole green pods', 'Intensely floral & citrus', 'Perfect for chai & baking' ),
			'tags'    => array( 'Whole pods', 'Aromatic' ),
			'badges'  => array( 'featured' ),
			'certificates' => array( 'Organic' ),
			'options' => array(
				array( 'weight' => '50g',  'price' => '7.00' ),
				array( 'weight' => '100g', 'price' => '13.00' ),
				array( 'weight' => '250g', 'price' => '30.00' ),
			),
		),
		array(
			'slug'    => 'cloves',
			'name'    => 'Ceylon Cloves',
			'tagline' => 'Warming, sweet, intensely fragrant',
			'origin'  => 'Matale',
			'emoji'   => '🌰',
			'color'   => 'linear-gradient(135deg, #78350f, #422006)',
			'desc'    => 'Whole sun-dried buds with high eugenol oil content. Mulled wine, gingerbread, savoury stews — a tiny pinch goes a long way.',
			'features' => array( 'High eugenol oil content', 'Whole sun-dried buds', 'A little goes a long way' ),
			'tags'    => array( 'Whole', 'High oil' ),
			'options' => array(
				array( 'weight' => '50g',  'price' => '4.50' ),
				array( 'weight' => '100g', 'price' => '8.00' ),
				array( 'weight' => '250g', 'price' => '18.00' ),
			),
		),
		array(
			'slug'    => 'nutmeg-mace',
			'name'    => 'Nutmeg & Mace',
			'tagline' => 'Two spices, one nut',
			'origin'  => 'Kandy hills',
			'emoji'   => '🥜',
			'color'   => 'linear-gradient(135deg, #b45309, #7c2d12)',
			'desc'    => 'Whole nutmeg with bright red mace lacing — grate fresh for béchamel, custards, pumpkin pie, and Latvian Christmas piparkūkas.',
			'features' => array( 'Whole nutmeg + red mace', 'Grate fresh for best aroma', 'Sweet & savoury baking' ),
			'tags'    => array( 'Whole nuts', 'With mace' ),
			'options' => array(
				array( 'weight' => '50g',  'price' => '5.50' ),
				array( 'weight' => '100g', 'price' => '10.00' ),
				array( 'weight' => '250g', 'price' => '23.00' ),
			),
		),
		array(
			'slug'    => 'chilli-powder',
			'name'    => 'Ceylon Chilli Powder',
			'tagline' => 'Smoky red heat, deep colour',
			'origin'  => 'Jaffna · Nuwara Eliya',
			'emoji'   => '🌶️',
			'color'   => 'linear-gradient(135deg, #dc2626, #7f1d1d)',
			'desc'    => 'Sun-dried bird\'s eye chillies, stone-milled to a rich red powder. Warmer and more aromatic than the bland European kind. Heat: 7/10.',
			'features' => array( 'Stone-milled bird\'s eye chilli', 'Rich red colour', 'Heat level 7/10' ),
			'tags'    => array( 'Stone-milled', 'Smoky' ),
			'options' => array(
				array( 'weight' => '100g', 'price' => '3.00' ),
				array( 'weight' => '250g', 'price' => '6.50' ),
				array( 'weight' => '500g', 'price' => '11.50' ),
			),
		),
		array(
			'slug'    => 'curry-powder',
			'name'    => 'Ceylon Curry Powder',
			'tagline' => 'Our signature roasted blend',
			'origin'  => 'House blend',
			'emoji'   => '🟠',
			'color'   => 'linear-gradient(135deg, #ea580c, #9a3412)',
			'desc'    => 'Coriander, cumin, fennel, fenugreek, mustard, curry leaves, chilli — pan-roasted before grinding for that signature Sri Lankan depth.',
			'features' => array( 'Pan-roasted before grinding', '7-spice signature blend', 'Deep Sri Lankan flavour' ),
			'tags'    => array( 'Signature blend', 'Roasted' ),
			'badges'  => array( 'new' ),
			'options' => array(
				array( 'weight' => '100g', 'price' => '3.50' ),
				array( 'weight' => '250g', 'price' => '7.50' ),
				array( 'weight' => '500g', 'price' => '13.50' ),
			),
		),
		array(
			'slug'    => 'turmeric',
			'name'    => 'Ceylon Turmeric',
			'tagline' => 'High curcumin, vibrant gold',
			'origin'  => 'Kurunegala',
			'emoji'   => '🟡',
			'color'   => 'linear-gradient(135deg, #ca8a04, #713f12)',
			'desc'    => 'Single-origin powder from local Curcuma longa root. Bright gold colour, earthy aroma, naturally high in curcumin (the anti-inflammatory compound).',
			'features' => array( 'Naturally high curcumin', 'Single-origin Curcuma longa', 'Vibrant gold colour' ),
			'tags'    => array( 'High curcumin', 'Single-origin' ),
			'badges'  => array( 'bestseller' ),
			'certificates' => array( 'Organic' ),
			'options' => array(
				array( 'weight' => '100g', 'price' => '3.00' ),
				array( 'weight' => '250g', 'price' => '6.50' ),
				array( 'weight' => '500g', 'price' => '11.50' ),
			),
		),
		array(
			'slug'    => 'coriander-seed',
			'name'    => 'Coriander Seed',
			'tagline' => 'Citrusy, warm, foundational',
			'origin'  => 'Hambantota',
			'emoji'   => '🌾',
			'color'   => 'linear-gradient(135deg, #a16207, #78350f)',
			'desc'    => 'Whole sun-dried seeds with a sweet, lemony aroma. The backbone of curry powders, pickles, and breads. Toast lightly before grinding.',
			'features' => array( 'Sweet, lemony aroma', 'Backbone of curry blends', 'Toast before grinding' ),
			'tags'    => array( 'Whole', 'Citrusy' ),
			'options' => array(
				array( 'weight' => '100g', 'price' => '2.50' ),
				array( 'weight' => '250g', 'price' => '5.00' ),
				array( 'weight' => '500g', 'price' => '9.00' ),
			),
		),
	);

	// Shared defaults for every spice — keeps the array above lean.
	foreach ( $spices as &$s ) {
		$s['category'] = 'spices';
		$s['country']  = 'Sri Lanka';
		$s['shipping'] = 'Vacuum-sealed; tracked delivery to Latvia in 5–8 business days. EU duties & VAT included.';
		$s['packaging'] = 'Resealable vacuum-sealed pouch';
		if ( ! isset( $s['stock'] ) )    { $s['stock'] = 'in'; }
		if ( ! isset( $s['badges'] ) )   { $s['badges'] = array(); }
		if ( ! isset( $s['certificates'] ) ) { $s['certificates'] = array(); }
		if ( ! isset( $s['features'] ) ) { $s['features'] = array(); }
		// Bulk pricing: ~15% off per option at 2kg+ (kicks in for wholesale).
		foreach ( $s['options'] as &$opt ) {
			if ( ! isset( $opt['bulk_price'] ) ) {
				$opt['bulk_price'] = number_format( (float) $opt['price'] * 0.85, 2 );
			}
		}
		unset( $opt );
	}
	unset( $s );

	return apply_filters( 'nuvirahub_products_raw', $spices );
}

/**
 * Normalised product list — adds derived fields (sku, price_from, gallery, url).
 *
 * @return array<int,array>
 */
function nuvirahub_products() {
	static $cache = null;
	if ( null !== $cache ) {
		return $cache;
	}

	// Pull seed reviews (E5) — keyed by product slug.
	$reviews_by_slug = function_exists( 'nuvirahub_seed_reviews' ) ? nuvirahub_seed_reviews() : array();

	$out = array();
	foreach ( nuvirahub_products_raw() as $p ) {
		// SKU: NVH-<CAT3>-<SLUG4> e.g. NVH-SPI-CEYL
		$cat3  = strtoupper( substr( $p['category'], 0, 3 ) );
		$slug4 = strtoupper( substr( preg_replace( '/[^a-z0-9]/', '', $p['slug'] ), 0, 4 ) );
		$p['sku'] = isset( $p['sku'] ) ? $p['sku'] : "NVH-{$cat3}-{$slug4}";

		// Lowest price across weight options (for "from €x.xx").
		$prices = array_map( static function ( $o ) {
			return (float) $o['price'];
		}, $p['options'] );
		$p['price_from'] = $prices ? number_format( min( $prices ), 2 ) : null;

		// Image gallery: explicit list, else convention
		// assets/img/products/{category}/{slug}.jpg (falls back to spices dir).
		if ( empty( $p['gallery'] ) ) {
			$p['gallery'] = array( $p['slug'] . '.jpg' );
		}
		$p['url'] = home_url( '/product/' . $p['slug'] . '/' );

		// Reviews + aggregate rating.
		$p['reviews'] = isset( $reviews_by_slug[ $p['slug'] ] ) ? $reviews_by_slug[ $p['slug'] ] : array();
		$p['rating']  = nuvirahub_aggregate_rating( $p['reviews'] );

		$out[] = $p;
	}

	$cache = $out;
	return $cache;
}

/**
 * Aggregate a review list down to {avg, count}.
 *
 * @param array $reviews
 * @return array{avg:float,count:int}
 */
function nuvirahub_aggregate_rating( $reviews ) {
	if ( empty( $reviews ) ) {
		return array( 'avg' => 0.0, 'count' => 0 );
	}
	$sum = 0; $n = 0;
	foreach ( $reviews as $r ) {
		$rt = isset( $r['rating'] ) ? (int) $r['rating'] : 0;
		if ( $rt < 1 || $rt > 5 ) {
			continue;
		}
		$sum += $rt;
		$n++;
	}
	if ( $n === 0 ) {
		return array( 'avg' => 0.0, 'count' => 0 );
	}
	return array( 'avg' => round( $sum / $n, 1 ), 'count' => $n );
}

/**
 * Render a star-rating SVG row (E5).
 *
 * @param float $value 0..5; halves supported.
 * @param int   $size  Star side length in px.
 * @return string HTML
 */
function nuvirahub_stars( $value, $size = 14 ) {
	$value = max( 0, min( 5, (float) $value ) );
	ob_start();
	echo '<span class="nv-stars" role="img" aria-label="' . esc_attr( number_format( $value, 1 ) . ' out of 5 stars' ) . '">';
	for ( $i = 1; $i <= 5; $i++ ) {
		$fill = max( 0, min( 1, $value - ( $i - 1 ) ) );
		echo '<span class="nv-star" style="--fill:' . esc_attr( number_format( $fill * 100, 0 ) ) . '%">';
		echo '<svg width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.5l2.95 6.18 6.8.6-5.15 4.55 1.6 6.67L12 16.95 5.8 20.5l1.6-6.67L2.25 9.28l6.8-.6z"/></svg>';
		echo '</span>';
	}
	echo '</span>';
	return ob_get_clean();
}

/**
 * Single product by slug.
 *
 * @param string $slug Product slug.
 * @return array|null
 */
function nuvirahub_product( $slug ) {
	foreach ( nuvirahub_products() as $p ) {
		if ( $p['slug'] === $slug ) {
			return $p;
		}
	}
	return null;
}

/**
 * Products filtered by category slug ('all' or '' = everything).
 *
 * @param string $category Category slug.
 * @return array<int,array>
 */
function nuvirahub_products_by_category( $category = 'all' ) {
	$all = nuvirahub_products();
	if ( ! $category || 'all' === $category ) {
		return $all;
	}
	return array_values( array_filter( $all, static function ( $p ) use ( $category ) {
		return $p['category'] === $category;
	} ) );
}

/**
 * Products carrying a given badge (featured|bestseller|new|sale).
 *
 * @param string $badge Badge key.
 * @return array<int,array>
 */
function nuvirahub_products_with_badge( $badge ) {
	return array_values( array_filter( nuvirahub_products(), static function ( $p ) use ( $badge ) {
		return in_array( $badge, (array) $p['badges'], true );
	} ) );
}

/**
 * Resolve a product image URL with graceful fallback.
 * Tries assets/img/products/{category}/{file}, then the legacy
 * assets/img/spices/{file}, then returns '' (caller shows the gradient).
 *
 * @param array $product Product array.
 * @param int   $index   Gallery index.
 * @return string URL or ''.
 */
function nuvirahub_product_image_url( $product, $index = 0 ) {
	$file = isset( $product['gallery'][ $index ] ) ? $product['gallery'][ $index ] : '';
	if ( ! $file ) {
		return '';
	}
	$base = get_template_directory();
	$uri  = get_template_directory_uri();
	$candidates = array(
		"/assets/img/products/{$product['category']}/{$file}",
		"/assets/img/spices/{$file}", // legacy location for the original spice photos
	);
	foreach ( $candidates as $rel ) {
		if ( file_exists( $base . $rel ) ) {
			return $uri . $rel . '?v=' . filemtime( $base . $rel );
		}
	}
	return '';
}
