<?php
/**
 * Product reviews (E5) — sample/placeholder review data.
 *
 * Keyed by product slug. Each review:
 *   - author    (string)   display name
 *   - location  (string)   "City, Country" — optional
 *   - rating    (int 1..5)
 *   - date      (YYYY-MM-DD)
 *   - verified  (bool)     show "Verified buyer" pill when true
 *   - title     (string)   short headline — optional
 *   - text      (string)   review body
 *
 * IMPORTANT: these are placeholder examples for demonstration. Replace
 * with real reviews collected from customers (e.g. via the WhatsApp CTA
 * on the product page) before going live. In Phase 2 (WooCommerce) these
 * move to the WP comments table tied to verified orders.
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nuvirahub_seed_reviews() {
	return apply_filters( 'nuvirahub_seed_reviews', array(

		'ceylon-cinnamon' => array(
			array(
				'author'   => 'Anna L.',
				'location' => 'Riga, Latvia',
				'rating'   => 5,
				'date'     => '2026-04-15',
				'verified' => true,
				'title'    => 'Like nothing in Latvian shops',
				'text'     => 'You can smell the difference the moment you open the pouch. So much softer and sweeter than the cassia we usually get here. Already planning my next order.',
			),
			array(
				'author'   => 'Māris O.',
				'location' => 'Daugavpils',
				'rating'   => 5,
				'date'     => '2026-03-22',
				'verified' => true,
				'title'    => 'Worth the wait',
				'text'     => 'Took about a week to Daugavpils, packaging was perfect. Used it in our bakery — the kids actually noticed the change in our cinnamon buns.',
			),
			array(
				'author'   => 'Linda V.',
				'location' => 'Jūrmala',
				'rating'   => 4,
				'date'     => '2026-02-18',
				'verified' => true,
				'text'     => 'Lovely quality. Only ordered 100g first time to try — should have gone for 500g. Will next time.',
			),
		),

		'black-pepper' => array(
			array(
				'author'   => 'Jānis B.',
				'location' => 'Riga',
				'rating'   => 5,
				'date'     => '2026-04-02',
				'verified' => true,
				'title'    => 'Real pepper',
				'text'     => 'Grind it fresh — completely different from the dusty stuff in the supermarket. Citrus notes are real.',
			),
			array(
				'author'   => 'Kristīne S.',
				'location' => 'Liepāja',
				'rating'   => 5,
				'date'     => '2026-03-10',
				'verified' => true,
				'text'     => 'Bought the 500g for our restaurant. Customers commented on the seasoning the same week.',
			),
		),

		'cardamom' => array(
			array(
				'author'   => 'Pēteris K.',
				'location' => 'Jelgava',
				'rating'   => 5,
				'date'     => '2026-04-20',
				'verified' => true,
				'title'    => 'Perfect for piparkūkas',
				'text'     => 'Crushed fresh, the aroma fills the kitchen. Used in Christmas cookies and chai. Will reorder.',
			),
		),

		'turmeric' => array(
			array(
				'author'   => 'Inese R.',
				'location' => 'Cēsis',
				'rating'   => 5,
				'date'     => '2026-04-08',
				'verified' => true,
				'title'    => 'Beautiful colour',
				'text'     => 'Such a vibrant gold compared to what I had before. Take a small spoon daily with warm milk.',
			),
		),

	) );
}
