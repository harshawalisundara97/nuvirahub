<?php
/**
 * Template Name: Nuvirahub Portfolio
 *
 * @package Nuvirahub
 */

get_header();
$contact = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );

/* Project data — edit here to add/remove projects.
 * Each project: title, desc, category (slug), emoji, gradient, ratio, tags */
$nv_projects = array(
	array(
		'title'    => 'SL Festival — Sri Lankan Cultural Events Platform',
		'desc'     => 'A discovery + booking platform for Sri Lankan cultural events, festivals and pop-ups. Built by Nuvirahub end-to-end — design, WordPress backend, custom event listings, location search, and admin dashboard. Live at slfestival.lk.',
		'category' => 'corporate',
		'cat_label'=> 'Live Project',
		'emoji'    => '',
		'image'    => get_template_directory_uri() . '/assets/img/portfolio/slfestival.png?v=' . filemtime( get_template_directory() . '/assets/img/portfolio/slfestival.png' ),
		'gradient' => 'linear-gradient(135deg, rgba(108,99,255,.3), rgba(56,189,248,.2))',
		'ratio'    => '16/10',
		'tags'     => array( 'WordPress', 'Event Listings', 'Custom Theme', 'Live' ),
	),
	array(
		'title'    => 'Lumex Fashion Store',
		'desc'     => 'A premium WooCommerce experience with glassmorphism UI, animated product cards, and a frictionless 2-click checkout. 40% conversion lift in the first quarter.',
		'category' => 'ecommerce',
		'cat_label'=> 'E-Commerce',
		'emoji'    => '🛍️',
		'gradient' => 'linear-gradient(135deg, rgba(236,72,153,.35), rgba(168,85,247,.25))',
		'ratio'    => '4/3',
		'tags'     => array( 'E-Commerce', 'WooCommerce', 'UI Design', 'Checkout UX' ),
	),
	array(
		'title'    => 'Crestline Consulting',
		'desc'     => 'Corporate website redesign with a dark cinematic theme, animated hero, and integrated CRM hand-off forms. Bounce rate down 38%.',
		'category' => 'corporate',
		'cat_label'=> 'Corporate',
		'emoji'    => '🏢',
		'gradient' => 'linear-gradient(135deg, rgba(245,158,11,.3), rgba(239,68,68,.25))',
		'ratio'    => '1/1',
		'tags'     => array( 'Corporate', 'WordPress', 'Branding', 'CRM' ),
	),
	array(
		'title'    => 'Velo App Landing',
		'desc'     => 'High-converting SaaS landing page with parallax storytelling, pricing table, and Stripe-powered trial signup. Demo bookings up 5×.',
		'category' => 'saas',
		'cat_label'=> 'SaaS',
		'emoji'    => '📱',
		'gradient' => 'linear-gradient(135deg, rgba(16,185,129,.3), rgba(56,189,248,.25))',
		'ratio'    => '3/4',
		'tags'     => array( 'SaaS', 'Landing Page', 'Conversion', 'Stripe' ),
	),
	array(
		'title'    => 'Inkline Creative Blog',
		'desc'     => 'Editorial blog platform with custom post types, social sharing, and a newsletter funnel that converted 12% of new visitors in month one.',
		'category' => 'blog',
		'cat_label'=> 'Blog',
		'emoji'    => '✍️',
		'gradient' => 'linear-gradient(135deg, rgba(139,92,246,.35), rgba(236,72,153,.25))',
		'ratio'    => '4/3',
		'tags'     => array( 'Blog', 'Editorial', 'Content', 'Newsletter' ),
	),
	array(
		'title'    => 'Zest Restaurant Group',
		'desc'     => 'Multi-location restaurant site with online reservations, menu showcases, and a location finder powered by Mapbox. 200+ bookings/week.',
		'category' => 'hospitality',
		'cat_label'=> 'Hospitality',
		'emoji'    => '🍽️',
		'gradient' => 'linear-gradient(135deg, rgba(245,158,11,.3), rgba(16,185,129,.25))',
		'ratio'    => '1/1',
		'tags'     => array( 'Hospitality', 'Booking', 'Multi-location' ),
	),
	array(
		'title'    => 'EduPath Academy LMS',
		'desc'     => 'Online learning platform with course catalog, student dashboards, video lessons, and Stripe Connect for instructor payouts.',
		'category' => 'saas',
		'cat_label'=> 'EdTech',
		'emoji'    => '🎓',
		'gradient' => 'linear-gradient(135deg, rgba(56,189,248,.3), rgba(99,102,241,.25))',
		'ratio'    => '4/3',
		'tags'     => array( 'Education', 'LMS', 'Dashboard', 'Stripe Connect' ),
	),
	array(
		'title'    => 'NovaBuild ERP Rollout',
		'desc'     => 'Full ERP implementation — finance, HR, inventory, production — for a 200-employee construction group. Real-time margin dashboards.',
		'category' => 'erp',
		'cat_label'=> 'ERP',
		'emoji'    => '🏗️',
		'gradient' => 'linear-gradient(135deg, rgba(99,102,241,.35), rgba(56,189,248,.2))',
		'ratio'    => '3/4',
		'tags'     => array( 'ERP', 'Finance', 'Manufacturing' ),
	),
	array(
		'title'    => 'Brewline Brand Identity',
		'desc'     => 'Complete brand system for a Colombo specialty coffee roaster — logo, packaging, retail signage, web, social. From idea to launch in 8 weeks.',
		'category' => 'branding',
		'cat_label'=> 'Branding',
		'emoji'    => '☕',
		'gradient' => 'linear-gradient(135deg, rgba(217,119,6,.4), rgba(120,53,15,.3))',
		'ratio'    => '1/1',
		'tags'     => array( 'Branding', 'Packaging', 'Identity' ),
	),
	array(
		'title'    => 'Horizon House Plans',
		'desc'     => 'AutoCAD architectural drafting + 3D walk-through render for a 4-storey residential project. Submission-ready DWG + photoreal interiors.',
		'category' => 'creative',
		'cat_label'=> 'Architecture',
		'emoji'    => '🏠',
		'gradient' => 'linear-gradient(135deg, rgba(56,189,248,.3), rgba(168,85,247,.25))',
		'ratio'    => '4/3',
		'tags'     => array( 'AutoCAD', 'Architecture', '3D Render' ),
	),
);
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Selected work</div>
	<h1>Projects we're <span>proud of</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">A cross-section of what we've shipped across software, e-commerce, branding, architecture, and ERP. Click any tile to learn more.</p>
