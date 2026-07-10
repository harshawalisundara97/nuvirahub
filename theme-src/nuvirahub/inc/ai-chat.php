<?php
/**
 * AI support chat widget — Anthropic Claude powered.
 * Answers visitor questions from the site's own content; hands off to
 * WhatsApp for anything outside that scope (quotes, orders, custom asks).
 *
 * @package Nuvirahub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'NUVIRAHUB_ANTHROPIC_API_KEY' ) ) {
	// Paste a real key from console.anthropic.com to activate the chat.
	// Left empty, the widget still renders but replies with a WhatsApp handoff.
	define( 'NUVIRAHUB_ANTHROPIC_API_KEY', '' );
}

/**
 * Build the system prompt from the theme's own content — services, spice
 * catalogue, shipping/legal pages. Cached for an hour since it rarely changes.
 *
 * @return string
 */
function nuvirahub_ai_system_prompt() {
	$cached = get_transient( 'nuvirahub_ai_system_prompt' );
	if ( false !== $cached ) {
		return $cached;
	}

	$lines = array();
	$lines[] = 'You are the support assistant on the Nuvirahub website (nuvirahub.com), a Sri Lankan multi-service company.';
	$lines[] = 'Answer only using the information below. Be concise, professional, and specific. Use EUR (€) for spice prices.';
	$lines[] = '';
	$lines[] = 'TONE AND FORMATTING RULES (important):';
	$lines[] = '- Keep replies SHORT — 2 to 4 sentences maximum. This is a small chat bubble, not a document.';
	$lines[] = '- If asked for the full list of services, name all 8 in ONE short line separated by commas — no descriptions, no per-item explanation. Only describe a specific service in detail if the visitor asks about that one service by name.';
	$lines[] = '- Do NOT use markdown formatting (no **bold**, no numbered headers, no emoji). Plain sentences and simple "- " bullet points only.';
	$lines[] = '- Professional and warm tone. No emojis, no exclamation-mark overuse.';
	$lines[] = '- If the visitor writes in Sinhala, reply entirely in clear, correct Sinhala (native script only — never mix in other languages or scripts). If they write in English, reply in English. Match whatever language they use, consistently, without mixing languages within one reply.';
	$lines[] = '- Always finish your thought within the length limit — never start a list or sentence you cannot finish briefly.';
	$lines[] = '';
	$lines[] = 'COMPANY: Nuvirahub (Pvt) Ltd. Address: 27/2E Pieris Avenue, Kalubowila, Dehiwala, Sri Lanka 10350. Phone/WhatsApp: +94 71 672 2599. Email: nuvirahub@gmail.com.';
	$lines[] = '';
	$lines[] = 'SERVICES (8 pillars):';
	$lines[] = '1. Software & Apps — web platforms, mobile apps (native & cross-platform), custom Windows desktop tools.';
	$lines[] = '2. Startup Launchpad — business registration, tax IDs, documents, government liaison, banking, brand & website, live in 14 days.';
	$lines[] = '3. Growth Consulting — strategy, operations, financial modelling, embedded team support.';
	$lines[] = '4. Logistics (Sea & Air) — FCL/LCL ocean freight, express air cargo, customs clearance, marine insurance, last-mile delivery.';
	$lines[] = '5. Creative & Design — graphic design, 3D product/interior renders, AutoCAD architectural drafting & house plans.';
	$lines[] = '6. Brand & Marketing — brand identity, social media management, paid campaigns, SEO & content strategy.';
	$lines[] = '7. ERP for Enterprise — one connected system for finance, HR/payroll, inventory, CRM, production, BI. 8-12 week implementation.';
	$lines[] = '8. Construction & Architecture — house design, MEP drawings, BIM modelling, project planning, end-to-end construction.';
	$lines[] = '';
	$lines[] = 'NUVIRA SPICE CO. — Ceylon spices sold online, shipped internationally (currently to Latvia and other EU destinations), paid via bank transfer with a WhatsApp payment-slip confirmation:';

	if ( function_exists( 'nuvirahub_products_raw' ) ) {
		foreach ( nuvirahub_products_raw() as $p ) {
			$prices = array();
			if ( ! empty( $p['options'] ) && is_array( $p['options'] ) ) {
				foreach ( $p['options'] as $opt ) {
					$prices[] = $opt['weight'] . ' for €' . $opt['price'];
				}
			}
			$lines[] = '- ' . $p['name'] . ' (' . ( $p['tagline'] ?? '' ) . '): ' . implode( ', ', $prices );
		}
	}

	$lines[] = '';
	$lines[] = 'SHIPPING: Tracked delivery, typically 5-8 business days to Latvia. EU duties & VAT included in price.';
	$lines[] = 'PAYMENT: Bank transfer (details shown at checkout), confirmed by sending the payment slip on WhatsApp.';
	$lines[] = '';
	$lines[] = 'WHEN YOU CANNOT HELP: If the visitor asks for a custom quote, bulk/wholesale pricing, order status, or anything not covered above, do NOT guess — tell them to continue on WhatsApp at +94 71 672 2599 (or the floating WhatsApp button on the site) and a team member will help directly.';

	$prompt = implode( "\n", $lines );
	set_transient( 'nuvirahub_ai_system_prompt', $prompt, HOUR_IN_SECONDS );

	return $prompt;
}

