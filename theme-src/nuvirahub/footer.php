<?php
/**
 * Footer template.
 *
 * @package Nuvirahub
 */

$nv_about     = nuvirahub_get_page_by_title( 'About' );
$nv_services  = nuvirahub_get_page_by_title( 'Services' );
$nv_portfolio = nuvirahub_get_page_by_title( 'Portfolio' );
$nv_blog      = nuvirahub_get_page_by_title( 'Blog' );
$nv_contact   = nuvirahub_get_page_by_title( 'Contact' );
$nv_launch    = nuvirahub_get_page_by_title( 'Startup Launchpad' );
$nv_logist    = nuvirahub_get_page_by_title( 'Logistics' );
$nv_erp       = nuvirahub_get_page_by_title( 'ERP Solutions' );
$nv_privacy   = nuvirahub_get_page_by_title( 'Privacy Policy' );
$nv_terms     = nuvirahub_get_page_by_title( 'Terms of Service' );
$nv_shipping  = nuvirahub_get_page_by_title( 'Shipping &amp; Refunds' );

if ( ! function_exists( 'nv_link' ) ) {
	function nv_link( $page, $slug ) {
		return $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
	}
}
?>

<footer class="nv-footer">
	<div class="nv-footer-grid">
		<div>
			<div class="nv-footer-brand"><?php echo esc_html( get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : 'Nuvirahub' ); ?></div>
			<p class="nv-footer-desc">One partner for software, business growth, logistics, creative, marketing and ERP — plus a complete launch service for founders starting from zero.</p>
			<div class="nv-social" style="margin-top:20px">
				<a class="nv-social-btn" href="#" aria-label="LinkedIn"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></a>
				<a class="nv-social-btn" href="#" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
				<a class="nv-social-btn" href="#" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
				<a class="nv-social-btn" href="#" aria-label="X (Twitter)"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
			</div>
		</div>
		<div>
			<h4>Software</h4>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_services, 'services' ) ); ?>#software">Web &amp; Mobile Apps</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_services, 'services' ) ); ?>#software">Windows Apps</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_erp, 'erp-solutions' ) ); ?>">Enterprise ERP</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_services, 'services' ) ); ?>#marketing">SEO &amp; Marketing</a>
		</div>
		<div>
			<h4>Business</h4>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_launch, 'startup-launchpad' ) ); ?>">Startup Launchpad</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_services, 'services' ) ); ?>#consulting">Growth Consulting</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_services, 'services' ) ); ?>#creative">Creative &amp; Design</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_logist, 'logistics' ) ); ?>">Sea &amp; Air Freight</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( nuvirahub_get_page_by_title( 'Spices' ), 'spices' ) ); ?>">Nuvira Spice Co.</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( nuvirahub_get_page_by_title( 'Shop' ), 'shop' ) ); ?>">Shop Catalogue</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( nuvirahub_get_page_by_title( 'Wholesale' ), 'wholesale' ) ); ?>">Wholesale &amp; B2B</a>
		</div>
		<div>
			<h4>Company</h4>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_about, 'about' ) ); ?>">About Us</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_portfolio, 'portfolio' ) ); ?>">Portfolio</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_contact, 'contact' ) ); ?>">Contact</a>
		</div>
	</div>

	<!-- Contact strip -->
	<div class="nv-footer-contact">
		<div>
			<h4><?php echo nv_icon( 'map-pin', 14 ); ?>Visit</h4>
			<address>27/2E Pieris Avenue<br>Kalubowila, Dehiwala<br>Sri Lanka 10350</address>
		</div>
		<div>
			<h4><?php echo nv_icon( 'phone', 14 ); ?>Talk</h4>
			<a href="tel:+94716722599">+94 71 672 2599</a>
			<a href="<?php echo esc_url( nuvirahub_wa_link( 'Hi Nuvirahub!' ) ); ?>" target="_blank" rel="noopener">WhatsApp us</a>
		</div>
		<div>
			<h4><?php echo nv_icon( 'mail', 14 ); ?>Email</h4>
			<a href="mailto:nuvirahub@gmail.com">nuvirahub@gmail.com</a>
		</div>
		<div>
			<h4><?php echo nv_icon( 'check-circle', 14 ); ?>Hours</h4>
			<span>Mon–Fri · 9am–6pm IST<br>Sat · 9am–1pm</span>
		</div>
	</div>

	<div class="nv-footer-bottom">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <strong>Nuvirahub (Pvt) Ltd</strong>. All rights reserved.</span>
		<span class="nv-footer-legal">
			<?php if ( $nv_privacy ) : ?><a href="<?php echo esc_url( get_permalink( $nv_privacy->ID ) ); ?>">Privacy</a> · <?php endif; ?>
			<?php if ( $nv_terms ) : ?><a href="<?php echo esc_url( get_permalink( $nv_terms->ID ) ); ?>">Terms</a> · <?php endif; ?>
			<?php if ( $nv_shipping ) : ?><a href="<?php echo esc_url( get_permalink( $nv_shipping->ID ) ); ?>">Shipping &amp; Refunds</a><?php endif; ?>
		</span>
	</div>
</footer>

<!-- Floating WhatsApp button -->
<a class="nv-whatsapp" href="<?php echo esc_url( nuvirahub_wa_link( "Hi Nuvirahub, I'd like to chat about a project." ) ); ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
	<svg viewBox="0 0 32 32" aria-hidden="true">
		<path d="M16.001 3.2c-7.07 0-12.8 5.73-12.8 12.8 0 2.26.6 4.39 1.64 6.23L3.2 28.8l6.74-1.6a12.71 12.71 0 0 0 6.06 1.55c7.07 0 12.8-5.73 12.8-12.8 0-3.42-1.33-6.64-3.74-9.06A12.74 12.74 0 0 0 16 3.2zM23.4 22c-.31.88-1.55 1.68-2.31 1.79-.59.08-1.34.12-2.16-.14-1.55-.49-3.55-1.66-5.13-3.7-1.62-2.1-2.69-4.42-2.94-4.97-.25-.55-.07-1.41.21-1.97.27-.55 1.05-1.41 1.51-1.41.41 0 .87.07 1.18.21.45.18.6.43.83 1.1.23.66.8 2.27.87 2.43.07.16.12.34.02.55-.1.21-.16.34-.31.51-.16.18-.34.4-.49.54-.16.16-.34.34-.14.66.21.34 1.04 1.71 2.23 2.77 1.53 1.37 2.82 1.79 3.16 1.96.34.18.55.16.75-.09.21-.25.86-1.01 1.09-1.36.23-.34.46-.29.77-.18.31.11 1.97.93 2.31 1.1.34.16.55.25.63.39.09.13.09.78-.22 1.66z"/>
	</svg>
	<span class="nv-whatsapp-tooltip">Chat with us on WhatsApp</span>
</a>

<?php wp_footer(); ?>
</body>
</html>
