<?php
/**
 * Front page (Home) template.
 *
 * @package Nuvirahub
 */

get_header();

$nv_portfolio = nuvirahub_get_page_by_title( 'Portfolio' );
$nv_services  = nuvirahub_get_page_by_title( 'Services' );
$nv_contact   = nuvirahub_get_page_by_title( 'Contact' );
$nv_launch    = nuvirahub_get_page_by_title( 'Startup Launchpad' );
$nv_logist    = nuvirahub_get_page_by_title( 'Logistics' );
$nv_erp       = nuvirahub_get_page_by_title( 'ERP Solutions' );

$portfolio_url = $nv_portfolio ? get_permalink( $nv_portfolio->ID ) : home_url( '/portfolio' );
$services_url  = $nv_services ? get_permalink( $nv_services->ID ) : home_url( '/services' );
$contact_url   = $nv_contact ? get_permalink( $nv_contact->ID ) : home_url( '/contact' );
$launch_url    = $nv_launch ? get_permalink( $nv_launch->ID ) : home_url( '/startup-launchpad' );
$logist_url    = $nv_logist ? get_permalink( $nv_logist->ID ) : home_url( '/logistics' );
$erp_url       = $nv_erp ? get_permalink( $nv_erp->ID ) : home_url( '/erp-solutions' );
?>

<section class="nv-hero">
	<div class="nv-hero-bg">
		<div class="nv-hero-grid"></div>
		<div class="nv-orb nv-orb1"></div>
		<div class="nv-orb nv-orb2"></div>
		<div class="nv-orb nv-orb3"></div>
	</div>
	<div class="nv-hero-content">
		<div class="nv-badge"><span class="nv-badge-dot"></span>Helping founders &amp; enterprises grow</div>
		<h1>One partner for<br><span>everything your business needs.</span></h1>
		<p class="nv-hero-sub">Software, consulting, freight logistics, creative, marketing, ERP — and a complete launch service for founders starting from zero. Nuvirahub is the team behind the team.</p>
		<div class="nv-hero-actions">
			<a class="nv-btn-primary" href="<?php echo esc_url( $launch_url ); ?>">🚀 Launch My Business</a>
			<a class="nv-btn-ghost" href="<?php echo esc_url( $services_url ); ?>">Explore All Services</a>
		</div>
		<div class="nv-hero-stats">
			<div class="nv-stat"><div class="nv-stat-num">7</div><div class="nv-stat-label">Service Pillars</div></div>
			<div class="nv-stat"><div class="nv-stat-num">50+</div><div class="nv-stat-label">Projects Delivered</div></div>
			<div class="nv-stat"><div class="nv-stat-num">98%</div><div class="nv-stat-label">Client Satisfaction</div></div>
			<div class="nv-stat"><div class="nv-stat-num">24h</div><div class="nv-stat-label">Response Time</div></div>
		</div>
	</div>
</section>

<div class="nv-strip">
	<div class="nv-marquee">
		<?php
		$items = array( 'Web &amp; Mobile Apps', 'Startup Launchpad', 'Business Consulting', 'Sea &amp; Air Freight', 'Graphic &amp; 3D Design', 'AutoCAD House Plans', 'Brand &amp; SEO Marketing', 'Enterprise ERP', 'Windows Desktop Apps' );
		for ( $i = 0; $i < 2; $i++ ) {
			foreach ( $items as $item ) {
				echo '<span class="nv-marquee-item"><span class="nv-marquee-dot"></span>' . $item . '</span>';
			}
		}
		?>
	</div>
</div>

<!-- STARTUP LAUNCHPAD SPOTLIGHT -->
<div class="nv-section nv-reveal" style="padding-bottom:0">
	<div class="nv-spotlight">
		<div class="nv-spotlight-bg"></div>
		<div class="nv-spotlight-content">
			<div class="nv-tag">⭐ Our flagship service</div>
			<h2 class="nv-spotlight-title">Starting a business?<br><span>We walk every step with you.</span></h2>
			<p>Registration, tax IDs, documents, government authorities, banking, brand &amp; website launch — packaged into a single 14-day programme. Built for Sri Lankan founders.</p>
			<div class="nv-spotlight-features">
				<span>✓ Business registration</span>
				<span>✓ All required documents</span>
				<span>✓ Authority contacts &amp; liaison</span>
				<span>✓ Brand + website + email setup</span>
				<span>✓ Bank account &amp; accounting</span>
			</div>
			<a class="nv-btn-primary" href="<?php echo esc_url( $launch_url ); ?>" style="margin-top:24px">Discover the Launchpad →</a>
		</div>
	</div>
</div>

