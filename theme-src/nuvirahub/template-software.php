<?php
/**
 * Template Name: Nuvirahub Software & Apps
 *
 * @package Nuvirahub
 */
get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Software &amp; Apps</div>
	<h1>Apps for every screen.<br><span>And the desktop too.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">Whether your customers live in a browser, a phone, or a Windows shop floor, we ship the right tool — production-grade, maintained, and built around the workflow you actually run.</p>
	<div style="margin-top:28px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1">
		<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Start a Project</a>
		<a class="nv-btn-ghost" href="#stack">See our stack</a>
	</div>
</div>

<div class="nv-section nv-reveal" id="stack">
	<div class="nv-tag">What we build</div>
	<h2 class="nv-title">Three platforms. <span>One team.</span></h2>
	<div class="nv-grid-3" style="margin-top:32px">
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'globe', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Websites &amp; Web Apps</h4><p style="font-size:13px;color:var(--muted2)">WordPress, React, Laravel, Next.js, headless commerce. Fast, responsive, SEO-ready. From marketing sites to multi-tenant SaaS.</p></div>
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'smartphone', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Mobile Apps</h4><p style="font-size:13px;color:var(--muted2)">Native iOS &amp; Android, plus cross-platform Flutter and React Native builds. App Store + Play Store submission included.</p></div>
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'monitor', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Windows Applications</h4><p style="font-size:13px;color:var(--muted2)">Desktop tools in C# / .NET, Qt, Electron — POS, inventory, custom utilities. MSI installers, auto-update, code-signed.</p></div>
	</div>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-tag">How we work</div>
	<h2 class="nv-title">No surprises. <span>Fixed scope, weekly check-ins.</span></h2>
	<div class="nv-process">
		<div class="nv-step"><div class="nv-step-num">1</div><div class="nv-step-title">Discovery</div><div class="nv-step-desc">Free 30-min call. We map your goals, users, constraints.</div></div>
		<div class="nv-step"><div class="nv-step-num">2</div><div class="nv-step-title">Scope</div><div class="nv-step-desc">Fixed proposal: features, timeline, milestones, price.</div></div>
		<div class="nv-step"><div class="nv-step-num">3</div><div class="nv-step-title">Build</div><div class="nv-step-desc">Weekly demos. Real artefacts. You own the code.</div></div>
		<div class="nv-step"><div class="nv-step-num">4</div><div class="nv-step-title">Launch + Support</div><div class="nv-step-desc">Deploy, train, and 90 days hyper-care included.</div></div>
	</div>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0">
		<div class="nv-tag" style="margin-bottom:12px">Ready to ship?</div>
		<h2 class="nv-title" style="margin-bottom:12px">Tell us what you're building.</h2>
		<p style="color:var(--muted2);max-width:520px;margin:0 auto">Free 30-min scoping call. You walk away with a clear plan — paid or not.</p>
		<div style="margin-top:24px"><a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Start a Conversation</a></div>
	</div>
</div>

<?php get_footer();
