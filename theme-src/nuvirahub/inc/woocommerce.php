<?php
/**
 * WooCommerce integration (Phase 2).
 *
 * Makes the custom Nuvirahub theme render WooCommerce shop, product, cart,
 * checkout and account screens inside the site shell, styled to match the
 * dark glassmorphism brand. WooCommerce is the source of truth for products,
 * cart, orders and payments from Phase 2 onward.
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Bail out gracefully if WooCommerce isn't active yet. */
add_action( 'after_setup_theme', function () {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 600,
		'single_image_width'    => 900,
		'product_grid'          => array(
			'default_columns' => 3,
			'default_rows'    => 3,
		),
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
} );

/* Replace WooCommerce's default content wrappers with the theme's container. */
add_action( 'init', function () {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

	add_action( 'woocommerce_before_main_content', function () {
		echo '<div class="nv-section nv-woo"><div class="nv-woo-inner">';
	}, 10 );
	add_action( 'woocommerce_after_main_content', function () {
		echo '</div></div>';
	}, 10 );

	// The brand design is full-width — drop WooCommerce's sidebar entirely.
	// (Also stops the get_sidebar() deprecation + default-widget dump on a
	// theme that has no sidebar.php.)
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
} );

/* Products per page on the shop archive. */
add_filter( 'loop_shop_per_page', function () {
	return 12;
} );

/* Show 3 columns in the shop grid. */
add_filter( 'loop_shop_columns', function () {
	return 3;
} );

/**
 * Order-received page: "Send your payment slip on WhatsApp" step.
 * For bank-transfer orders, show clear 1-2-3 instructions and a one-tap
 * WhatsApp button pre-filled with the order number + total, so the buyer
 * can attach their transfer slip and we can confirm + ship.
 */
add_action( 'woocommerce_thankyou', function ( $order_id ) {
	if ( ! $order_id ) {
		return;
	}
	$order = wc_get_order( $order_id );
	if ( ! $order ) {
		return;
	}
	// Only show for bank-transfer (BACS) orders.
	if ( 'bacs' !== $order->get_payment_method() ) {
		return;
	}

	$num   = $order->get_order_number();
	$total = trim( html_entity_decode( wp_strip_all_tags( wc_price( $order->get_total(), array( 'currency' => $order->get_currency() ) ) ) ) );
	$name  = $order->get_billing_first_name();

	$msg = sprintf(
		"Hi Nuvirahub! I've placed order #%s (total %s)%s and paid by bank transfer. Here is my payment slip:",
		$num,
		$total,
		$name ? " — {$name}" : ''
	);
	$wa = nuvirahub_wa_link( $msg );
	?>
	<div class="nv-payslip">
		<div class="nv-payslip-head">
			<span class="nv-payslip-badge">Action needed</span>
			<h2>Almost done — send us your payment slip</h2>
			<p>Your order <strong>#<?php echo esc_html( $num ); ?></strong> is reserved. To confirm it and start shipping, please:</p>
		</div>
		<ol class="nv-payslip-steps">
			<li><strong>Transfer <?php echo esc_html( $total ); ?></strong> to our EUR bank account (details below &amp; emailed to you).</li>
			<li><strong>Send us the payment slip on WhatsApp</strong> (screenshot or photo) using the button below.</li>
			<li>We verify the payment and <strong>ship your order</strong> — you'll get a confirmation.</li>
		</ol>
		<a class="nv-payslip-wa" href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener">
			<?php echo nv_icon( 'message-circle', 18 ); ?>Send Payment Slip on WhatsApp
		</a>
		<p class="nv-payslip-note">Order reference <strong>#<?php echo esc_html( $num ); ?></strong> is already filled in your message — just attach the slip image.</p>
	</div>
	<?php
}, 8 );

/**
 * Retire the old WhatsApp-only /spices/ page — send it to the real Shop
 * so there's a single, clear buying path.
 */
add_action( 'template_redirect', function () {
	if ( is_page( 'spices' ) ) {
		$shop = wc_get_page_id( 'shop' );
		wp_safe_redirect( $shop ? get_permalink( $shop ) : home_url( '/shop/' ), 301 );
		exit;
	}
} );

/**
 * Make sure the AJAX cart-fragments script is loaded so the header cart
 * count + mini-cart refresh without a page reload.
 */
add_action( 'wp_enqueue_scripts', function () {
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_script( 'wc-cart-fragments' );
	}
} );

/**
 * Header cart count + mini-cart contents, refreshed via cart fragments.
 */
function nuvirahub_cart_count_fragment() {
	$count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
	ob_start();
	?><span class="nv-cart-count<?php echo $count ? ' has-items' : ''; ?>"><?php echo (int) $count; ?></span><?php
	return ob_get_clean();
}

