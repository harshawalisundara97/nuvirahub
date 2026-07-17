<?php
/**
 * Template Name: Nuvirahub Pricing
 *
 * Starting-from estimates per service line. These are indicative ranges,
 * not fixed quotes — every project gets a custom, fixed-price proposal
 * after a free consult (see nv-process on the homepage).
 *
 * @package Nuvirahub
 */

get_header();

$nv_launch   = nuvirahub_get_page_by_title( 'Startup Launchpad' );
$nv_soft     = nuvirahub_get_page_by_title( 'Software & Apps' );
$nv_cons     = nuvirahub_get_page_by_title( 'Growth Consulting' );
$nv_erp      = nuvirahub_get_page_by_title( 'ERP Solutions' );
$nv_creat    = nuvirahub_get_page_by_title( 'Creative & Design' );
$nv_logist   = nuvirahub_get_page_by_title( 'Logistics' );
$nv_contact  = nuvirahub_get_page_by_title( 'Contact' );

$launch_url  = $nv_launch  ? get_permalink( $nv_launch->ID )  : home_url( '/startup-launchpad' );
$soft_url    = $nv_soft    ? get_permalink( $nv_soft->ID )    : home_url( '/software-apps' );
$cons_url    = $nv_cons    ? get_permalink( $nv_cons->ID )    : home_url( '/growth-consulting' );
$erp_url     = $nv_erp     ? get_permalink( $nv_erp->ID )     : home_url( '/erp-solutions' );
$creat_url   = $nv_creat   ? get_permalink( $nv_creat->ID )   : home_url( '/creative-design' );
$logist_url  = $nv_logist  ? get_permalink( $nv_logist->ID )  : home_url( '/logistics' );
$contact_url = $nv_contact ? get_permalink( $nv_contact->ID ) : home_url( '/contact' );

$plans = array(
	array(
		'name'     => 'Startup Launchpad',
		'from'     => '$499',
		'period'   => 'one-time',
		'desc'     => 'Everything to go from idea to registered, banked, and live — in 14 days.',
		'features' => array( 'Business registration & tax IDs', 'Government authority liaison', 'Bank account setup', 'Brand + website + email' ),
		'url'      => $launch_url,
	),
	array(
		'name'     => 'Software & Apps',
		'from'     => '$1,200',
		'period'   => 'per project',
		'desc'     => 'Web platforms, mobile apps, or Windows desktop tools — scoped to your workflow.',
		'features' => array( 'Fixed-price proposal after scoping', 'Weekly progress check-ins', 'Source code ownership', 'Post-launch support window' ),
		'url'      => $soft_url,
	),
	array(
		'name'     => 'Growth Consulting',
		'from'     => '$300',
		'period'   => 'per month',
		'desc'     => 'Strategy, operations, and financial modelling — embedded in your team.',
		'features' => array( 'Monthly strategy sessions', 'Operational process review', 'Financial modelling support', 'No long-term lock-in' ),
		'url'      => $cons_url,
	),
	array(
		'name'     => 'ERP for Enterprise',
		'from'     => '$2,500',
		'period'   => 'one-time',
		'desc'     => 'Finance, HR, inventory, CRM and BI in one connected system.',
		'features' => array( 'Implementation in 8–12 weeks', '3 months free support included', 'Staff training included', 'Data migration from your current system' ),
		'url'      => $erp_url,
	),
	array(
		'name'     => 'Creative & Design',
		'from'     => '$150',
		'period'   => 'per project',
		'desc'     => 'Brand identity, packaging, 3D renders, or AutoCAD drafting.',
		'features' => array( 'Unlimited revision rounds on the brief', 'Source files included', 'Fast turnaround (3–7 days typical)', 'Print-ready or web-ready exports' ),
		'url'      => $creat_url,
	),
	array(
		'name'     => 'Logistics — Sea &amp; Air',
		'from'     => 'Custom quote',
		'period'   => 'per shipment',
		'desc'     => 'Freight pricing depends on weight, route, and cargo type — quoted per shipment.',
		'features' => array( 'FCL/LCL ocean & express air', 'Customs clearance handled', 'Marine insurance available', 'Quote within hours' ),
		'url'      => $logist_url,
	),
);
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Pricing</div>
	<h1>Clear starting points,<br><span>custom fixed quotes</span></h1>
	<p style="font-size:15px;color:var(--muted2);max-width:560px;margin:0 auto">These are indicative starting-from estimates, not final prices. Every engagement gets a free consult and a fixed, written proposal before any work begins — see <a href="#process">how we scope a project</a> below.</p>
</div>

<div class="nv-section nv-reveal">
	<div class="nv-pricing-grid">
		<?php foreach ( $plans as $p ) : ?>
			<div class="nv-pricing-card">
				<h3 class="nv-pricing-name"><?php echo esc_html( $p['name'] ); ?></h3>
				<p class="nv-pricing-desc"><?php echo esc_html( $p['desc'] ); ?></p>
				<div class="nv-pricing-price">
					<span class="nv-pricing-label">Starting from</span>
					<span class="nv-pricing-amount"><?php echo esc_html( $p['from'] ); ?></span>
					<span class="nv-pricing-period"><?php echo esc_html( $p['period'] ); ?></span>
				</div>
				<ul class="nv-pricing-features">
					<?php foreach ( $p['features'] as $f ) : ?>
						<li><?php echo nv_icon( 'check', 14 ); ?><?php echo esc_html( $f ); ?></li>
					<?php endforeach; ?>
				</ul>
				<div class="nv-pricing-actions">
					<a class="nv-btn-ghost" href="<?php echo esc_url( $p['url'] ); ?>">Learn more</a>
					<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Get a Quote</a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="nv-glass" style="margin-top:40px;padding:24px;text-align:center">
		<p style="font-size:13px;color:var(--muted2)">Nuvira Spice Co. products have fixed, published prices — see the <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Shop</a> for exact per-kg pricing.</p>
	</div>

	<div id="process" class="nv-process" style="margin-top:56px">
		<div class="nv-step"><div class="nv-step-num">1</div><div class="nv-step-title">Discover</div><div class="nv-step-desc">A free consult to understand your goals, audience, and constraints.</div></div>
		<div class="nv-step"><div class="nv-step-num">2</div><div class="nv-step-title">Scope</div><div class="nv-step-desc">A clear, fixed proposal — deliverables, timeline, milestones, price.</div></div>
		<div class="nv-step"><div class="nv-step-num">3</div><div class="nv-step-title">Build</div><div class="nv-step-desc">Weekly progress, one project lead, real artefacts you can review.</div></div>
		<div class="nv-step"><div class="nv-step-num">4</div><div class="nv-step-title">Launch &amp; Support</div><div class="nv-step-desc">Go-live, training, and ongoing care — we don't disappear after launch.</div></div>
	</div>
</div>

<?php get_footer();
