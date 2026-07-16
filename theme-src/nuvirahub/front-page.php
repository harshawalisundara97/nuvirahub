<?php
/**
 * Front page (Home) template.
 *
 * @package Nuvirahub
 */

get_header();

$nv_subscribed = isset( $_GET['subscribed'] ) ? sanitize_text_field( wp_unslash( $_GET['subscribed'] ) ) : '';

$nv_portfolio = nuvirahub_get_page_by_title( 'Portfolio' );
$nv_services  = nuvirahub_get_page_by_title( 'Services' );
$nv_contact   = nuvirahub_get_page_by_title( 'Contact' );
$nv_launch    = nuvirahub_get_page_by_title( 'Startup Launchpad' );
$nv_logist    = nuvirahub_get_page_by_title( 'Logistics' );
$nv_erp       = nuvirahub_get_page_by_title( 'ERP Solutions' );
$nv_soft      = nuvirahub_get_page_by_title( 'Software & Apps' );
$nv_cons      = nuvirahub_get_page_by_title( 'Growth Consulting' );
$nv_creat     = nuvirahub_get_page_by_title( 'Creative & Design' );
$nv_mark      = nuvirahub_get_page_by_title( 'Brand & Marketing' );

$portfolio_url = $nv_portfolio ? get_permalink( $nv_portfolio->ID ) : home_url( '/portfolio' );
$services_url  = $nv_services ? get_permalink( $nv_services->ID ) : home_url( '/services' );
$contact_url   = $nv_contact ? get_permalink( $nv_contact->ID ) : home_url( '/contact' );
$launch_url    = $nv_launch ? get_permalink( $nv_launch->ID ) : home_url( '/startup-launchpad' );
$logist_url    = $nv_logist ? get_permalink( $nv_logist->ID ) : home_url( '/logistics' );
$erp_url       = $nv_erp ? get_permalink( $nv_erp->ID ) : home_url( '/erp-solutions' );
$soft_url      = $nv_soft ? get_permalink( $nv_soft->ID ) : home_url( '/software-apps' );
$cons_url      = $nv_cons ? get_permalink( $nv_cons->ID ) : home_url( '/growth-consulting' );
$creat_url     = $nv_creat ? get_permalink( $nv_creat->ID ) : home_url( '/creative-design' );
$mark_url      = $nv_mark ? get_permalink( $nv_mark->ID ) : home_url( '/brand-marketing' );
$nv_constr     = nuvirahub_get_page_by_title( 'Construction' );
$constr_url    = $nv_constr ? get_permalink( $nv_constr->ID ) : home_url( '/construction' );
?>

<?php
$nv_hero_vid    = get_template_directory() . '/assets/video/ai-handshake.mp4';
$nv_hero_vurl   = get_template_directory_uri() . '/assets/video/ai-handshake.mp4';
$nv_hero_poster = get_template_directory_uri() . '/assets/video/ai-handshake.jpg';
$nv_has_poster  = file_exists( get_template_directory() . '/assets/video/ai-handshake.jpg' );
?>
<section class="nv-hero">
	<div class="nv-hero-bg">
		<?php if ( file_exists( $nv_hero_vid ) ) : ?>
			<video class="nv-hero-video-bg" autoplay muted loop playsinline preload="metadata"<?php echo $nv_has_poster ? ' poster="' . esc_url( $nv_hero_poster ) . '"' : ''; ?>>
				<source src="<?php echo esc_url( $nv_hero_vurl ); ?>" type="video/mp4">
			</video>
		<?php endif; ?>
		<div class="nv-hero-grid"></div>
		<div class="nv-orb nv-orb1"></div>
		<div class="nv-orb nv-orb2"></div>
		<div class="nv-orb nv-orb3"></div>
	</div>
	<div class="nv-hero-content">
		<div class="nv-hero-text">
			<div class="nv-badge"><span class="nv-badge-dot"></span>Helping founders &amp; enterprises grow</div>
			<h1>One partner for<br><span>everything your business needs.</span></h1>
			<p class="nv-hero-sub">Software, consulting, freight logistics, creative, marketing, ERP — and a complete launch service for founders starting from zero. Nuvirahub is the team behind the team.</p>
			<div class="nv-hero-actions">
				<a class="nv-btn-primary" href="<?php echo esc_url( $launch_url ); ?>">Launch My Business</a>
				<a class="nv-btn-ghost" href="<?php echo esc_url( $services_url ); ?>">Explore All Services</a>
			</div>
		</div>
		<div class="nv-hero-stats">
			<div class="nv-stat"><div class="nv-stat-num">3</div><div class="nv-stat-label">Co-founders</div></div>
			<div class="nv-stat"><div class="nv-stat-num">8</div><div class="nv-stat-label">Service Pillars</div></div>
			<div class="nv-stat"><div class="nv-stat-num">2026</div><div class="nv-stat-label">Founded · Dehiwala, LK</div></div>
			<div class="nv-stat"><div class="nv-stat-num">4h</div><div class="nv-stat-label">Reply Time, Mon–Sat</div></div>
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

