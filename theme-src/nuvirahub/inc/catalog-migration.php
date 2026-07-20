<?php
/**
 * One-time catalog migration tool — adds the "Brand" attribute (Wijaya,
 * Freelan, McCurrie, MD, Nature Spices) to every spice product, and creates
 * 4 new products (Karapincha, Rampe, Sera, Samaposha) if they don't already
 * exist. Safe to run more than once — every step checks existing state
 * first and skips anything already done.
 *
 * Adds a "Catalog Update" page under Tools in wp-admin. Run it once on the
 * live site, then this file can be deleted (or just left — it does nothing
 * once everything is already in place).
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Copies a bundled theme image into the uploads dir and registers it as an
 * attachment. Used for the new-product photos shipped in
 * assets/img/products/.
 *
 * @param string $filename Filename inside assets/img/products/.
 * @param string $title    Attachment title.
 * @return int Attachment ID, or 0 on failure.
 */
function nuvirahub_attach_bundled_product_image( $filename, $title ) {
	$src = get_template_directory() . '/assets/img/products/' . $filename;
	if ( ! file_exists( $src ) ) {
		return 0;
	}

	$upload_dir = wp_upload_dir();
	$unique     = wp_unique_filename( $upload_dir['path'], $filename );
	$dest       = $upload_dir['path'] . '/' . $unique;

	if ( ! copy( $src, $dest ) ) {
		return 0;
	}

	$filetype  = wp_check_filetype( $unique, null );
	$attach_id = wp_insert_attachment(
		array(
			'post_mime_type' => $filetype['type'],
			'post_title'     => $title,
			'post_status'    => 'inherit',
		),
		$dest
	);
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$attach_data = wp_generate_attachment_metadata( $attach_id, $dest );
	wp_update_attachment_metadata( $attach_id, $attach_data );
	return $attach_id;
}

add_action( 'admin_menu', function () {
	add_management_page( 'Nuvirahub Catalog Update', 'Catalog Update', 'manage_woocommerce', 'nv-catalog-migration', 'nuvirahub_render_catalog_migration_page' );
} );