</div>

<div class="nv-section">
	<!-- Filter tabs -->
	<div class="nv-tabs nv-reveal" role="tablist" style="margin:0 auto 32px;justify-self:center">
		<div class="nv-tabp active" data-filter="all">All</div>
		<div class="nv-tabp" data-filter="ecommerce">E-Commerce</div>
		<div class="nv-tabp" data-filter="saas">SaaS</div>
		<div class="nv-tabp" data-filter="corporate">Corporate</div>
		<div class="nv-tabp" data-filter="branding">Branding</div>
		<div class="nv-tabp" data-filter="creative">Creative</div>
		<div class="nv-tabp" data-filter="erp">ERP</div>
	</div>

	<!-- Masonry gallery -->
	<div class="nv-masonry nv-reveal">
		<?php foreach ( $nv_projects as $p ) : ?>
			<?php $has_image = ! empty( $p['image'] ); ?>
			<div class="nv-portfolio"
			     data-cats="<?php echo esc_attr( $p['category'] ); ?>"
			     data-title="<?php echo esc_attr( $p['title'] ); ?>"
			     data-desc="<?php echo esc_attr( $p['desc'] ); ?>"
			     data-category="<?php echo esc_attr( $p['cat_label'] ); ?>"
			     data-emoji="<?php echo esc_attr( $p['emoji'] ); ?>"
			     data-image="<?php echo esc_attr( $has_image ? $p['image'] : '' ); ?>"
			     data-gradient="<?php echo esc_attr( $p['gradient'] ); ?>"
			     data-tags="<?php echo esc_attr( implode( '|', $p['tags'] ) ); ?>">
				<?php if ( $has_image ) : ?>
					<div class="nv-portfolio-thumb nv-portfolio-thumb-image" style="background-image: url('<?php echo esc_url( $p['image'] ); ?>'); --ar: <?php echo esc_attr( $p['ratio'] ); ?>;"></div>
				<?php else : ?>
					<div class="nv-portfolio-thumb" style="background: <?php echo esc_attr( $p['gradient'] ); ?>; --ar: <?php echo esc_attr( $p['ratio'] ); ?>;">
						<?php echo esc_html( $p['emoji'] ); ?>
					</div>
				<?php endif; ?>
				<div class="nv-portfolio-hover">
					<span>View case</span>
					<span class="nv-arrow">→</span>
				</div>
				<div class="nv-portfolio-info">
					<h3><?php echo esc_html( $p['title'] ); ?></h3>
					<p><?php echo esc_html( wp_trim_words( $p['desc'], 14 ) ); ?></p>
					<div class="nv-tags">
						<?php foreach ( array_slice( $p['tags'], 0, 3 ) as $t ) : ?>
							<span class="nv-tag-pill"><?php echo esc_html( $t ); ?></span>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0">
		<div class="nv-tag" style="margin-bottom:12px">Got a project?</div>
		<h2 class="nv-title" style="margin-bottom:12px">Let's add yours to the gallery.</h2>
		<p style="color:var(--muted2);max-width:520px;margin:0 auto">Tell us what you're trying to ship. Free 30-minute scoping call, no obligation.</p>
		<div style="margin-top:24px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
			<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Start a Project</a>
		</div>
	</div>
</div>

<?php get_footer();
