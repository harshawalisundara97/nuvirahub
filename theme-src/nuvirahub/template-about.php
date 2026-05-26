<?php
/**
 * Template Name: Nuvirahub About
 *
 * @package Nuvirahub
 */

get_header();
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Our story</div>
	<h1>Passionate builders of<br><span>digital futures</span></h1>
	<p style="font-size:15px;color:var(--muted2);max-width:500px;margin:0 auto">We are Nuvirahub &mdash; a boutique digital studio helping forward-thinking brands create their best online presence.</p>
</div>

<div class="nv-section">
	<div class="nv-about-grid">
		<div class="nv-reveal">
			<div class="nv-tag">Who we are</div>
			<h2 class="nv-title" style="font-size:30px">Crafting experiences since day one</h2>
			<p style="font-size:14px;color:var(--muted2);line-height:1.8;margin-bottom:20px">Nuvirahub was founded with a clear mission: make world-class digital design accessible to businesses of all sizes. We believe that every brand deserves a beautiful, high-performing online presence that truly reflects who they are.</p>
			<p style="font-size:14px;color:var(--muted2);line-height:1.8;margin-bottom:32px">From startups to established brands, we bring the same level of care, creativity, and technical precision to every project we take on.</p>
			<div class="nv-value"><span class="nv-value-icon">&#127919;</span><div><strong style="font-size:14px;font-family:'Syne',sans-serif">Purpose-Driven</strong><p style="font-size:13px;color:var(--muted2);margin-top:4px">Every decision we make is grounded in your goals and your users' needs.</p></div></div>
			<div class="nv-value"><span class="nv-value-icon">&#10024;</span><div><strong style="font-size:14px;font-family:'Syne',sans-serif">Quality First</strong><p style="font-size:13px;color:var(--muted2);margin-top:4px">We never cut corners &mdash; clean code, sharp design, and thorough testing on every project.</p></div></div>
			<div class="nv-value"><span class="nv-value-icon">&#129309;</span><div><strong style="font-size:14px;font-family:'Syne',sans-serif">True Partnership</strong><p style="font-size:13px;color:var(--muted2);margin-top:4px">We work with you, not just for you. Transparent communication from brief to launch.</p></div></div>
		</div>
		<div class="nv-reveal">
			<div class="nv-about-visual">
				<div class="nv-founders">
					<div class="nv-founder"><div class="nv-avatar">HW</div><div class="nv-founder-name">Harsha Walisundara</div><div class="nv-founder-role">Co-founder</div></div>
					<div class="nv-founder"><div class="nv-avatar" style="background:linear-gradient(135deg,#0ea5e9,#06b6d4)">AN</div><div class="nv-founder-name">Akalanka Navarathne</div><div class="nv-founder-role">Co-founder</div></div>
					<div class="nv-founder"><div class="nv-avatar" style="background:linear-gradient(135deg,#f59e0b,#ef4444)">HW</div><div class="nv-founder-name">Heshan Wijesundara</div><div class="nv-founder-role">Co-founder</div></div>
				</div>
				<h3 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:700;margin:24px 0 4px">Three founders. One mission.</h3>
				<p style="font-size:13px;color:var(--muted2);margin-bottom:28px">Engineers, designers &amp; business builders based in Dehiwala, Sri Lanka.</p>
				<div style="text-align:left">
					<div class="nv-skill"><div class="nv-skill-label"><span>UI/UX Design</span><span>95%</span></div><div class="nv-skill-track"><div class="nv-skill-fill" style="width:95%"></div></div></div>
					<div class="nv-skill"><div class="nv-skill-label"><span>Web Development</span><span>90%</span></div><div class="nv-skill-track"><div class="nv-skill-fill" style="width:90%"></div></div></div>
					<div class="nv-skill"><div class="nv-skill-label"><span>WordPress &amp; CMS</span><span>98%</span></div><div class="nv-skill-track"><div class="nv-skill-fill" style="width:98%"></div></div></div>
					<div class="nv-skill"><div class="nv-skill-label"><span>SEO &amp; Analytics</span><span>85%</span></div><div class="nv-skill-track"><div class="nv-skill-fill" style="width:85%"></div></div></div>
					<div class="nv-skill"><div class="nv-skill-label"><span>Brand Strategy</span><span>88%</span></div><div class="nv-skill-track"><div class="nv-skill-fill" style="width:88%"></div></div></div>
				</div>
			</div>
			<div class="nv-grid-4" style="margin-top:20px">
				<div class="nv-glass" style="text-align:center;padding:20px"><div style="font-family:'Syne',sans-serif;font-size:28px;font-weight:800" class="nv-grad">50+</div><div style="font-size:11px;color:var(--muted);margin-top:4px">Projects</div></div>
				<div class="nv-glass" style="text-align:center;padding:20px"><div style="font-family:'Syne',sans-serif;font-size:28px;font-weight:800" class="nv-grad">30+</div><div style="font-size:11px;color:var(--muted);margin-top:4px">Clients</div></div>
				<div class="nv-glass" style="text-align:center;padding:20px"><div style="font-family:'Syne',sans-serif;font-size:28px;font-weight:800" class="nv-grad">5yr</div><div style="font-size:11px;color:var(--muted);margin-top:4px">Experience</div></div>
				<div class="nv-glass" style="text-align:center;padding:20px"><div style="font-family:'Syne',sans-serif;font-size:28px;font-weight:800" class="nv-grad">98%</div><div style="font-size:11px;color:var(--muted);margin-top:4px">Satisfaction</div></div>
			</div>
		</div>
	</div>

	<?php
	// If the page has body content, render it below.
	while ( have_posts() ) :
		the_post();
		if ( trim( get_the_content() ) ) :
			?>
			<div class="nv-content" style="padding-top:48px"><?php the_content(); ?></div>
			<?php
		endif;
	endwhile;
	?>
</div>

<?php
get_footer();
