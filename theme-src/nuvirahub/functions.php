<?php
/**
 * Nuvirahub theme functions.
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Brand-wide constants.
 * Update the WhatsApp number here once — used by the floating button, product page, etc.
 */
if ( ! defined( 'NUVIRAHUB_WHATSAPP' ) )       { define( 'NUVIRAHUB_WHATSAPP', '94716722599' ); }
if ( ! defined( 'NUVIRAHUB_SPICE_BRAND' ) )    { define( 'NUVIRAHUB_SPICE_BRAND', 'Nuvira Spice Co.' ); }
if ( ! defined( 'NUVIRAHUB_SPICE_CURRENCY' ) ) { define( 'NUVIRAHUB_SPICE_CURRENCY', '€' ); }

/**
 * Product data model (E1) — central catalogue + query helpers.
 */
require get_template_directory() . '/inc/products.php';

/**
 * Product reviews seed data (E5) — placeholder reviews keyed by slug.
 * Loaded BEFORE products.php uses it on first call.
 */
require get_template_directory() . '/inc/product-reviews.php';

/**
 * Product permalink routing (E4) — /product/{slug}/ rewrite.
 */
require get_template_directory() . '/inc/product-routing.php';

/**
 * Build a WhatsApp deep-link with a pre-filled message.
 *
 * @param string $message  Plain-text message body. Will be URL-encoded.
 * @return string  Full wa.me URL.
 */
function nuvirahub_wa_link( $message = '' ) {
	$num = preg_replace( '/[^0-9]/', '', NUVIRAHUB_WHATSAPP );
	return 'https://wa.me/' . $num . '?text=' . rawurlencode( $message );
}

/**
 * Inline SVG icon library — Lucide-style strokes.
 * Use:  echo nv_icon('rocket');       // default 24px
 *       echo nv_icon('map-pin', 14);  // custom size
 *
 * All icons are stroke-based, currentColor — colour via CSS.
 * Adding a new icon: paste its <path>/<circle>/etc into the array below.
 */