function nuvirahub_render_catalog_migration_page() {
	if ( ! current_user_can( 'manage_woocommerce' ) ) {
		wp_die( 'Not allowed.' );
	}

	$ran = false;
	$log = array();

	if ( isset( $_POST['nv_run_migration'] ) && check_admin_referer( 'nv_catalog_migration' ) ) {
		$log = nuvirahub_run_catalog_migration();
		$ran = true;
	}
	?>
	<div class="wrap">
		<h1>Nuvirahub Catalog Update</h1>
		<p>This adds the <strong>Brand</strong> attribute (Wijaya, Freelan, McCurrie, MD, Nature Spices) to every spice product, and creates 4 new products (Karapincha, Rampe, Sera, Samaposha) if they don't already exist.</p>
		<p>Safe to click more than once — anything already done is skipped.</p>
		<form method="post">
			<?php wp_nonce_field( 'nv_catalog_migration' ); ?>
			<p><button type="submit" name="nv_run_migration" value="1" class="button button-primary">Run catalog update</button></p>
		</form>
		<?php if ( $ran ) : ?>
			<h2>Result</h2>
			<pre style="background:#fff;padding:16px;border:1px solid #ccd0d4;max-width:800px;white-space:pre-wrap"><?php echo esc_html( implode( "\n", $log ) ); ?></pre>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Runs the brand-attribute expansion + new-product creation.
 * Returns an array of human-readable log lines.
 *
 * @return string[]
 */
function nuvirahub_run_catalog_migration() {
	$log = array();

	if ( ! class_exists( 'WooCommerce' ) ) {
		return array( 'WooCommerce is not active — nothing to do.' );
	}

	// ---- 1. Brand attribute expansion on existing spice products ----
	$brand_multiplier = array(
		'Wijaya'        => 1.00,
		'Freelan'       => 1.05,
		'McCurrie'      => 0.95,
		'MD'            => 1.02,
		'Nature Spices' => 1.08,
	);
	$brand_note = array(
		'Wijaya'        => 'Wijaya Products, Sri Lanka — classic, widely trusted household pack.',
		'Freelan'       => 'Freelan (Matara) — bold, aromatic blend, a Southern Province favourite.',
		'McCurrie'      => 'McCurrie — premium quality spice house, consistent grind and colour.',
		'MD'            => 'MD (Lanka Canneries) — long-established Sri Lankan household name.',
		'Nature Spices' => 'Nature Spices — smaller-batch, single-origin focused producer.',
	);

	$spice_products = wc_get_products( array(
		'category' => array( 'spices' ),
		'type'     => 'variable',
		'limit'    => -1,
	) );

	foreach ( $spice_products as $product ) {
		$pid = $product->get_id();

		$base_variations = array();
		foreach ( $product->get_children() as $vid ) {
			$v = wc_get_product( $vid );
			$vattrs = $v->get_attributes();
			if ( ! empty( $vattrs['brand'] ) ) {
				continue; // this product already has brand variations
			}
			$base_variations[] = array(
				'pack_size' => $vattrs['pack-size'] ?? '',
				'price'     => (float) $v->get_regular_price(),
				'image_id'  => $v->get_image_id(),
				'desc'      => $v->get_description(),
				'old_id'    => $vid,
			);
		}

		if ( empty( $base_variations ) ) {
			$log[] = "SKIP {$product->get_name()} — already has Brand variations, or no base variations found.";
			continue;
		}

		$attributes = $product->get_attributes();
		$brand_attr = new WC_Product_Attribute();
		$brand_attr->set_id( 0 );
		$brand_attr->set_name( 'Brand' );
		$brand_attr->set_options( array_keys( $brand_multiplier ) );
		$brand_attr->set_position( count( $attributes ) );
		$brand_attr->set_visible( true );
		$brand_attr->set_variation( true );
		$attributes['brand'] = $brand_attr;
		$product->set_attributes( $attributes );
		$product->save();

		$parent_image_id = $product->get_image_id();
		$created = 0;

		foreach ( $base_variations as $base ) {
			foreach ( $brand_multiplier as $brand => $mult ) {
				$new_price = round( $base['price'] * $mult, 2 );
				$variation = new WC_Product_Variation();
				$variation->set_parent_id( $pid );
				$variation->set_attributes( array( 'pack-size' => $base['pack_size'], 'brand' => $brand ) );
				$variation->set_regular_price( $new_price );
				$variation->set_price( $new_price );
				$image_id = $base['image_id'] ? $base['image_id'] : $parent_image_id;
				if ( $image_id ) {
					$variation->set_image_id( $image_id );
				}
				$variation->set_description( trim( $base['desc'] . ' ' . $brand_note[ $brand ] ) );
				$variation->save();
				$created++;
			}
			$old = wc_get_product( $base['old_id'] );
			if ( $old ) {
				$old->delete( true );
			}
		}

		WC_Product_Variable::sync( $pid );
		$log[] = "OK {$product->get_name()} — created {$created} brand variations.";
	}

	// ---- 2. New products (image sourcing note: swap in real photos when available) ----
	$new_products = array(
		array(
			'name'       => 'Karapincha (Curry Leaves)',
			'sku'        => 'NVH-SPI-KARA',
			'category'   => 'spices',
			'short_desc' => 'Sun-dried curry leaves — the essential base aromatic for Sri Lankan curries and tempering (thel dala).',
			'desc'       => 'Karapincha (Murraya koenigii) is the backbone aromatic of Sri Lankan cooking, used in almost every curry and tempering (thel dala). Our leaves are sun-dried shortly after harvest to preserve their citrusy, slightly bitter aroma.',
			'options'    => array( '50g' => 2.50, '100g' => 4.50 ),
			'image'      => 'karapincha.jpg',
		),
		array(
			'name'       => 'Rampe (Pandan Leaves)',
			'sku'        => 'NVH-SPI-RAMP',
			'category'   => 'spices',
			'short_desc' => 'Dried pandan (screwpine) leaves — the fragrant backbone of Sri Lankan rice, curries, and desserts.',
			'desc'       => 'Rampe (Pandanus amaryllifolius) gives Sri Lankan milk rice, curries and sweets their distinctive fragrance. Sun-dried and packed to retain aroma for months.',
			'options'    => array( '50g' => 2.80, '100g' => 5.00 ),
			'image'      => 'rampe.jpg',
		),
		array(
			'name'       => 'Sera (Lemongrass)',
			'sku'        => 'NVH-SPI-SERA',
			'category'   => 'spices',
			'short_desc' => 'Dried lemongrass stalks — citrusy aromatic for soups, teas, and Sri Lankan curries.',
			'desc'       => 'Sera (Cymbopogon citratus) adds a bright, citrus note to soups, teas and curries, and is a common home remedy infusion in Sri Lanka. Sun-dried whole stalks, cut for easy steeping or tempering.',
			'options'    => array( '100g' => 3.20, '250g' => 7.00 ),
			'image'      => 'sera.jpg',
		),
		array(
			'name'       => 'Samaposha',
			'sku'        => 'NVH-HEA-SAMA',
			'category'   => 'health-pharmacy',
			'short_desc' => 'Pre-cooked multigrain nutrition cereal — a Sri Lankan household staple, mixed with milk or water.',
			'desc'       => 'Pre-cooked multigrain cereal (corn, rice, soya, green gram) — a Sri Lankan nutrition staple, typically mixed with warm milk or water for a quick, high-protein meal. No added colours or flavours.',
			'options'    => array( '200g' => 2.80, '400g' => 5.00 ),
			'image'      => 'samaposha.jpg',
		),
	);

	foreach ( $new_products as $p ) {
		if ( wc_get_product_id_by_sku( $p['sku'] ) ) {
			$log[] = "SKIP {$p['name']} — SKU {$p['sku']} already exists.";
			continue;
		}

		$product = new WC_Product_Variable();
		$product->set_name( $p['name'] );
		$product->set_sku( $p['sku'] );
		$product->set_short_description( $p['short_desc'] );
		$product->set_description( $p['desc'] );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );

		$term = get_term_by( 'slug', $p['category'], 'product_cat' );
		if ( $term ) {
			$product->set_category_ids( array( $term->term_id ) );
		}

		$pack_attr = new WC_Product_Attribute();
		$pack_attr->set_id( 0 );
		$pack_attr->set_name( 'Pack Size' );
		$pack_attr->set_options( array_keys( $p['options'] ) );
		$pack_attr->set_position( 0 );
		$pack_attr->set_visible( true );
		$pack_attr->set_variation( true );
		$product->set_attributes( array( 'pack-size' => $pack_attr ) );

		$image_id = ! empty( $p['image'] ) ? nuvirahub_attach_bundled_product_image( $p['image'], $p['name'] ) : 0;
		if ( $image_id ) {
			$product->set_image_id( $image_id );
			$product->save();
		}

		$product_id = $product->get_id();

		foreach ( $p['options'] as $size => $price ) {
			$variation = new WC_Product_Variation();
			$variation->set_parent_id( $product_id );
			$variation->set_attributes( array( 'pack-size' => $size ) );
			$variation->set_regular_price( $price );
			$variation->set_price( $price );
			if ( $image_id ) {
				$variation->set_image_id( $image_id );
			}
			$variation->save();
		}

		WC_Product_Variable::sync( $product_id );
		$photo_note = $image_id ? '' : ' NOTE: photo not found — upload one manually in Products → ' . $p['name'] . ' → Product image.';
		$log[] = "OK created {$p['name']} — product #{$product_id}.{$photo_note}";
	}

	return $log;
}
