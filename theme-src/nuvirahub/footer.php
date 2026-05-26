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

<?php wp_footer(); ?>
</body>
</html>