<!-- 7-PILLAR GRID -->
<div class="nv-section nv-reveal">
	<div class="nv-tag">What we do</div>
	<h2 class="nv-title">Seven services. <span>One bill. One team.</span></h2>
	<p class="nv-sub">From the moment you have an idea to the moment you're scaling globally — every capability you need under one roof.</p>
	<div class="nv-pillars" style="margin-top:48px">
		<a class="nv-pillar" href="<?php echo esc_url( $services_url ); ?>#software"><div class="nv-pillar-num">01</div><div class="nv-pillar-icon">💻</div><h3>Software &amp; Apps</h3><p>Web, mobile, Windows applications — custom built.</p></a>
		<a class="nv-pillar" href="<?php echo esc_url( $launch_url ); ?>"><div class="nv-pillar-num">02</div><div class="nv-pillar-icon">🚀</div><h3>Startup Launchpad</h3><p>We register your business and set it up — end to end.</p></a>
		<a class="nv-pillar" href="<?php echo esc_url( $services_url ); ?>#consulting"><div class="nv-pillar-num">03</div><div class="nv-pillar-icon">📈</div><h3>Growth Consulting</h3><p>Strategy, operations, finance — playbooks that ship.</p></a>
		<a class="nv-pillar" href="<?php echo esc_url( $logist_url ); ?>"><div class="nv-pillar-num">04</div><div class="nv-pillar-icon">🚢</div><h3>Logistics — Sea &amp; Air</h3><p>Freight forwarding, customs, door-to-door delivery.</p></a>
		<a class="nv-pillar" href="<?php echo esc_url( $services_url ); ?>#creative"><div class="nv-pillar-num">05</div><div class="nv-pillar-icon">🎨</div><h3>Creative &amp; Design</h3><p>Graphic, 3D rendering, AutoCAD house plans.</p></a>
		<a class="nv-pillar" href="<?php echo esc_url( $services_url ); ?>#marketing"><div class="nv-pillar-num">06</div><div class="nv-pillar-icon">📣</div><h3>Brand &amp; Marketing</h3><p>Identity, social media, SEO, content engines.</p></a>
		<a class="nv-pillar" href="<?php echo esc_url( $erp_url ); ?>"><div class="nv-pillar-num">07</div><div class="nv-pillar-icon">🏢</div><h3>ERP for Enterprise</h3><p>Finance, HR, inventory, CRM, production — one system.</p></a>
	</div>
</div>

<div class="nv-divider"></div>

<div class="nv-section nv-reveal">
	<div class="nv-tag">How we work</div>
	<h2 class="nv-title">A simple, proven process</h2>
	<div class="nv-process">
		<div class="nv-step"><div class="nv-step-num">1</div><div class="nv-step-title">Discover</div><div class="nv-step-desc">A free consult to understand your goals, audience, and constraints.</div></div>
		<div class="nv-step"><div class="nv-step-num">2</div><div class="nv-step-title">Scope</div><div class="nv-step-desc">A clear, fixed proposal — deliverables, timeline, milestones, price.</div></div>
		<div class="nv-step"><div class="nv-step-num">3</div><div class="nv-step-title">Build</div><div class="nv-step-desc">Weekly progress, one project lead, real artefacts you can review.</div></div>
		<div class="nv-step"><div class="nv-step-num">4</div><div class="nv-step-title">Launch &amp; Support</div><div class="nv-step-desc">Go-live, training, and ongoing care — we don't disappear after launch.</div></div>
	</div>
</div>

<div class="nv-divider"></div>

<div class="nv-section nv-reveal">
	<div class="nv-tag">Client feedback</div>
	<h2 class="nv-title">What our clients say</h2>
	<div class="nv-grid-3" style="margin-top:40px">
		<div class="nv-testimonial"><p class="nv-testimonial-text">"Nuvirahub registered the company, got us a website, set up our accounting and even opened the bank account. We focused on selling — they handled the rest."</p><div class="nv-testimonial-author"><div class="nv-testimonial-avatar">SA</div><div><div style="font-size:13px;font-weight:500">Sahan A.</div><div style="font-size:11px;color:var(--muted)">Founder, Brewline LK</div></div></div></div>
		<div class="nv-testimonial"><p class="nv-testimonial-text">"Our freight from Shenzhen used to take 3 forwarders and 14 emails. With Nuvirahub it's one WhatsApp message. Containers land on time, every time."</p><div class="nv-testimonial-author"><div class="nv-testimonial-avatar" style="background:linear-gradient(135deg,#0ea5e9,#06b6d4)">MK</div><div><div style="font-size:13px;font-weight:500">Manjula K.</div><div style="font-size:11px;color:var(--muted)">COO, Crestline Imports</div></div></div></div>
		<div class="nv-testimonial"><p class="nv-testimonial-text">"The ERP rollout was the smoothest IT project we've done. Finance, inventory, payroll — all in one place. Real-time margins for the first time ever."</p><div class="nv-testimonial-author"><div class="nv-testimonial-avatar" style="background:linear-gradient(135deg,#f59e0b,#ef4444)">PJ</div><div><div style="font-size:13px;font-weight:500">Priya J.</div><div style="font-size:11px;color:var(--muted)">Director, NovaBuild</div></div></div></div>
	</div>
</div>

<div class="nv-section nv-reveal" style="padding-top:0">
	<div class="nv-newsletter">
		<div class="nv-tag" style="margin-bottom:12px">Stay in the loop</div>
		<h2 class="nv-title" style="font-size:32px;margin-bottom:8px">Startup tips, growth insights, monthly.</h2>
		<p style="font-size:14px;color:var(--muted2)">Practical playbooks from our consulting desk. No spam, ever.</p>
		<form class="nv-newsletter-form" action="<?php echo esc_url( $contact_url ); ?>" method="get">
			<input type="email" name="subscribe" placeholder="Your email address" required>
			<button class="nv-btn-primary" style="padding:11px 24px" type="submit">Subscribe</button>
		</form>
	</div>
</div>

<?php get_footer();