function nuvirahub_minicart_fragment() {
	ob_start();
	?>
	<div class="nv-minicart-body">
		<?php woocommerce_mini_cart(); ?>
	</div>
	<?php
	return ob_get_clean();
}

add_filter( 'woocommerce_add_to_cart_fragments', function ( $fragments ) {
	$fragments['span.nv-cart-count']   = nuvirahub_cart_count_fragment();
	$fragments['div.nv-minicart-body'] = nuvirahub_minicart_fragment();
	return $fragments;
} );

/**
 * Shop header: product search bar + "Shop by category" tiles.
 * Tiles show on the main Shop page (all categories, even empty ones, so new
 * lines like Samahan/Biscuits/Pharmacy appear before they have products).
 * Search bar shows on the shop and category archives.
 */
add_action( 'woocommerce_before_shop_loop', function () {
	if ( ! function_exists( 'is_shop' ) || ( ! is_shop() && ! is_product_category() ) ) {
		return;
	}

	// Search bar (products only).
	echo '<div class="nv-shop-searchbar">' . get_product_search_form( false ) . '</div>';

	if ( ! is_shop() ) {
		return; // category tiles only on the main Shop landing
	}

	$terms = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
		'exclude'    => array( (int) get_option( 'default_product_cat' ) ),
	) );
	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return;
	}

	$emoji = array(
		'spices'            => '🌶️',
		'herbal-ayurveda'   => '🌿',
		'biscuits-snacks'   => '🍪',
		'health-pharmacy'   => '💊',
		'tea-coffee'        => '☕',
		'beverages'         => '🥤',
		'household-grocery' => '🧺',
	);

	echo '<div class="nv-cat-block"><div class="nv-tag" style="margin-bottom:10px">Shop by category</div>';
	echo '<div class="nv-cat-grid">';
	foreach ( $terms as $t ) {
		$link     = get_term_link( $t );
		$thumb_id = get_term_meta( $t->term_id, 'thumbnail_id', true );
		$img      = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : '';
		$e        = $emoji[ $t->slug ] ?? '📦';
		echo '<a class="nv-cat-tile" href="' . esc_url( $link ) . '">';
		if ( $img ) {
			echo '<div class="nv-cat-thumb" style="background-image:url(\'' . esc_url( $img ) . '\')"></div>';
		} else {
			echo '<div class="nv-cat-thumb nv-cat-thumb-fallback"><span>' . esc_html( $e ) . '</span></div>';
		}
		echo '<div class="nv-cat-info"><h3>' . esc_html( $t->name ) . '</h3>';
		echo '<span>' . (int) $t->count . ' ' . _n( 'product', 'products', (int) $t->count, 'nuvirahub' ) . '</span></div>';
		echo '</a>';
	}
	echo '</div></div>';
	echo '<h2 class="nv-shop-allheading">All products</h2>';
}, 5 );

/**
 * "You may also like" upsell on the cart page — up to 4 published products
 * not already in the cart, shown below the cart totals.
 */
add_action( 'woocommerce_cart_collaterals', function () {
	if ( WC()->cart->is_empty() ) {
		return;
	}

	$in_cart_ids = array();
	foreach ( WC()->cart->get_cart() as $item ) {
		$in_cart_ids[] = $item['product_id'];
	}

	$suggestions = wc_get_products(
		array(
			'status'  => 'publish',
			'limit'   => 4,
			'exclude' => $in_cart_ids,
			'orderby' => 'rand',
		)
	);

	if ( empty( $suggestions ) ) {
		return;
	}
	?>
	<div class="nv-cart-upsell">
		<h2 class="nv-cart-upsell-heading">You may also like</h2>
		<div class="nv-shop-grid nv-cart-upsell-grid">
			<?php foreach ( $suggestions as $p ) :
				$image_id = $p->get_image_id();
				$image    = $image_id ? wp_get_attachment_image_url( $image_id, 'medium' ) : '';
				$url      = get_permalink( $p->get_id() );
				?>
				<article class="nv-shop-card">
					<a class="nv-shop-thumb-link" href="<?php echo esc_url( $url ); ?>">
						<div class="nv-shop-thumb">
							<?php if ( $image ) : ?>
								<div class="nv-shop-thumb-img" style="background-image:url('<?php echo esc_url( $image ); ?>')"></div>
							<?php else : ?>
								<span class="nv-shop-thumb-emoji">📦</span>
							<?php endif; ?>
						</div>
					</a>
					<div class="nv-shop-body">
						<a class="nv-shop-title-link" href="<?php echo esc_url( $url ); ?>"><h3><?php echo esc_html( $p->get_name() ); ?></h3></a>
						<span class="nv-shop-price"><?php echo wp_kses_post( $p->get_price_html() ); ?></span>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
} );
