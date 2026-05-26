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
		<a class="nv-pillar" href="<?php echo esc_url( $services_url ); ?>#software">
			<div class="nv-pillar-num">01</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><rect x="6" y="9" width="36" height="26" rx="2"/><line x1="6" y1="30" x2="42" y2="30"/><line x1="18" y1="40" x2="30" y2="40"/><line x1="24" y1="35" x2="24" y2="40"/></svg>
			<h3>Software &amp; Apps</h3><p>Web, mobile, Windows applications — custom built.</p>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $launch_url ); ?>">
			<div class="nv-pillar-num">02</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><path d="M28 8c8 0 12 4 12 12 0 6-4 12-12 18-6-2-10-6-12-12-4 0-8-2-8-8 0-2 2-4 4-4 2 0 4 2 4 4l4-4c2-4 6-6 8-6z"/><circle cx="30" cy="18" r="2"/><path d="M14 34l-4 4M18 38l-4 4"/></svg>
			<h3>Startup Launchpad</h3><p>We register your business and set it up — end to end.</p>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $services_url ); ?>#consulting">
			<div class="nv-pillar-num">03</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><polyline points="6,36 16,24 24,30 36,14 42,18"/><polyline points="36,14 42,14 42,20"/><line x1="6" y1="42" x2="42" y2="42"/></svg>
			<h3>Growth Consulting</h3><p>Strategy, operations, finance — playbooks that ship.</p>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $logist_url ); ?>">
			<div class="nv-pillar-num">04</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><path d="M6 30l4-10h28l4 10"/><path d="M4 34c2 4 8 4 10 0s8-4 10 0 8 4 10 0 8-4 10 0"/><line x1="24" y1="10" x2="24" y2="20"/><path d="M18 14l6-4 6 4"/></svg>
			<h3>Logistics — Sea &amp; Air</h3><p>Freight forwarding, customs, door-to-door delivery.</p>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $services_url ); ?>#creative">
			<div class="nv-pillar-num">05</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="18"/><circle cx="16" cy="18" r="2"/><circle cx="30" cy="14" r="2"/><circle cx="34" cy="26" r="2"/><path d="M24 42c4 0 6-2 6-5s-3-4-3-7c0-2 2-4 5-4"/></svg>
			<h3>Creative &amp; Design</h3><p>Graphic, 3D rendering, AutoCAD house plans.</p>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $services_url ); ?>#marketing">
			<div class="nv-pillar-num">06</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><path d="M8 18v12l24 8V10L8 18z"/><path d="M32 14c4 0 7 4 7 10s-3 10-7 10"/><path d="M14 30v6c0 2 2 4 4 4s4-2 4-4v-4"/></svg>
			<h3>Brand &amp; Marketing</h3><p>Identity, social media, SEO, content engines.</p>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $erp_url ); ?>">
			<div class="nv-pillar-num">07</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><rect x="8" y="14" width="14" height="28"/><rect x="26" y="6" width="14" height="36"/><line x1="11" y1="20" x2="19" y2="20"/><line x1="11" y1="26" x2="19" y2="26"/><line x1="11" y1="32" x2="19" y2="32"/><line x1="29" y1="14" x2="37" y2="14"/><line x1="29" y1="22" x2="37" y2="22"/><line x1="29" y1="30" x2="37" y2="30"/></svg>
			<h3>ERP for Enterprise</h3><p>Finance, HR, inventory, CRM, production — one system.</p>
		</a>
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
	<div class="nv-testimonial-carousel">
		<div class="nv-testimonial-track">
			<div class="nv-testimonial"><p class="nv-testimonial-text">Harsha's engineering work has been outstanding. His three years with us have spanned multiple production systems — fast delivery, clean code, and a deep willingness to learn whatever the domain needs.</p><div class="nv-testimonial-author"><div class="nv-testimonial-avatar">PC</div><div><div style="font-size:14px;font-weight:500">Pet Care Solution (Pvt) Ltd</div><div style="font-size:11px;color:var(--muted)">Harsha's current employer</div></div></div></div>
			<div class="nv-testimonial"><p class="nv-testimonial-text">Our freight from Shenzhen used to take 3 forwarders and 14 emails. With Nuvirahub it's one WhatsApp message. Containers land on time, every time.</p><div class="nv-testimonial-author"><div class="nv-testimonial-avatar" style="background:linear-gradient(135deg,#0ea5e9,#06b6d4)">MK</div><div><div style="font-size:14px;font-weight:500">Manjula K.</div><div style="font-size:11px;color:var(--muted)">COO, Crestline Imports</div></div></div></div>
			<div class="nv-testimonial"><p class="nv-testimonial-text">The ERP rollout was the smoothest IT project we've done. Finance, inventory, payroll — all in one place. Real-time margins for the first time ever.</p><div class="nv-testimonial-author"><div class="nv-testimonial-avatar" style="background:linear-gradient(135deg,#f59e0b,#ef4444)">PJ</div><div><div style="font-size:14px;font-weight:500">Priya J.</div><div style="font-size:11px;color:var(--muted)">Director, NovaBuild</div></div></div></div>
			<div class="nv-testimonial"><p class="nv-testimonial-text">From the logo to the AutoCAD house plans — every deliverable came back better than we asked for. They treat your project like it's their own.</p><div class="nv-testimonial-author"><div class="nv-testimonial-avatar" style="background:linear-gradient(135deg,#10b981,#14b8a6)">RN</div><div><div style="font-size:14px;font-weight:500">Ruvini N.</div><div style="font-size:11px;color:var(--muted)">Architect, Studio R+R</div></div></div></div>
			<div class="nv-testimonial"><p class="nv-testimonial-text">Their growth consulting team rebuilt our sales process top-to-bottom. Within 90 days we'd doubled our pipeline and tripled our close rate.</p><div class="nv-testimonial-author"><div class="nv-testimonial-avatar" style="background:linear-gradient(135deg,#ec4899,#f43f5e)">DM</div><div><div style="font-size:14px;font-weight:500">Dinuka M.</div><div style="font-size:11px;color:var(--muted)">CEO, Velo Tech</div></div></div></div>
		</div>
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
