<?php
/**
 * Template Name: Nuvirahub Brand & Marketing
 *
 * @package Nuvirahub
 */
get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Brand &amp; Digital Marketing</div>
	<h1>Get found. Be remembered.<br><span>Sell more.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">A brand that holds together, a content engine that doesn't stop, and SEO that compounds. We build the system, you keep the customers.</p>
	<div style="margin-top:28px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1">
		<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Start Marketing</a>
		<a class="nv-btn-ghost" href="#what">What we run</a>
	</div>
</div>

<div class="nv-section nv-reveal" id="what">
	<div class="nv-tag">Three layers</div>
	<h2 class="nv-title">Brand + content + SEO. <span>Built to compound.</span></h2>
	<div class="nv-grid-3" style="margin-top:32px">
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'id-card', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Brand Identity</h4><p style="font-size:13px;color:var(--muted2)">Naming, logo systems, colour, typography, brand guidelines, asset libraries. Built so everything from a business card to a billboard feels like you.</p></div>
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'share-2', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">Social Media</h4><p style="font-size:13px;color:var(--muted2)">Content calendars, reels, paid campaigns, community management. Instagram + Facebook + TikTok + LinkedIn — we run what your audience uses.</p></div>
		<div class="nv-glass"><div class="nv-card-icon"><?php echo nv_icon( 'search', 18 ); ?></div><h4 style="font-family:var(--display);font-size:18px;margin-bottom:8px">SEO &amp; Analytics</h4><p style="font-size:13px;color:var(--muted2)">Technical SEO audit, content strategy, Google Business Profile, GA4 dashboards. Track what works, do more of it.</p></div>
	</div>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-tag">Retainer options</div>
	<h2 class="nv-title">Plans that scale with you.</h2>
	<div class="nv-grid-3" style="margin-top:32px">
		<div class="nv-glass" style="padding:32px"><h4 style="font-family:var(--display);font-size:20px;margin-bottom:6px">Starter</h4><p style="color:var(--accent2);font-size:13px;margin-bottom:18px">LKR 60k / month</p><p style="font-size:13px;color:var(--muted2);line-height:1.7">12 social posts · 2 reels · monthly SEO report · Google Business management.</p></div>
		<div class="nv-glass" style="padding:32px;border-color:rgba(108,99,255,.35)"><h4 style="font-family:var(--display);font-size:20px;margin-bottom:6px">Growth</h4><p style="color:var(--accent2);font-size:13px;margin-bottom:18px">LKR 150k / month</p><p style="font-size:13px;color:var(--muted2);line-height:1.7">Everything in Starter + 4 blog posts · paid campaign management · email marketing.</p></div>
		<div class="nv-glass" style="padding:32px"><h4 style="font-family:var(--display);font-size:20px;margin-bottom:6px">Scale</h4><p style="color:var(--accent2);font-size:13px;margin-bottom:18px">Custom</p><p style="font-size:13px;color:var(--muted2);line-height:1.7">Full-stack marketing team on retainer. Strategy, execution, dedicated analyst.</p></div>
	</div>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0">
		<div class="nv-tag" style="margin-bottom:12px">Free marketing audit</div>
		<h2 class="nv-title" style="margin-bottom:12px">Send your URL.<br>We'll tell you what's leaking.</h2>
		<p style="color:var(--muted2);max-width:520px;margin:0 auto">SEO, social, conversion. A 15-minute video audit — no pitch.</p>
		<div style="margin-top:24px"><a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Request Audit</a></div>
	</div>
</div>

<?php get_footer();
