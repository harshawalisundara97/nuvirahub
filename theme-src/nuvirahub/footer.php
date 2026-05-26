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
				<a class="nv-social-btn" href="#">𝕏</a>
				<a class="nv-social-btn" href="#">in</a>
				<a class="nv-social-btn" href="#">f</a>
				<a class="nv-social-btn" href="#">▶</a>
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
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( nuvirahub_get_page_by_title( 'Spices' ), 'spices' ) ); ?>">🌶️ Nuvira Spice Co.</a>
		</div>
		<div>
			<h4>Company</h4>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_about, 'about' ) ); ?>">About Us</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_portfolio, 'portfolio' ) ); ?>">Portfolio</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_blog, 'blog' ) ); ?>">Blog</a>
			<a class="nv-footer-link" href="<?php echo esc_url( nv_link( $nv_contact, 'contact' ) ); ?>">Contact</a>
			<a class="nv-footer-link" href="mailto:<?php echo esc_attr( get_option( 'admin_email' ) ); ?>"><?php echo esc_html( get_option( 'admin_email' ) ); ?></a>
		</div>
	</div>
	<div class="nv-footer-bottom">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : 'Nuvirahub' ); ?>. All rights reserved.</span>
		<span>Colombo, Sri Lanka · Mon–Fri 9am–6pm</span>
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
