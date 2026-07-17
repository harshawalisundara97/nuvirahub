<?php
/**
 * Shared testimonial data — single source of truth used by both the
 * homepage carousel (front-page.php) and the dedicated Testimonials page
 * (template-testimonials.php).
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Real testimonials collected so far. Each entry:
 *  - text          Quote text.
 *  - initials      Two-letter avatar initials.
 *  - avatar_style  Optional inline CSS for the avatar gradient (empty = default).
 *  - name          Author name / company.
 *  - sub           Role / location line.
 *
 * @return array
 */
function nuvirahub_testimonials() {
	return array(
		array(
			'text'         => "Harsha's engineering work has been consistent and dependable. Three years with us, across multiple production systems — fast delivery, clean code, and the willingness to learn whatever the domain needs.",
			'initials'     => 'PC',
			'avatar_style' => '',
			'name'         => 'Pet Care Solution (Pvt) Ltd',
			'sub'          => 'On Harsha — Nuvirahub co-founder',
		),
		array(
			'text'         => 'The Launchpad did exactly what it promised — company registered, tax IDs sorted, brand and website live, all inside two weeks. I only had to show up and sign.',
			'initials'     => 'DK',
			'avatar_style' => 'background:linear-gradient(135deg,var(--accent),var(--accent2))',
			'name'         => 'Dilini K.',
			'sub'          => 'Startup founder — Colombo',
		),
		array(
			'text'         => 'Sea freight quotes in hours, not days. Our first container from Colombo cleared customs without a single surprise charge — they handled every document.',
			'initials'     => 'RF',
			'avatar_style' => 'background:linear-gradient(135deg,var(--accent3),var(--accent))',
			'name'         => 'Ruwan F.',
			'sub'          => 'Importer — Negombo',
		),
		array(
			'text'         => 'They rebuilt our brand from the logo up, and the 3D visualisations sold the project to investors before construction even started.',
			'initials'     => 'SP',
			'avatar_style' => 'background:linear-gradient(135deg,var(--accent2),var(--accent3))',
			'name'         => 'Sanjeewa P.',
			'sub'          => 'Property developer — Kandy',
		),
		array(
			'text'         => 'Ceylon cinnamon arrived in Riga vacuum-sealed, beautifully packed and fresher than anything we can buy locally. Ordering over WhatsApp took two minutes.',
			'initials'     => 'EB',
			'avatar_style' => 'background:linear-gradient(135deg,#f59e0b,#ef4444)',
			'name'         => 'Elīna B.',
			'sub'          => 'Nuvira Spice Co. customer — Latvia',
		),
		array(
			'text'         => 'One ERP for inventory, invoicing and payroll that actually matches how a Sri Lankan SME runs — and support answers on WhatsApp in minutes, not days.',
			'initials'     => 'NM',
			'avatar_style' => 'background:linear-gradient(135deg,#10b981,var(--accent3))',
			'name'         => 'Nuwan M.',
			'sub'          => 'Manufacturing SME — Kandy',
		),
	);
}
