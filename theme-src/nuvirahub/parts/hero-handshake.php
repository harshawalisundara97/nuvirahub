<?php
/**
 * Hero handshake — animated "human + digital" partnership visual.
 * Pure inline SVG; all motion via CSS in style.css (section 35).
 *
 * @package Nuvirahub
 */
?>
<svg class="nv-handshake" viewBox="0 0 560 470" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="A digital circuit hand shaking a human hand">
	<defs>
		<linearGradient id="nvhs-circuit" x1="0" y1="1" x2="1" y2="0">
			<stop offset="0%" stop-color="#38bdf8"/>
			<stop offset="55%" stop-color="#6c63ff"/>
			<stop offset="100%" stop-color="#a78bfa"/>
		</linearGradient>
		<linearGradient id="nvhs-suit" x1="1" y1="1" x2="0" y2="0">
			<stop offset="0%" stop-color="#0a0f1e"/>
			<stop offset="60%" stop-color="#1b2138"/>
			<stop offset="100%" stop-color="#2a3252"/>
		</linearGradient>
		<radialGradient id="nvhs-glow" cx="50%" cy="50%" r="50%">
			<stop offset="0%" stop-color="#6c63ff" stop-opacity=".55"/>
			<stop offset="45%" stop-color="#38bdf8" stop-opacity=".22"/>
			<stop offset="100%" stop-color="#38bdf8" stop-opacity="0"/>
		</radialGradient>
		<filter id="nvhs-soft" x="-60%" y="-60%" width="220%" height="220%">
			<feGaussianBlur stdDeviation="7"/>
		</filter>
	</defs>

	<!-- soft glow behind the clasp -->
	<ellipse class="nvhs-glow" cx="282" cy="250" rx="180" ry="150" fill="url(#nvhs-glow)"/>

	<!-- ============ RIGHT: human / business hand (drawn behind) ============ -->
	<g class="nvhs-arm-right">
		<!-- forearm + fist -->
		<path d="M520 452 L322 256" stroke="url(#nvhs-suit)" stroke-width="50" stroke-linecap="round" fill="none"/>
		<circle cx="320" cy="252" r="34" fill="url(#nvhs-suit)"/>
		<!-- shirt cuff -->
		<path d="M455 392 L405 340" stroke="#e8ecf8" stroke-width="56" stroke-linecap="round" opacity=".9"/>
		<path d="M455 392 L405 340" stroke="url(#nvhs-suit)" stroke-width="56" stroke-linecap="round" opacity="0"/>
		<line class="nvhs-cuff-line" x1="470" y1="378" x2="420" y2="326" stroke="#aeb6cf" stroke-width="2" opacity=".6"/>
		<!-- forearm sleeve back over the cuff -->
		<path d="M520 452 L470 400" stroke="url(#nvhs-suit)" stroke-width="52" stroke-linecap="round" fill="none"/>
	</g>

	<!-- ============ LEFT: digital / circuit hand (drawn in front) ============ -->
	<g class="nvhs-arm-left">
		<!-- forearm + fist -->
		<path d="M40 452 L240 256" stroke="url(#nvhs-circuit)" stroke-width="46" stroke-linecap="round" fill="none" opacity=".92"/>
		<circle cx="242" cy="252" r="31" fill="url(#nvhs-circuit)" opacity=".95"/>
		<!-- chip on the forearm -->
		<g class="nvhs-chip" transform="translate(132 360) rotate(-44)">
			<rect x="-15" y="-15" width="30" height="30" rx="5" fill="#05080f" stroke="#38bdf8" stroke-width="2"/>
			<rect x="-7" y="-7" width="14" height="14" rx="2" fill="#6c63ff" opacity=".8"/>
			<line x1="-15" y1="-6" x2="-22" y2="-6" stroke="#38bdf8" stroke-width="2"/>
			<line x1="-15" y1="6"  x2="-22" y2="6"  stroke="#38bdf8" stroke-width="2"/>
			<line x1="15" y1="-6" x2="22" y2="-6" stroke="#38bdf8" stroke-width="2"/>
			<line x1="15" y1="6"  x2="22" y2="6"  stroke="#38bdf8" stroke-width="2"/>
		</g>
		<!-- circuit traces flowing up the forearm -->
		<g fill="none" stroke="#bfe6ff" stroke-width="2" opacity=".85">
			<path class="nvhs-trace" d="M70 438 L150 360 L150 330 L210 272"/>
			<path class="nvhs-trace nvhs-trace2" d="M92 452 L196 348 L232 348 L256 270"/>
			<path class="nvhs-trace nvhs-trace3" d="M58 416 L120 354 L120 320"/>
		</g>
		<g fill="#7ee3ff">
			<circle class="nvhs-node" cx="150" cy="330" r="3.5"/>
			<circle class="nvhs-node nvhs-node2" cx="210" cy="272" r="3.5"/>
			<circle class="nvhs-node nvhs-node3" cx="232" cy="348" r="3.5"/>
			<circle class="nvhs-node" cx="120" cy="320" r="3"/>
		</g>
	</g>

	<!-- ============ CLASP: fingers wrapping over the joint (shakes) ============ -->
	<g class="nvhs-clasp">
		<!-- right hand fingers wrapping onto the left fist -->
		<g stroke-linecap="round" fill="none">
			<path d="M300 232 q-26 -16 -52 -6" stroke="url(#nvhs-suit)" stroke-width="13"/>
			<path d="M306 244 q-30 -14 -58 -2" stroke="url(#nvhs-suit)" stroke-width="13"/>
			<path d="M310 257 q-30 -10 -60 2"  stroke="url(#nvhs-suit)" stroke-width="13"/>
			<path d="M312 270 q-28 -6 -56 8"   stroke="url(#nvhs-suit)" stroke-width="13"/>
		</g>
		<!-- left (digital) thumb over the top -->
		<path d="M236 236 q20 -18 44 -10" stroke="url(#nvhs-circuit)" stroke-width="15" stroke-linecap="round" fill="none" opacity=".95"/>
		<!-- connection chip + glow at the meeting point -->
		<circle class="nvhs-spark-glow" cx="281" cy="250" r="34" fill="url(#nvhs-glow)"/>
		<g transform="translate(281 250)">
			<g class="nvhs-spark">
				<polygon points="0,-13 11,-6.5 11,6.5 0,13 -11,6.5 -11,-6.5" fill="#05080f" stroke="#7ee3ff" stroke-width="2"/>
				<circle r="4.5" fill="#a78bfa"/>
			</g>
		</g>
		<!-- data dots travelling along the link -->
		<circle class="nvhs-data" cx="281" cy="250" r="3" fill="#7ee3ff"/>
		<circle class="nvhs-data nvhs-data2" cx="281" cy="250" r="3" fill="#a78bfa"/>
	</g>
</svg>