/**
 * AJAX handler — receives a visitor message + short history, calls Claude,
 * returns a JSON reply. Falls back to a WhatsApp handoff if no API key is
 * configured, or if the upstream call fails.
 */
function nuvirahub_handle_ai_chat() {
	if ( ! isset( $_POST['nuvirahub_ai_chat_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nuvirahub_ai_chat_nonce'] ) ), 'nuvirahub_ai_chat' ) ) {
		wp_send_json_error( array( 'message' => 'Invalid request.' ), 403 );
	}

	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	if ( '' === trim( $message ) ) {
		wp_send_json_error( array( 'message' => 'Empty message.' ), 400 );
	}

	$history_raw = isset( $_POST['history'] ) ? wp_unslash( $_POST['history'] ) : '[]';
	$history     = json_decode( $history_raw, true );
	if ( ! is_array( $history ) ) {
		$history = array();
	}
	// Cap to the last 6 turns sent from the client; re-sanitize every value.
	$history = array_slice( $history, -6 );
	$clean_history = array();
	foreach ( $history as $turn ) {
		if ( empty( $turn['role'] ) || empty( $turn['content'] ) ) {
			continue;
		}
		$role = 'user' === $turn['role'] ? 'user' : 'assistant';
		$clean_history[] = array(
			'role'    => $role,
			'content' => sanitize_textarea_field( $turn['content'] ),
		);
	}

	$wa_link = nuvirahub_wa_link( "Hi Nuvirahub! I have a question the chat assistant couldn't answer:\n\n" . $message );

	if ( '' === NUVIRAHUB_ANTHROPIC_API_KEY ) {
		wp_send_json_success(
			array(
				'reply'       => "I'm not fully set up yet to answer that — but our team is quick to reply on WhatsApp.",
				'wa_link'     => $wa_link,
				'needs_human' => true,
			)
		);
	}

	// Basic per-IP rate limit to bound API cost exposure.
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	$key = 'nv_ai_rl_' . md5( $ip );
	$count = (int) get_transient( $key );
	if ( $count >= 15 ) {
		wp_send_json_success(
			array(
				'reply'       => "You've reached the chat limit for now — please continue on WhatsApp and we'll help right away.",
				'wa_link'     => $wa_link,
				'needs_human' => true,
			)
		);
	}
	set_transient( $key, $count + 1, 10 * MINUTE_IN_SECONDS );

	$messages   = $clean_history;
	$messages[] = array( 'role' => 'user', 'content' => $message );

	$response = wp_remote_post(
		'https://api.anthropic.com/v1/messages',
		array(
			'timeout' => 20,
			'headers' => array(
				'content-type'      => 'application/json',
				'x-api-key'         => NUVIRAHUB_ANTHROPIC_API_KEY,
				'anthropic-version' => '2023-06-01',
			),
			'body'    => wp_json_encode(
				array(
					'model'      => 'claude-haiku-4-5-20251001',
					'max_tokens' => 300,
					'system'     => nuvirahub_ai_system_prompt(),
					'messages'   => $messages,
				)
			),
		)
	);

	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		wp_send_json_success(
			array(
				'reply'       => 'Sorry, the chat is having trouble right now — please reach us on WhatsApp instead.',
				'wa_link'     => $wa_link,
				'needs_human' => true,
			)
		);
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	$text = '';
	if ( ! empty( $body['content'] ) && is_array( $body['content'] ) ) {
		foreach ( $body['content'] as $block ) {
			if ( isset( $block['type'] ) && 'text' === $block['type'] ) {
				$text .= $block['text'];
			}
		}
	}

	if ( '' === trim( $text ) ) {
		wp_send_json_success(
			array(
				'reply'       => 'Sorry, I couldn\'t come up with an answer — please reach us on WhatsApp instead.',
				'wa_link'     => $wa_link,
				'needs_human' => true,
			)
		);
	}

	wp_send_json_success(
		array(
			'reply'       => $text,
			'wa_link'     => $wa_link,
			'needs_human' => false,
		)
	);
}
add_action( 'admin_post_nopriv_nuvirahub_ai_chat', 'nuvirahub_handle_ai_chat' );
add_action( 'admin_post_nuvirahub_ai_chat', 'nuvirahub_handle_ai_chat' );
