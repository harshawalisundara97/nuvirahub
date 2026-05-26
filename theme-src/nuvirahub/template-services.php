<?php
/**
 * Template Name: Nuvirahub Services
 *
 * @package Nuvirahub
 */

get_header();

$nv_contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $nv_contact ? get_permalink( $nv_contact->ID ) : home_url( '/contact' );
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Services</div>
	<h1>Solutions built for<br><span>modern brands</span></h1>
	<p style="font-size:15px;color:var(--muted2);max-width:480px;margin:0 auto">From strategy to execution, every service we offer is designed to deliver real, measurable results.</p>
</div>

<div class="nv-section">
	<div class="nv-reveal" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:24px">
		<div class="nv-service"><div class="nv-service-num">01</div><div class="nv-service-title">UI/UX Design</div><div class="nv-service-desc">Visually stunning, user-tested interface design including glassmorphism, motion, dark themes, and responsive layouts that convert.</div><div class="nv-service-tag">Design Systems</div></div>
		<div class="nv-service"><div class="nv-service-num">02</div><div class="nv-service-title">Website Development</div><div class="nv-service-desc">Custom WordPress and full-stack development with fast load times, clean code, and mobile-first responsive builds.</div><div class="nv-service-tag">WordPress &middot; React</div></div>
		<div class="nv-service"><div class="nv-service-num">03</div><div class="nv-service-title">E-Commerce</div><div class="nv-service-desc">WooCommerce stores and landing pages built to maximise product discovery, cart conversions, and repeat purchases.</div><div class="nv-service-tag">WooCommerce</div></div>
		<div class="nv-service"><div class="nv-service-num">04</div><div class="nv-service-title">Brand Identity</div><div class="nv-service-desc">Logo design, colour systems, typography, and brand guidelines that give your business a distinctive, memorable visual identity.</div><div class="nv-service-tag">Branding</div></div>
		<div class="nv-service"><div class="nv-service-num">05</div><div class="nv-service-title">SEO &amp; Performance</div><div class="nv-service-desc">Technical SEO audits, on-page optimisation, Core Web Vitals improvements, and analytics setup to drive organic growth.</div><div class="nv-service-tag">SEO &middot; Analytics</div></div>
		<div class="nv-service"><div class="nv-service-num">06</div><div class="nv-service-title">Ongoing Support</div><div class="nv-service-desc">Monthly retainer packages for site maintenance, content updates, security monitoring, and performance optimisation.</div><div class="nv-service-tag">Maintenance</div></div>
	</div>

	<div class="nv-reveal" style="margin-top:72px">
		<div class="nv-tag">Pricing</div>
		<h2 class="nv-title">Simple, transparent plans</h2>
		<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px;margin-top:40px">
			<div class="nv-glass" style="padding:32px">
				<div style="font-size:11px;font-weight:600;letter-spacing:.08em;color:var(--muted2);text-transform:uppercase;margin-bottom:12px">Starter</div>
				<div style="font-family:'Syne',sans-serif;font-size:38px;font-weight:800;margin-bottom:4px">$499</div>
				<div style="font-size:12px;color:var(--muted);margin-bottom:24px">One-time project</div>
				<div style="font-size:13px;color:var(--muted2);line-height:2">&#10003; 3-page website<br>&#10003; Mobile responsive<br>&#10003; Basic SEO setup<br>&#10003; 30-day support</div>
				<a class="nv-btn-ghost" style="width:100%;margin-top:24px;padding:10px;text-align:center" href="<?php echo esc_url( $contact_url ); ?>">Get started</a>
			</div>
			<div class="nv-price-featured">
				<div class="nv-price-badge">Most Popular</div>
				<div style="font-size:11px;font-weight:600;letter-spacing:.08em;color:var(--accent2);text-transform:uppercase;margin-bottom:12px">Professional</div>
				<div style="font-family:'Syne',sans-serif;font-size:38px;font-weight:800;margin-bottom:4px">$999</div>
				<div style="font-size:12px;color:var(--muted);margin-bottom:24px">One-time project</div>
				<div style="font-size:13px;color:var(--muted2);line-height:2">&#10003; Up to 8 pages<br>&#10003; Custom UI design<br>&#10003; Full SEO package<br>&#10003; 90-day support</div>
				<a class="nv-btn-primary" style="width:100%;margin-top:24px;padding:10px;text-align:center" href="<?php echo esc_url( $contact_url ); ?>">Get started</a>
			</div>
			<div class="nv-glass" style="padding:32px">
				<div style="font-size:11px;font-weight:600;letter-spacing:.08em;color:var(--muted2);text-transform:uppercase;margin-bottom:12px">Enterprise</div>
				<div style="font-family:'Syne',sans-serif;font-size:38px;font-weight:800;margin-bottom:4px">Custom</div>
				<div style="font-size:12px;color:var(--muted);margin-bottom:24px">Scoped per project</div>
				<div style="font-size:13px;color:var(--muted2);line-height:2">&#10003; Unlimited pages<br>&#10003; E-commerce<br>&#10003; Brand identity<br>&#10003; Ongoing retainer</div>
				<a class="nv-btn-ghost" style="width:100%;margin-top:24px;padding:10px;text-align:center" href="<?php echo esc_url( $contact_url ); ?>">Contact us</a>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