function nv_icon( $name, $size = 24 ) {
	static $svgs = null;
	if ( $svgs === null ) {
		$svgs = array(
			// Navigation / generic
			'arrow-right'    => '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>',
			'check'          => '<polyline points="20 6 9 17 4 12"/>',
			'check-circle'   => '<circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/>',
			'alert-triangle' => '<path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
			'x'              => '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
			'menu'           => '<line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>',
			// Pillars
			'monitor'        => '<rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>',
			'rocket'         => '<path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="M12 15l-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"/><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/>',
			'trending-up'    => '<polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/>',
			'ship'           => '<path d="M2 21c.6.5 1.2 1 2.5 1 2.5 0 2.5-2 5-2s2.5 2 5 2 2.5-2 5-2 2.5 2 5 2"/><path d="M19 8H5c-1 0-2 1-2 2v6h18v-6c0-1-1-2-2-2z"/><path d="M12 8V2H4v6"/><path d="M20 8V5l-6-3"/>',
			'palette'        => '<circle cx="13.5" cy="6.5" r=".5"/><circle cx="17.5" cy="10.5" r=".5"/><circle cx="8.5" cy="7.5" r=".5"/><circle cx="6.5" cy="12.5" r=".5"/><path d="M12 2a10 10 0 0 0 0 20c1.1 0 2-.9 2-2v-1c0-1.1.9-2 2-2h2a4 4 0 0 0 4-4 10 10 0 0 0-10-11z"/>',
			'megaphone'      => '<path d="M3 11l18-5v12L3 13"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>',
			'building-2'     => '<path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/>',
			// Devices
			'smartphone'     => '<rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/>',
			'globe'          => '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
			'cpu'            => '<rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="2" x2="9" y2="4"/><line x1="15" y1="2" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="22"/><line x1="15" y1="20" x2="15" y2="22"/><line x1="20" y1="9" x2="22" y2="9"/><line x1="20" y1="14" x2="22" y2="14"/><line x1="2" y1="9" x2="4" y2="9"/><line x1="2" y1="14" x2="4" y2="14"/>',
			// Strategy
			'target'         => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
			'settings'       => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>',
			'pie-chart'      => '<path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/>',
			'pen-tool'       => '<path d="M12 19l7-7 3 3-7 7-3-3z"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="M2 2l7.586 7.586"/><circle cx="11" cy="11" r="2"/>',
			'box'            => '<path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>',
			'ruler'          => '<path d="M21.3 8.7L8.7 21.3a2.41 2.41 0 0 1-3.4 0l-2.6-2.6a2.41 2.41 0 0 1 0-3.4L15.3 2.7a2.41 2.41 0 0 1 3.4 0l2.6 2.6a2.41 2.41 0 0 1 0 3.4Z"/><path d="M7.5 10.5l2 2"/><path d="M10.5 7.5l2 2"/><path d="M13.5 4.5l2 2"/><path d="M4.5 13.5l2 2"/>',
			'id-card'        => '<rect x="2" y="4" width="20" height="16" rx="2"/><circle cx="9" cy="10" r="2"/><path d="M15 8h2"/><path d="M15 12h2"/><path d="M7 16h10"/>',
			'share-2'        => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>',
			'search'         => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
			// Logistics
			'plane'          => '<path d="M17.8 19.2L16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>',
			'package'        => '<line x1="16.5" y1="9.4" x2="7.5" y2="4.21"/><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>',
			'truck'          => '<rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
			'map-pin'        => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
			// Authorities / institutions
			'landmark'       => '<line x1="3" y1="22" x2="21" y2="22"/><line x1="6" y1="18" x2="6" y2="11"/><line x1="10" y1="18" x2="10" y2="11"/><line x1="14" y1="18" x2="14" y2="11"/><line x1="18" y1="18" x2="18" y2="11"/><polygon points="12 2 20 7 4 7"/>',
			'dollar-sign'    => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
			'users'          => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
			'shield'         => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
			'copyright'      => '<circle cx="12" cy="12" r="10"/><path d="M14.83 14.83a4 4 0 1 1 0-5.66"/>',
			'store'          => '<path d="M3 9l1-5h16l1 5"/><path d="M5 9v11a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9"/><path d="M3 9a3 3 0 0 0 6 0 3 3 0 0 0 6 0 3 3 0 0 0 6 0"/>',
			'lock'           => '<rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
			// ERP modules
			'banknote'       => '<rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/>',
			'briefcase'      => '<rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>',
			'archive'        => '<polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/>',
			'handshake'      => '<path d="M11 17l-5-5 5-5"/><path d="M13 7l5 5-5 5"/><path d="M6 12h12"/>',
			'factory'        => '<path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M17 18h1"/><path d="M12 18h1"/><path d="M7 18h1"/>',
			'bar-chart'      => '<line x1="12" y1="20" x2="12" y2="10"/><line x1="18" y1="20" x2="18" y2="4"/><line x1="6" y1="20" x2="6" y2="16"/>',
			// Industries
			'hard-hat'       => '<path d="M2 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a8 8 0 0 0-16 0Z"/><path d="M10 10V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5"/><path d="M4 15v3"/><path d="M20 15v3"/>',
			'heart-pulse'    => '<path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M3.22 12H9.5l.5-1 2 4.5 2-7 1.5 3.5h5.27"/>',
			'graduation-cap' => '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>',
			'wheat'          => '<path d="M2 22 16 8"/><path d="M3.47 12.53 5 14l1.53-1.53a3.5 3.5 0 0 0 0-4.95L5 6 3.47 7.53a3.5 3.5 0 0 0 0 4.95z"/><path d="M7.47 8.53 9 10l1.53-1.53a3.5 3.5 0 0 0 0-4.95L9 2 7.47 3.53a3.5 3.5 0 0 0 0 4.95z"/>',
			'cog'            => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>',
			// Communication
			'message-circle' => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
			'mail'           => '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>',
			'phone'          => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
			// Nature / freshness
			'sprout'         => '<path d="M7 20h10"/><path d="M10 20c5.5-2.5.8-6.4 3-10"/><path d="M9.5 9.4c1.1.8 1.8 2.2 2.3 3.7-2 .4-3.5.4-4.8-.3-1.2-.6-2.3-1.9-3-4.2 2.8-.5 4.4 0 5.5.8z"/><path d="M14.1 6a7 7 0 0 0-1.1 4c1.9-.1 3.3-.6 4.3-1.4 1-1 1.6-2.3 1.7-4.6-2.7.1-4 1-4.9 2z"/>',
			'leaf'           => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6"/>',
			'flame'          => '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>',
			// Misc useful
			'star'           => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
			'send'           => '<line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>',
			'award'          => '<circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
			'sparkles'       => '<path d="M12 3l2 4 4 2-4 2-2 4-2-4-4-2 4-2z"/><path d="M19 11l1 2 2 1-2 1-1 2-1-2-2-1 2-1z"/>',
		);
	}
	if ( ! isset( $svgs[ $name ] ) ) return '';
	return sprintf(
		'<svg class="nv-icon nv-icon-%s" width="%d" height="%d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%s</svg>',
		esc_attr( $name ), (int) $size, (int) $size, $svgs[ $name ]
	);
}

if ( ! function_exists( 'nuvirahub_setup' ) ) {
	/**
	 * Theme setup.
	 */
	function nuvirahub_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
		);
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 60,
				'width'       => 200,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'nuvirahub' ),
				'footer'  => __( 'Footer Menu', 'nuvirahub' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'nuvirahub_setup' );

