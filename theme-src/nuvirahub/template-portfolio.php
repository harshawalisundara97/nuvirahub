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
 * Each project: title, desc, category (slug), emoji, gradient, ratio, tags,
 * link + link_label (shown as a button in the lightbox popup). */
$nv_projects = array(
	array(
		'title'      => 'SL Festival — Sri Lankan Cultural Events Platform',
		'desc'       => 'A discovery + booking platform for Sri Lankan cultural events, festivals and pop-ups. Built by Nuvirahub end-to-end — design, WordPress backend, custom event listings, location search, and admin dashboard. Live at slfestival.lk.',
		'category'   => 'web',
		'cat_label'  => 'Live Project',
		'emoji'      => '',
		'image'      => get_template_directory_uri() . '/assets/img/portfolio/slfestival.png?v=' . filemtime( get_template_directory() . '/assets/img/portfolio/slfestival.png' ),
		'gradient'   => 'linear-gradient(135deg, rgba(108,99,255,.3), rgba(56,189,248,.2))',
		'ratio'      => '16/10',
		'tags'       => array( 'WordPress', 'Event Listings', 'Custom Theme', 'Live' ),
		'link'       => 'https://slfestival.lk',
		'link_label' => 'Visit slfestival.lk',
	),
	array(
		'title'      => 'Ceylon Review — Places Review App',
		'desc'       => 'Sri Lanka\'s all-in-one places review app — discover, rate and review restaurants, hotels, beaches, waterfalls, temples and shops across the island. Flutter + Material 3 with a Supabase backend (auth, PostgreSQL, row-level security), an interactive island map with category-coloured pins, and full light/dark theming.',
		'category'   => 'app',
		'cat_label'  => 'Mobile App',
		'emoji'      => '🌴',
		'gradient'   => 'linear-gradient(135deg, rgba(16,185,129,.35), rgba(56,189,248,.25))',
		'ratio'      => '3/4',
		'tags'       => array( 'Flutter', 'Supabase', 'Maps', 'Mobile App' ),
		'link'       => 'https://github.com/harshawalisundara97/ceylonreview.lk',
		'link_label' => 'View on GitHub',
	),
	array(
		'title'      => 'CarePulse — Caregiver Booking App',
		'desc'       => 'A warm, professional healthcare app for Android — families find and book verified caregivers, monitor an admitted parent\'s daily "pulse" (vitals, meals, mood) remotely, and caregivers hand over shifts with structured summary reports. Built with Jetpack Compose + MVVM and an accessible pastel design system.',
		'category'   => 'app',
		'cat_label'  => 'Mobile App',
		'emoji'      => '🩺',
		'gradient'   => 'linear-gradient(135deg, rgba(168,230,207,.45), rgba(222,210,249,.35))',
		'ratio'      => '4/3',
		'tags'       => array( 'Android', 'Jetpack Compose', 'Healthcare' ),
		'link'       => 'https://github.com/harshawalisundara97/CarePulse',
		'link_label' => 'View on GitHub',
	),
	array(
		'title'      => 'Smart Home HMI — Qt Touchscreen Interface',
		'desc'       => 'A 1280×800 touchscreen interface for a smart home system — dashboard, lighting, climate, security, energy and scenes across six screens. Dark industrial-modern aesthetic with teal accents, built with Qt 6, QML and C++ backend controllers.',
		'category'   => 'embedded',
		'cat_label'  => 'Embedded / HMI',
		'emoji'      => '🏠',
		'gradient'   => 'linear-gradient(135deg, rgba(20,184,166,.35), rgba(15,23,42,.5))',
		'ratio'      => '16/10',
		'tags'       => array( 'Qt 6', 'QML', 'C++', 'HMI' ),
		'link'       => 'https://github.com/harshawalisundara97/smart-home-hmi-qt',
		'link_label' => 'View on GitHub',
	),
	array(
		'title'      => 'Growdollar — Virtual Plant Growing App',
		'desc'       => 'Buy a virtual plant for $1 and watch it grow through 11 stages in real time — with photo journals, GPS planting locations, gamified care metrics and live carbon-offset calculations. React Native with animated SVG plant visualisations.',
		'category'   => 'app',
		'cat_label'  => 'Mobile App',
		'emoji'      => '🌱',
		'gradient'   => 'linear-gradient(135deg, rgba(34,197,94,.35), rgba(245,158,11,.25))',
		'ratio'      => '1/1',
		'tags'       => array( 'React Native', 'Gamification', 'Geo' ),
		'link'       => 'https://github.com/harshawalisundara97/Growdollar',
		'link_label' => 'View on GitHub',
	),
	array(
		'title'      => 'RoomWalk — 3D Apartment Walkthroughs',
		'desc'       => 'Apartment-search web MVP with an interactive 3D walkthrough — browse listings, open a unit and walk through the rooms right in the browser. TypeScript front end with a custom 3D viewer component.',
		'category'   => 'web',
		'cat_label'  => 'Web / 3D',
		'emoji'      => '🥽',
		'gradient'   => 'linear-gradient(135deg, rgba(99,102,241,.35), rgba(236,72,153,.25))',
		'ratio'      => '4/3',
		'tags'       => array( 'TypeScript', '3D Walkthrough', 'Real Estate' ),
		'link'       => 'https://github.com/harshawalisundara97/VR-project',
		'link_label' => 'View on GitHub',
	),
	array(
		'title'      => 'NuviraHub Calendar — Event Ticketing Design System',
		'desc'       => 'Design system for a luxury event-ticketing platform — obsidian, gold and ivory with serif headlines and theatrical restraint. Full token set shipped as CSS custom properties + React Native mirrors, with high-fidelity web and mobile UI kits.',
		'category'   => 'design',
		'cat_label'  => 'Design System',
		'emoji'      => '🎟️',
		'gradient'   => 'linear-gradient(135deg, rgba(217,164,6,.35), rgba(24,24,27,.6))',
		'ratio'      => '3/4',
		'tags'       => array( 'Design System', 'UI Kit', 'Design Tokens' ),
		'link'       => 'https://github.com/harshawalisundara97/nuvirahub-calender',
		'link_label' => 'View on GitHub',
	),
	array(
		'title'      => 'Nuvirahub.com — This Website',
		'desc'       => 'Our own home on the web — a dark glassmorphism WordPress theme built from scratch with no page builder and no build step. 13 pages, 7 service pillars, a spice shop with WhatsApp ordering, swipe carousels and 10 custom animation features in pure CSS + vanilla JS.',
		'category'   => 'web',
		'cat_label'  => 'Web Platform',
		'emoji'      => '🚀',
		'gradient'   => 'linear-gradient(135deg, rgba(108,99,255,.4), rgba(56,189,248,.3))',
		'ratio'      => '1/1',
		'tags'       => array( 'WordPress', 'PHP', 'Custom Theme' ),
		'link'       => 'https://nuvirahub.com',
		'link_label' => 'You\'re on it — visit nuvirahub.com',
	),
);
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Selected work</div>
	<h1>Projects we're <span>proud of</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">Real work we've shipped — web platforms, mobile apps, embedded interfaces and design systems. Click any tile to learn more.</p>
</div>

<div class="nv-section">
	<!-- Filter tabs -->
	<div class="nv-tabs nv-reveal" role="tablist" style="margin:0 auto 32px;justify-self:center">
		<div class="nv-tabp active" data-filter="all">All</div>
		<div class="nv-tabp" data-filter="web">Web</div>
		<div class="nv-tabp" data-filter="app">Mobile Apps</div>
		<div class="nv-tabp" data-filter="embedded">Embedded / HMI</div>
		<div class="nv-tabp" data-filter="design">Design Systems</div>
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
			     data-tags="<?php echo esc_attr( implode( '|', $p['tags'] ) ); ?>"
			     data-link="<?php echo esc_attr( $p['link'] ?? '' ); ?>"
			     data-link-label="<?php echo esc_attr( $p['link_label'] ?? 'Visit project' ); ?>">
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
