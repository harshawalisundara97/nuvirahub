<?php
/**
 * Template Name: Nuvirahub Construction & Architecture
 *
 * @package Nuvirahub
 */

get_header();
$contact     = nuvirahub_get_page_by_title( 'Contact' );
$contact_url = $contact ? get_permalink( $contact->ID ) : home_url( '/contact' );
$img         = get_template_directory_uri() . '/assets/img/projects';

$services = array(
	array( 'House Design', 'Custom architectural house plans tailored to your land, lifestyle and budget.' ),
	array( 'Interior Design', 'Functional, beautiful interiors — layouts, finishes, lighting and furniture.' ),
	array( 'Exterior Design', 'Facades, elevations and landscaping that give your home real street presence.' ),
	array( 'Electrical &amp; Plumbing Drawings', 'Detailed MEP drawings for safe, code-compliant house wiring and plumbing.' ),
	array( 'Project Planning', 'Clear timelines, phases and budgets so your build runs without surprises.' ),
	array( 'Material List', 'Itemised BOQ and material schedules so you know exactly what to buy.' ),
	array( 'Site Visit', 'On-site inspection and supervision to keep quality and progress on track.' ),
	array( 'BIM Modeling', 'Accurate 3D BIM models for coordination, clash detection and visualisation.' ),
	array( 'Construction', 'End-to-end building — from foundation to handover, managed by our team.' ),
	array( 'Property Sale', 'Completed, ready-to-move homes and properties available for sale.' ),
);

$projects = array(
	array( '01.jpg', 'Modern Tropical Villa', 'Two-storey residence with timber detailing and a wrap-around veranda.', array( 'House Design', 'Exterior', '3D Render' ) ),
	array( '02.jpg', 'Contemporary Urban Home', 'Clean grey facade with brick boundary wall and modern steel gate.', array( 'Architecture', 'Exterior', 'Construction' ) ),
	array( '03.jpg', 'Luxury Modern Residence', 'Dark-toned modern villa with stone cladding and landscaped frontage.', array( 'House Design', 'Exterior', 'BIM' ) ),
	array( '04.jpg', 'Loft Bedroom Interior', 'Warm mezzanine bedroom with statement ring lighting and timber floors.', array( 'Interior', '3D Render', 'Lighting' ) ),
	array( '05.jpg', 'Suburban Family Home', 'Twin-gable two-storey home with car porch and paved driveway.', array( 'House Design', 'Construction', 'Exterior' ) ),
	array( '06.jpg', 'A-Frame Glass House', 'Striking A-frame with a full-height glass gable and stone-clad base.', array( 'House Design', 'Exterior', '3D Render' ) ),
	array( '07.jpg', 'Twin Bedroom Suite', 'Warm twin bedroom with timber slat feature wall and soft cove lighting.', array( 'Interior', 'Lighting', '3D Render' ) ),
	array( '08.jpg', 'Stone Facade Detail', 'Natural stone cladding with a cantilevered balcony and clerestory glazing.', array( 'Exterior', 'Architecture', 'Detail' ) ),
	array( '09.jpg', 'Hillside Family Residence', 'Multi-level stone and timber home with wrap-around balconies.', array( 'House Design', 'Construction', 'BIM' ) ),
);
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Construction &amp; Architecture</div>
	<h1>We design<br><span>and we build.</span></h1>
	<p class="nv-sub" style="margin:0 auto;text-align:center">From the first sketch to the finished house — design, drawings, planning and construction, all under one roof.</p>
	<div style="margin-top:28px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:1">
		<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Start Your Project</a>
		<a class="nv-btn-ghost" href="#work">See Our Work</a>
	</div>
</div>

<!-- SERVICES -->
<div class="nv-section nv-reveal">
	<div class="nv-tag">What we offer</div>
	<h2 class="nv-title">Everything your build needs — <span>end to end.</span></h2>
	<div class="nv-pillars" style="margin-top:48px">
		<?php foreach ( $services as $i => $s ) : ?>
			<div class="nv-pillar">
				<div class="nv-pillar-num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></div>
				<h3><?php echo wp_kses_post( $s[0] ); ?></h3>
				<p><?php echo wp_kses_post( $s[1] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<!-- PORTFOLIO GALLERY -->
<div class="nv-section nv-reveal" id="work">
	<div class="nv-tag">Our work</div>
	<h2 class="nv-title">Projects we're <span>proud of.</span></h2>
	<div class="nv-gallery" style="margin-top:40px">
		<?php foreach ( $projects as $p ) : ?>
			<div class="nv-portfolio">
				<div class="nv-portfolio-thumb">
					<img src="<?php echo esc_url( $img . '/' . $p[0] ); ?>" alt="<?php echo esc_attr( $p[1] ); ?>" loading="lazy">
				</div>
				<div class="nv-portfolio-info">
					<h3 style="font-family:'Syne',sans-serif;font-size:17px;font-weight:600;margin-bottom:6px"><?php echo esc_html( $p[1] ); ?></h3>
					<p style="font-size:13px;color:var(--muted2)"><?php echo esc_html( $p[2] ); ?></p>
					<div class="nv-tags">
						<?php foreach ( $p[3] as $tag ) : ?>
							<span class="nv-tag-pill"><?php echo esc_html( $tag ); ?></span>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<!-- CTA -->
<div class="nv-section nv-reveal">
	<div class="nv-newsletter" style="margin:0">
		<div class="nv-tag" style="margin-bottom:12px">Free consultation</div>
		<h2 class="nv-title" style="margin-bottom:12px">Have a plot of land?<br>Let's design your home.</h2>
		<p style="color:var(--muted2);max-width:520px;margin:0 auto">Tell us about your land and what you have in mind. We'll come back with a concept and a clear plan.</p>
		<div style="margin-top:24px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
			<a class="nv-btn-primary" href="<?php echo esc_url( $contact_url ); ?>">Book a Consultation</a>
		</div>
	</div>
</div>

<?php get_footer();