<!-- CLIENT LOGO SHOWCASE -->
<section class="nv-clients" aria-label="Our clients">
	<div class="nv-clients-head">
		<span class="nv-clients-eyebrow">Sectors we deliver for</span>
	</div>
	<div class="nv-clients-track-wrap">
		<div class="nv-clients-track">
			<?php
			$clients = array( 'Software & Apps', 'Startups & Founders', 'Sea & Air Logistics', 'Creative & Design', 'Brand & Marketing', 'Enterprise ERP', 'Construction', 'Nuvira Spice Co.' );
			for ( $i = 0; $i < 2; $i++ ) {
				foreach ( $clients as $client ) {
					echo '<span class="nv-client-logo">' . esc_html( $client ) . '</span>';
				}
			}
			?>
		</div>
	</div>
</section>

<!-- STARTUP LAUNCHPAD SPOTLIGHT -->
<div class="nv-section nv-reveal" style="padding-bottom:0">
	<div class="nv-spotlight">
		<div class="nv-spotlight-bg"></div>
		<div class="nv-spotlight-content">
			<div class="nv-tag">Our flagship service</div>
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
	<h2 class="nv-title">Eight services. <span>One bill. One team.</span></h2>
	<p class="nv-sub">From the moment you have an idea to the moment you're scaling globally — every capability you need under one roof.</p>
	<div class="nv-pillars" style="margin-top:48px">
		<a class="nv-pillar" href="<?php echo esc_url( $soft_url ); ?>">
			<div class="nv-pillar-num">01</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><rect x="6" y="9" width="36" height="26" rx="2"/><line x1="6" y1="30" x2="42" y2="30"/><line x1="18" y1="40" x2="30" y2="40"/><line x1="24" y1="35" x2="24" y2="40"/></svg>
			<h3>Software &amp; Apps</h3>
			<p>Production-grade web platforms, native &amp; cross-platform mobile apps, and custom Windows desktop tools — built around your workflow, owned by you.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $launch_url ); ?>">
			<div class="nv-pillar-num">02</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><path d="M28 8c8 0 12 4 12 12 0 6-4 12-12 18-6-2-10-6-12-12-4 0-8-2-8-8 0-2 2-4 4-4 2 0 4 2 4 4l4-4c2-4 6-6 8-6z"/><circle cx="30" cy="18" r="2"/><path d="M14 34l-4 4M18 38l-4 4"/></svg>
			<h3>Startup Launchpad</h3>
			<p>The full founder package — business registration, tax IDs, document prep, government liaison, banking, brand &amp; website. Live in 14 days.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $cons_url ); ?>">
			<div class="nv-pillar-num">03</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><polyline points="6,36 16,24 24,30 36,14 42,18"/><polyline points="36,14 42,14 42,20"/><line x1="6" y1="42" x2="42" y2="42"/></svg>
			<h3>Growth Consulting</h3>
			<p>Strategy, operations, financial modelling. We don't hand over a deck — we sit inside your team until the metric you care about moves.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $logist_url ); ?>">
			<div class="nv-pillar-num">04</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><path d="M6 30l4-10h28l4 10"/><path d="M4 34c2 4 8 4 10 0s8-4 10 0 8 4 10 0 8-4 10 0"/><line x1="24" y1="10" x2="24" y2="20"/><path d="M18 14l6-4 6 4"/></svg>
			<h3>Logistics — Sea &amp; Air</h3>
			<p>End-to-end freight forwarding. FCL/LCL ocean, express air cargo, customs clearance, marine insurance, last-mile delivery. One coordinator handles it all.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $creat_url ); ?>">
			<div class="nv-pillar-num">05</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="18"/><circle cx="16" cy="18" r="2"/><circle cx="30" cy="14" r="2"/><circle cx="34" cy="26" r="2"/><path d="M24 42c4 0 6-2 6-5s-3-4-3-7c0-2 2-4 5-4"/></svg>
			<h3>Creative &amp; Design</h3>
			<p>Graphic design for brand &amp; packaging, photoreal 3D product / interior renders, and full AutoCAD architectural drafting + house plan sets.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $mark_url ); ?>">
			<div class="nv-pillar-num">06</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><path d="M8 18v12l24 8V10L8 18z"/><path d="M32 14c4 0 7 4 7 10s-3 10-7 10"/><path d="M14 30v6c0 2 2 4 4 4s4-2 4-4v-4"/></svg>
			<h3>Brand &amp; Marketing</h3>
			<p>Brand identity systems, social media management with paid campaigns, technical SEO &amp; content strategy — the engine that brings customers in.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $erp_url ); ?>">
			<div class="nv-pillar-num">07</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><rect x="8" y="14" width="14" height="28"/><rect x="26" y="6" width="14" height="36"/><line x1="11" y1="20" x2="19" y2="20"/><line x1="11" y1="26" x2="19" y2="26"/><line x1="11" y1="32" x2="19" y2="32"/><line x1="29" y1="14" x2="37" y2="14"/><line x1="29" y1="22" x2="37" y2="22"/><line x1="29" y1="30" x2="37" y2="30"/></svg>
			<h3>ERP for Enterprise</h3>
			<p>One connected system — finance, HR &amp; payroll, inventory, CRM, production, BI. Implementation in 8–12 weeks with 3 months free support.</p>
			<span class="nv-pillar-cta">Learn more →</span>
		</a>
		<a class="nv-pillar" href="<?php echo esc_url( $constr_url ); ?>">
			<div class="nv-pillar-num">08</div>
			<svg class="nv-pillar-svg" viewBox="0 0 48 48"><path d="M8 42V22l16-12 16 12v20"/><line x1="4" y1="42" x2="44" y2="42"/><rect x="19" y="30" width="10" height="12"/><line x1="24" y1="10" x2="24" y2="4"/><line x1="24" y1="4" x2="36" y2="4"/><line x1="36" y1="4" x2="36" y2="10"/></svg>
			<h3>Construction &amp; Architecture</h3>
			<p>House design, interior &amp; exterior, MEP drawings, BIM modelling, project planning — and end-to-end construction by our own team.</p>
			<span class="nv-pillar-cta">Learn more →</span>
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
	<div class="nv-tag">Honest words from real people</div>
	<h2 class="nv-title">Here's what's <span>been said</span> about us.</h2>
	<p class="nv-sub">Early words from the people around our work — clients, partners and customers across our service pillars. Swipe through; your project could be next.</p>

	<div class="nv-testimonial-carousel nv-swipe-carousel">
		<div class="nv-swipe-track">
			<div class="nv-swipe-slide">
				<div class="nv-testimonial">
					<p class="nv-testimonial-text">Harsha's engineering work has been consistent and dependable. Three years with us, across multiple production systems — fast delivery, clean code, and the willingness to learn whatever the domain needs.</p>
					<div class="nv-testimonial-author">
						<div class="nv-testimonial-avatar">PC</div>
						<div>
							<div style="font-size:14px;font-weight:500">Pet Care Solution (Pvt) Ltd</div>
							<div style="font-size:11px;color:var(--muted)">On Harsha — Nuvirahub co-founder</div>
						</div>
					</div>
				</div>
			</div>
			<div class="nv-swipe-slide">
				<div class="nv-testimonial">
					<p class="nv-testimonial-text">The Launchpad did exactly what it promised — company registered, tax IDs sorted, brand and website live, all inside two weeks. I only had to show up and sign.</p>
					<div class="nv-testimonial-author">
						<div class="nv-testimonial-avatar" style="background:linear-gradient(135deg,var(--accent),var(--accent2))">DK</div>
						<div>
							<div style="font-size:14px;font-weight:500">Dilini K.</div>
							<div style="font-size:11px;color:var(--muted)">Startup founder — Colombo</div>
						</div>
					</div>
				</div>
			</div>
			<div class="nv-swipe-slide">
				<div class="nv-testimonial">
					<p class="nv-testimonial-text">Sea freight quotes in hours, not days. Our first container from Colombo cleared customs without a single surprise charge — they handled every document.</p>
					<div class="nv-testimonial-author">
						<div class="nv-testimonial-avatar" style="background:linear-gradient(135deg,var(--accent3),var(--accent))">RF</div>
						<div>
							<div style="font-size:14px;font-weight:500">Ruwan F.</div>
							<div style="font-size:11px;color:var(--muted)">Importer — Negombo</div>
						</div>
					</div>
				</div>
			</div>
			<div class="nv-swipe-slide">
				<div class="nv-testimonial">
					<p class="nv-testimonial-text">They rebuilt our brand from the logo up, and the 3D visualisations sold the project to investors before construction even started.</p>
					<div class="nv-testimonial-author">
						<div class="nv-testimonial-avatar" style="background:linear-gradient(135deg,var(--accent2),var(--accent3))">SP</div>
						<div>
							<div style="font-size:14px;font-weight:500">Sanjeewa P.</div>
							<div style="font-size:11px;color:var(--muted)">Property developer — Kandy</div>
						</div>
					</div>
				</div>
			</div>
			<div class="nv-swipe-slide">
				<div class="nv-testimonial">
					<p class="nv-testimonial-text">Ceylon cinnamon arrived in Riga vacuum-sealed, beautifully packed and fresher than anything we can buy locally. Ordering over WhatsApp took two minutes.</p>
					<div class="nv-testimonial-author">
						<div class="nv-testimonial-avatar" style="background:linear-gradient(135deg,#f59e0b,#ef4444)">EB</div>
						<div>
							<div style="font-size:14px;font-weight:500">Elīna B.</div>
							<div style="font-size:11px;color:var(--muted)">Nuvira Spice Co. customer — Latvia</div>
						</div>
					</div>
				</div>
			</div>
			<div class="nv-swipe-slide">
				<div class="nv-testimonial">
					<p class="nv-testimonial-text">One ERP for inventory, invoicing and payroll that actually matches how a Sri Lankan SME runs — and support answers on WhatsApp in minutes, not days.</p>
					<div class="nv-testimonial-author">
						<div class="nv-testimonial-avatar" style="background:linear-gradient(135deg,#10b981,var(--accent3))">NM</div>
						<div>
							<div style="font-size:14px;font-weight:500">Nuwan M.</div>
							<div style="font-size:11px;color:var(--muted)">Manufacturing SME — Kandy</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="nv-section nv-reveal" style="padding-top:0">
	<div class="nv-newsletter">
		<div class="nv-tag" style="margin-bottom:12px">Stay in the loop</div>
		<h2 class="nv-title" style="font-size:32px;margin-bottom:8px">Startup tips, growth insights, monthly.</h2>
		<?php if ( 'success' === $nv_subscribed ) : ?>
			<p style="font-size:14px;color:var(--accent3)">Thanks — you're on the list.</p>
		<?php elseif ( 'error' === $nv_subscribed ) : ?>
			<p style="font-size:14px;color:#ef4444">Please enter a valid email address.</p>
		<?php else : ?>
			<p style="font-size:14px;color:var(--muted2)">Practical playbooks from our consulting desk. No spam, ever.</p>
		<?php endif; ?>
		<form class="nv-newsletter-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
			<input type="hidden" name="action" value="nuvirahub_newsletter">
			<?php wp_nonce_field( 'nuvirahub_newsletter', 'nuvirahub_newsletter_nonce' ); ?>
			<input type="email" name="nv_newsletter_email" placeholder="Your email address" required>
			<button class="nv-btn-primary" style="padding:11px 24px" type="submit">Subscribe</button>
		</form>
	</div>
</div>

<?php get_footer();
