<?php
/**
 * Template Name: Nuvirahub Contact
 *
 * @package Nuvirahub
 */

get_header();
$nv_sent = isset( $_GET['sent'] ) ? sanitize_text_field( wp_unslash( $_GET['sent'] ) ) : '';
$nv_intent = isset( $_GET['intent'] ) ? sanitize_text_field( wp_unslash( $_GET['intent'] ) ) : '';
?>

<div class="nv-page-hero nv-reveal">
	<div class="nv-page-hero-bg"></div>
	<div class="nv-tag">Get in touch</div>
	<h1>Let's build something<br><span>great together</span></h1>
	<p style="font-size:15px;color:var(--muted2);max-width:440px;margin:0 auto">Tell us about your project and we'll get back to you within 24 hours with ideas and a free quote.</p>
</div>

<div class="nv-section">
	<?php if ( 'success' === $nv_sent ) : ?>
		<div class="nv-glass nv-reveal" style="border-color:rgba(56,189,248,.4);margin-bottom:24px;text-align:center">Thanks &mdash; your message has been sent. We'll be in touch within 24 hours.</div>
	<?php elseif ( 'error' === $nv_sent ) : ?>
		<div class="nv-glass nv-reveal" style="border-color:rgba(239,68,68,.4);margin-bottom:24px;text-align:center">Sorry, something went wrong. Please try again or email us directly.</div>
	<?php endif; ?>

	<div class="nv-contact-grid">
		<div class="nv-contact-info nv-reveal">
			<div class="nv-contact-item"><div class="nv-contact-icon">&#128231;</div><div><div style="font-size:13px;font-weight:500;margin-bottom:4px">Email us</div><div style="font-size:13px;color:var(--muted2)"><?php echo esc_html( get_option( 'admin_email' ) ); ?></div></div></div>
			<div class="nv-contact-item"><div class="nv-contact-icon">&#128205;</div><div><div style="font-size:13px;font-weight:500;margin-bottom:4px">Location</div><div style="font-size:13px;color:var(--muted2)">Colombo, Sri Lanka</div></div></div>
			<div class="nv-contact-item"><div class="nv-contact-icon">&#9200;</div><div><div style="font-size:13px;font-weight:500;margin-bottom:4px">Working hours</div><div style="font-size:13px;color:var(--muted2)">Mon&ndash;Fri, 9am&ndash;6pm IST</div></div></div>
			<div class="nv-contact-item"><div class="nv-contact-icon">&#128172;</div><div><div style="font-size:13px;font-weight:500;margin-bottom:4px">Response time</div><div style="font-size:13px;color:var(--muted2)">Within 24 hours guaranteed</div></div></div>
			<div class="nv-glass" style="margin-top:8px">
				<h4 style="font-family:'Syne',sans-serif;font-size:14px;font-weight:600;margin-bottom:14px">Follow us</h4>
				<div class="nv-social">
					<a class="nv-social-btn" href="#">&#120143;</a>
					<a class="nv-social-btn" href="#">in</a>
					<a class="nv-social-btn" href="#">f</a>
					<a class="nv-social-btn" href="#">&#9654;</a>
				</div>
			</div>
		</div>
		<div class="nv-form nv-reveal">
			<h3 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:700;margin-bottom:24px">Send us a message</h3>
			<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="nuvirahub_contact">
				<?php wp_nonce_field( 'nuvirahub_contact', 'nuvirahub_contact_nonce' ); ?>
				<div class="nv-form-row">
					<div class="nv-form-group"><label>First name</label><input type="text" name="nv_first" placeholder="John" required></div>
					<div class="nv-form-group"><label>Last name</label><input type="text" name="nv_last" placeholder="Doe"></div>
				</div>
				<div class="nv-form-group"><label>Email address</label><input type="email" name="nv_email" placeholder="john@company.com" required></div>
				<div class="nv-form-group"><label>Project type</label>
					<select name="nv_type">
						<option<?php echo ( 'call' !== $nv_intent ) ? ' selected' : ''; ?>>Website Design</option>
						<option<?php echo ( 'call' === $nv_intent ) ? ' selected' : ''; ?>>Free Consultation Call</option>
						<option>E-Commerce</option><option>Brand Identity</option><option>SEO Package</option><option>Ongoing Support</option><option>Other</option>
					</select>
				</div>
				<div class="nv-form-group"><label>Budget range</label>
					<select name="nv_budget"><option>Under $500</option><option>$500 &ndash; $1,000</option><option>$1,000 &ndash; $2,500</option><option>$2,500+</option></select>
				</div>
				<div class="nv-form-group"><label>Tell us about your project</label><textarea name="nv_message" placeholder="Describe what you're looking to build, your goals, timeline, and any other details..." required></textarea></div>
				<button class="nv-btn-primary" style="width:100%;padding:14px;font-size:15px" type="submit">Send Message &#10022;</button>
			</form>
		</div>
	</div>
</div>

<?php
get_footer();