/**
 * Version-safe replacement for the deprecated get_page_by_title().
 * Returns a WP_Post or null.
 *
 * @param string $title Page title to find.
 * @return WP_Post|null
 */
function nuvirahub_get_page_by_title( $title ) {
	$query = new WP_Query(
		array(
			'post_type'              => 'page',
			'title'                  => $title,
			'post_status'            => 'publish',
			'posts_per_page'         => 1,
			'no_found_rows'          => true,
			'ignore_sticky_posts'    => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
		)
	);
	return ! empty( $query->posts ) ? $query->posts[0] : null;
}

/**
 * Enqueue styles and scripts.
 */
function nuvirahub_assets() {
	wp_enqueue_style(
		'nuvirahub-fonts',
		'https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap',
		array(),
		null
	);
	// Version from file modified-time so browsers + LiteSpeed auto-refetch on every change.
	$css_path = get_stylesheet_directory() . '/style.css';
	$js_path  = get_template_directory() . '/assets/main.js';
	$css_ver  = file_exists( $css_path ) ? filemtime( $css_path ) : '3.1.0';
	$js_ver   = file_exists( $js_path ) ? filemtime( $js_path ) : '3.1.0';
	wp_enqueue_style( 'nuvirahub-style', get_stylesheet_uri(), array( 'nuvirahub-fonts' ), $css_ver );
	wp_enqueue_script( 'nuvirahub-main', get_template_directory_uri() . '/assets/main.js', array(), $js_ver, true );
}
add_action( 'wp_enqueue_scripts', 'nuvirahub_assets' );

/**
 * Content width.
 */
function nuvirahub_content_width() {
	$GLOBALS['content_width'] = 1100;
}
add_action( 'after_setup_theme', 'nuvirahub_content_width', 0 );

/**
 * Fallback menu when no menu has been assigned to the "primary" location.
 */
