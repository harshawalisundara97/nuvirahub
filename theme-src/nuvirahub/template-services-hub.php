<?php
/**
 * Template Name: Nuvirahub Services Hub
 *
 * Directory of all 7 service pillars — each card links to its own dedicated
 * detail page. Use this as the central /services/ landing.
 *
 * @package Nuvirahub
 */

get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );

$pages = array(
	'software'   => nuvirahub_get_page_by_title( 'Software & Apps' ),
	'launchpad'  => nuvirahub_get_page_by_title( 'Startup Launchpad' ),
	'consulting' => nuvirahub_get_page_by_title( 'Growth Consulting' ),
	'logistics'  => nuvirahub_get_page_by_title( 'Logistics' ),
	'creative'   => nuvirahub_get_page_by_title( 'Creative & Design' ),
	'marketing'  => nuvirahub_get_page_by_title( 'Brand & Marketing' ),
	'erp'        => nuvirahub_get_page_by_title( 'ERP Solutions' ),
);
$url = function( $page, $slug ) {
	return $page ? get_permalink( $page->ID ) : home_url( '/' . $slug );
};
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Services</div>
	<h1>One team. <span>Seven disciplines.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">From a logo to a launched company, a freight shipment to a full ERP rollout — Nuvirahub delivers under one roof. Pick a service to see what's included, our process, and pricing.</p>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-pillars">
		<a class="nv-pillar" href="<?php echo esc_url( $url( $pages['software'], 'software-apps' ) ); ?>">
			<div class="nv-pillar-num">01</div>
			<div class="nv-pillar-icon"><?php echo nv_icon( 'monitor', 32 ); ?></div>
			<h3>Software &amp; Apps</h3>
			<p>Production-grade web platforms, native &amp; cross-platform mobile apps, custom Windows desktop tools.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $url( $pages['launchpad'], 'startup-launchpad' ) ); ?>">
			<div class="nv-pillar-num">02</div>
			<div class="nv-pillar-icon"><?php echo nv_icon( 'rocket', 32 ); ?></div>
			<h3>Startup Launchpad</h3>
			<p>The full founder package — business registration, tax IDs, document prep, government liaison, brand &amp; website. Live in 14 days.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $url( $pages['consulting'], 'growth-consulting' ) ); ?>">
			<div class="nv-pillar-num">03</div>
			<div class="nv-pillar-icon"><?php echo nv_icon( 'trending-up', 32 ); ?></div>
			<h3>Business Growth Consulting</h3>
			<p>Strategy, operations, financial modelling. We sit inside your team until the metric you care about moves.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $url( $pages['logistics'], 'logistics' ) ); ?>">
			<div class="nv-pillar-num">04</div>
			<div class="nv-pillar-icon"><?php echo nv_icon( 'ship', 32 ); ?></div>
			<h3>Logistics — Sea &amp; Air</h3>
			<p>FCL/LCL ocean freight, express air cargo, customs clearance, marine insurance, last-mile delivery.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $url( $pages['creative'], 'creative-design' ) ); ?>">
			<div class="nv-pillar-num">05</div>
			<div class="nv-pillar-icon"><?php echo nv_icon( 'palette', 32 ); ?></div>
			<h3>Creative &amp; Design</h3>
			<p>Graphic design for brand &amp; packaging, photoreal 3D renders, AutoCAD architectural drafting &amp; house plans.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $url( $pages['marketing'], 'brand-marketing' ) ); ?>">
			<div class="nv-pillar-num">06</div>
			<div class="nv-pillar-icon"><?php echo nv_icon( 'megaphone', 32 ); ?></div>
			<h3>Brand &amp; Digital Marketing</h3>
			<p>Brand identity systems, social media management with paid campaigns, technical SEO &amp; content strategy.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $url( $pages['erp'], 'erp-solutions' ) ); ?>">
			<div class="nv-pillar-num">07</div>
			<div class="nv-pillar-icon"><?php echo nv_icon( 'building-2', 32 ); ?></div>
			<h3>ERP for Enterprise</h3>
			<p>One connected system — finance, HR, inventory, CRM, production, BI. 8–12 week implementation.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
	</div>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0">
		<div class="nv-tag" style="margin-bottom:12px">Let's scope your project</div>
		<h2 class="nv-title" style="margin-bottom:12px">Tell us what you need.<br>We'll tell you what it takes.</h2>
		<p style="color:var(--muted2);max-width:520px;margin:0 auto">Every engagement starts with a free 30-minute call. We listen, ask the awkward questions, and you walk away with a clear path forward — paid or not.</p>
		<div style="margin-top:24px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
			<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Start a Conversation</a>
		</div>
	</div>
</div>

<?php get_footer();
