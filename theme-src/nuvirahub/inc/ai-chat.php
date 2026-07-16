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
	$lines[] = 'ABOUT / FOUNDERS: Nuvirahub was founded by three co-founders — Harsha Walisundara (Engineering Lead, software/apps), Akalanka Navarathne (Logistics Lead, sea/air freight & customs), and Heshan Wijesundara (Commercial Lead, growth/marketing/sales). 50+ projects delivered, 30+ clients, 5 years experience, 98% client satisfaction. If asked about the team or founders, answer briefly using this — do not invent extra detail.';
	$lines[] = '';
	$lines[] = 'PORTFOLIO EXAMPLES (only mention if asked about past work/case studies — pick 2-3 relevant ones, do not list all 8 unless asked for everything): SL Festival (live WordPress event platform), Ceylon Review (Flutter/Supabase mobile app), CarePulse (Jetpack Compose health app), Smart Home HMI (Qt6/QML embedded UI), Growdollar (React Native fintech app), RoomWalk (TypeScript 3D web room planner), NuviraHub Calendar (internal scheduling tool), and Nuvirahub.com itself. Full case studies at nuvirahub.com/portfolio.';
	$lines[] = '';
	$lines[] = 'NUVIRA SPICE CO. — Ceylon spices sold online, shipped internationally (currently to Latvia and other EU destinations), paid via bank transfer with a WhatsApp payment-slip confirmation:';

	// Live product catalogue from WooCommerce — whatever is in the dashboard
	// (Products menu) is what the assistant knows: names, prices, descriptions.
	$wc_listed = false;
	if ( function_exists( 'wc_get_products' ) ) {
		$wc_products = wc_get_products(
			array(
				'status' => 'publish',
				'limit'  => 50,
			)
		);
		foreach ( $wc_products as $wc_p ) {
			$prices = array();
			if ( $wc_p->is_type( 'variable' ) ) {
				foreach ( $wc_p->get_available_variations( 'objects' ) as $var ) {
					$attrs = implode( ' ', $var->get_attributes() );
					$prices[] = trim( $attrs . ' for €' . $var->get_price() );
				}
			} elseif ( '' !== $wc_p->get_price() ) {
				$prices[] = '€' . $wc_p->get_price();
			}
			$short = trim( wp_strip_all_tags( $wc_p->get_short_description() ) );
			$short = $short ? mb_substr( $short, 0, 120 ) : '';
			$lines[] = '- ' . $wc_p->get_name() . ( $short ? ' (' . $short . ')' : '' ) . ': ' . implode( ', ', $prices );
			$wc_listed = true;
		}
	}

	// Fallback to the theme's static catalogue only if WooCommerce is unavailable.
	if ( ! $wc_listed && function_exists( 'nuvirahub_products_raw' ) ) {
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
 * Rebuild the assistant's knowledge as soon as a product is added or edited
 * in the dashboard, instead of waiting out the hourly cache. Variation-level
 * edits (pack-size prices) save without touching the parent post, so hook
 * those too.
 */
function nuvirahub_ai_flush_prompt_cache() {
	delete_transient( 'nuvirahub_ai_system_prompt' );
}
add_action( 'save_post_product', 'nuvirahub_ai_flush_prompt_cache' );
add_action( 'woocommerce_update_product', 'nuvirahub_ai_flush_prompt_cache' );
add_action( 'woocommerce_update_product_variation', 'nuvirahub_ai_flush_prompt_cache' );
add_action( 'woocommerce_save_product_variation', 'nuvirahub_ai_flush_prompt_cache' );

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

	// Basic per-IP rate limits to bound API cost exposure: a tight burst
	// guard for scripted hammering, plus the slower rolling window below.
	$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';

	$burst_key   = 'nv_ai_rl_burst_' . md5( $ip );
	$burst_count = (int) get_transient( $burst_key );
	if ( $burst_count >= 5 ) {
		error_log( '[nuvirahub-ai-chat] burst rate limited: ' . $ip );
		wp_send_json_success(
			array(
				'reply'       => "You're sending messages a bit fast — please continue on WhatsApp and we'll help right away.",
				'wa_link'     => $wa_link,
				'needs_human' => true,
			)
		);
	}
	set_transient( $burst_key, $burst_count + 1, 30 );

	$key = 'nv_ai_rl_' . md5( $ip );
	$count = (int) get_transient( $key );
	if ( $count >= 15 ) {
		error_log( '[nuvirahub-ai-chat] rate limited: ' . $ip );
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