function nuvirahub_fallback_menu() {
	echo '<ul id="primary-menu" class="nv-links">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li>';
	$pages = array(
		'Services'           => 'services',
		'Spices'             => 'spices',
		'Portfolio'          => 'portfolio',
		'About'              => 'about',
		'Contact'            => 'contact',
	);
	foreach ( $pages as $title => $slug ) {
		$page = nuvirahub_get_page_by_title( $title );
		$url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
		echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Simple, safe contact form handler.
 * Posts back to admin-post.php; sends an email to the site admin.
 */
function nuvirahub_handle_contact() {
	if ( ! isset( $_POST['nuvirahub_contact_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nuvirahub_contact_nonce'] ) ), 'nuvirahub_contact' ) ) {
		wp_safe_redirect( home_url( '/contact/?sent=error' ) );
		exit;
	}

	$first   = isset( $_POST['nv_first'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_first'] ) ) : '';
	$last    = isset( $_POST['nv_last'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_last'] ) ) : '';
	$email   = isset( $_POST['nv_email'] ) ? sanitize_email( wp_unslash( $_POST['nv_email'] ) ) : '';
	$type    = isset( $_POST['nv_type'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_type'] ) ) : '';
	$budget  = isset( $_POST['nv_budget'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_budget'] ) ) : '';
	$message = isset( $_POST['nv_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['nv_message'] ) ) : '';

	$to      = get_option( 'admin_email' );
	$subject = 'New enquiry from ' . $first . ' ' . $last;
	$body    = "Name: {$first} {$last}\nEmail: {$email}\nProject type: {$type}\nBudget: {$budget}\n\nMessage:\n{$message}";
	$headers = array( 'Reply-To: ' . $email );

	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( home_url( '/contact/?sent=success' ) );
	exit;
}
add_action( 'admin_post_nopriv_nuvirahub_contact', 'nuvirahub_handle_contact' );
add_action( 'admin_post_nuvirahub_contact', 'nuvirahub_handle_contact' );

/**
 * Wholesale / B2B inquiry handler (E6).
 * Emails the quotation request to the site admin, then returns to the
 * Wholesale page with a status flag.
 */
function nuvirahub_handle_wholesale() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/wholesale/' );
	$back = remove_query_arg( array( 'wholesale' ), $back );

	if ( ! isset( $_POST['nuvirahub_wholesale_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nuvirahub_wholesale_nonce'] ) ), 'nuvirahub_wholesale' ) ) {
		wp_safe_redirect( add_query_arg( 'wholesale', 'error', $back ) );
		exit;
	}

	$company  = isset( $_POST['nv_company'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_company'] ) ) : '';
	$contact  = isset( $_POST['nv_contact'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_contact'] ) ) : '';
	$email    = isset( $_POST['nv_email'] ) ? sanitize_email( wp_unslash( $_POST['nv_email'] ) ) : '';
	$product  = isset( $_POST['nv_product'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_product'] ) ) : '';
	$qty      = isset( $_POST['nv_qty'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_qty'] ) ) : '';
	$country  = isset( $_POST['nv_country'] ) ? sanitize_text_field( wp_unslash( $_POST['nv_country'] ) ) : '';
	$notes    = isset( $_POST['nv_notes'] ) ? sanitize_textarea_field( wp_unslash( $_POST['nv_notes'] ) ) : '';

	$to      = get_option( 'admin_email' );
	$subject = 'Wholesale quotation request — ' . ( $company ? $company : $contact );
	$body    = "WHOLESALE / B2B QUOTATION REQUEST\n\n"
		. "Company: {$company}\n"
		. "Contact person: {$contact}\n"
		. "Email: {$email}\n"
		. "Product required: {$product}\n"
		. "Quantity required: {$qty}\n"
		. "Destination country: {$country}\n\n"
		. "Special requirements:\n{$notes}\n";
	$headers = $email ? array( 'Reply-To: ' . $email ) : array();

	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'wholesale', 'success', $back ) );
	exit;
}
add_action( 'admin_post_nopriv_nuvirahub_wholesale', 'nuvirahub_handle_wholesale' );
add_action( 'admin_post_nuvirahub_wholesale', 'nuvirahub_handle_wholesale' );

/**
 * Output Schema.org JSON-LD structured data in the document head.
 *
 * This tells Google we're an Organization + LocalBusiness, which makes our
 * search results richer (logo, hours, phone, address shown directly in SERPs).
 * It also publishes a FAQPage block on the Startup Launchpad page, which can
 * earn "People also ask"-style rich snippets.
 */
function nuvirahub_schema_jsonld() {
	$logo_url = get_template_directory_uri() . '/assets/favicons/og-image.png';

	$org = array(
		'@context'    => 'https://schema.org',
		'@type'       => array( 'Organization', 'LocalBusiness' ),
		'@id'         => home_url( '/#organization' ),
		'name'        => 'Nuvirahub (Pvt) Ltd',
		'url'         => home_url( '/' ),
		'logo'        => $logo_url,
		'image'       => $logo_url,
		'email'       => 'nuvirahub@gmail.com',
		'telephone'   => '+94716722599',
		'priceRange'  => '$$',
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => '27/2E Pieris Avenue',
			'addressLocality' => 'Kalubowila, Dehiwala',
			'addressRegion'   => 'Western Province',
			'postalCode'      => '10350',
			'addressCountry'  => 'LK',
		),
		'founders'    => array(
			array( '@type' => 'Person', 'name' => 'Harsha Walisundara' ),
			array( '@type' => 'Person', 'name' => 'Akalanka Navarathne' ),
			array( '@type' => 'Person', 'name' => 'Heshan Wijesundara' ),
		),
		'sameAs'      => array(), // Add LinkedIn, FB, Instagram URLs here when ready
		'openingHoursSpecification' => array(
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ),
				'opens'     => '09:00',
				'closes'    => '18:00',
			),
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => 'Saturday',
				'opens'     => '09:00',
				'closes'    => '13:00',
			),
		),
		'areaServed'  => array(
			array( '@type' => 'Country', 'name' => 'Sri Lanka' ),
			array( '@type' => 'Country', 'name' => 'Latvia' ),
		),
	);

	echo "\n<!-- Schema.org -->\n";
	echo '<script type="application/ld+json">' . wp_json_encode( $org, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";

	// FAQPage schema on the Startup Launchpad page
	if ( is_page( 'startup-launchpad' ) ) {
		$faq = array(
			'@context' => 'https://schema.org',
			'@type'    => 'FAQPage',
			'mainEntity' => array(
				array(
					'@type' => 'Question',
					'name'  => 'How long does business registration take in Sri Lanka?',
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => 'Typical timeline is 7–14 working days for a (Pvt) Ltd company. We handle ROC filing, name reservation, Articles of Association, and director consents end-to-end.',
					),
				),
				array(
					'@type' => 'Question',
					'name'  => 'What documents do I need to start a business in Sri Lanka?',
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => 'NIC copies, proposed company name (3 options), registered address proof, director/shareholder details, Form 1 (Application for Incorporation), Forms 18 & 19 (Director consents), and the Articles of Association. We prepare everything for you.',
					),
				),
				array(
					'@type' => 'Question',
					'name'  => 'Do I need a VAT registration?',
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => 'VAT registration is mandatory when annual turnover exceeds LKR 80 million. Below that, it is optional but can be beneficial for B2B operations.',
					),
				),
			),
		);
		echo '<script type="application/ld+json">' . wp_json_encode( $faq, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'nuvirahub_schema_jsonld', 5 );

/**
 * Excerpt length.
 */
function nuvirahub_excerpt_length( $length ) {
	return 22;
}
add_filter( 'excerpt_length', 'nuvirahub_excerpt_length' );

function nuvirahub_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'nuvirahub_excerpt_more' );
