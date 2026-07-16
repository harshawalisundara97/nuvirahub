# CLAUDE.md — Nuvirahub project memory

Read this first. It tells you what the project is, where things live, and how to do common tasks without re-discovering them.

## What this is
- WordPress 6.x **theme** for **Nuvirahub (Pvt) Ltd** — Sri Lankan multi-service company (3 co-founders: Harsha Walisundara, Akalanka Navarathne, Heshan Wijesundara)
- Address: 27/2E Pieris Avenue, Kalubowila, Dehiwala, Sri Lanka 10350 · Phone: +94 71 672 2599 · Email: nuvirahub@gmail.com
- Live domain: **https://nuvirahub.com** (Namecheap cPanel hosted)
- 7 service pillars: Software & Apps · Startup Launchpad · Growth Consulting · Logistics (Sea & Air) · Creative (Graphic + 3D + AutoCAD) · Brand & Marketing · Enterprise ERP
- Plus **Nuvira Spice Co.** — physical Ceylon spices sold to Latvia, ordered via WhatsApp deep-link

## Tech stack
- **PHP 8.x WordPress theme** — no build step, no node, no bundler
- Pure CSS (`style.css` ~2k lines), one vanilla JS file (`assets/main.js`)
- Fonts: **Syne** (display) + **DM Sans** (body) loaded from Google Fonts CDN
- Aesthetic: dark glassmorphism — purple `#6c63ff` + cyan `#38bdf8` accents on `#05080f` background

## File layout
```
Nuvirahub/
├── CLAUDE.md                       ← this file — read first
├── README.md                       ← public-facing
├── LOCAL-DEV-GUIDE.md              ← XAMPP setup walkthrough
├── SETUP-GUIDE.md                  ← live-site WP install
├── sync-theme.sh                   ← copies theme-src → XAMPP htdocs
├── theme-src/nuvirahub/            ← EDIT HERE
│   ├── style.css                   ← design tokens at :root (top), 34+ numbered sections
│   ├── functions.php               ← constants + schema + contact handler
│   ├── header.php                  ← favicons + OG + Schema injection point
│   ├── footer.php                  ← real contact info + legal links + WhatsApp button
│   ├── front-page.php              ← home: hero + 7-pillar grid + spotlight + carousel
│   ├── 404.php                     ← custom dark-theme 404
│   ├── template-services-hub.php
│   ├── template-startup-launchpad.php
│   ├── template-logistics.php
│   ├── template-erp.php
│   ├── template-spices.php         ← Nuvira Spice Co. product catalog
│   ├── template-portfolio.php      ← masonry gallery + lightbox
│   ├── template-about.php          ← 3 founders
│   ├── template-contact.php
│   ├── template-legal-privacy.php  ← PDPA + GDPR
│   ├── template-legal-terms.php
│   ├── template-legal-shipping.php
│   └── assets/
│       ├── main.js                 ← all interactive behaviors (10 features)
│       └── favicons/               ← favicon-16/32, apple-touch-icon, og-image.png
├── dist/nuvirahub.zip              ← production upload to Namecheap
├── brand/logo.png                  ← source logo (1000x320, black/white wordmark)
└── docs/
    ├── GO-LIVE-CHECKLIST.md        ← 6-phase deploy runbook
    └── PRODUCTION-WP-CONFIG-SNIPPET.php
```

## Naming conventions
- **PHP/HTML classes:** `nv-*` prefix (e.g. `.nv-hero`, `.nv-pillar`, `.nv-spice-opt`)
- **PHP constants:** `NUVIRAHUB_*` (e.g. `NUVIRAHUB_WHATSAPP`, `NUVIRAHUB_SPICE_BRAND`)
- **PHP functions:** `nuvirahub_*` (e.g. `nuvirahub_wa_link()`, `nuvirahub_get_page_by_title()`)
- **Page templates:** `template-{slug}.php` with `Template Name: Nuvirahub {Title}` header
- **CSS numbered sections** — search `/* ============== NN — ` to jump to a section
- **Git branches:** `feat/{topic}`, PR into `main`

## Helpers — use these, don't reinvent
```php
NUVIRAHUB_WHATSAPP        // '94716722599' — single source for WA number
NUVIRAHUB_SPICE_BRAND     // 'Nuvira Spice Co.'
NUVIRAHUB_SPICE_CURRENCY  // '€'
nuvirahub_wa_link($msg)   // → wa.me URL with URL-encoded pre-filled message
nuvirahub_get_page_by_title($title)  // → WP_Post or null (replaces deprecated WP fn)
nuvirahub_schema_jsonld()             // emits Organization + LocalBusiness JSON-LD
nv_link($page, $slug)                 // permalink or fallback URL (footer only)
```

## CSS design tokens (style.css line ~16)
```css
--bg: #05080f       --accent:  #6c63ff
--bg2: #0a0f1e      --accent2: #a78bfa
--glass: rgba(255,255,255,0.04)
--border: rgba(255,255,255,0.08)
--text: #f0f0f8     --muted2: #a0a0c0
--display: 'Syne'   --body: 'DM Sans'
--ease: cubic-bezier(.2,.7,.2,1)
```

## Common tasks — recipes

### Add a new page
1. Create `theme-src/nuvirahub/template-{slug}.php` with `Template Name: Nuvirahub {Title}` header — copy structure from `template-logistics.php` (simplest, same shape)
2. Run `./sync-theme.sh`
3. `php /tmp/wp-cli.phar --path=/Applications/XAMPP/xamppfiles/htdocs/nuvirahub post create --post_type=page --post_title="Title" --post_status=publish` then `post meta update <id> _wp_page_template template-{slug}.php`
4. Rebuild menu (see below) if it's a top-level nav item

### Rebuild WP nav menu (after adding a page)
```bash
wp() { /opt/homebrew/bin/php /tmp/wp-cli.phar --path=/Applications/XAMPP/xamppfiles/htdocs/nuvirahub "$@"; }
wp menu delete main || true
wp menu create "Main"
for slug in home services startup-launchpad logistics erp-solutions spices portfolio about blog contact; do
  PID=$(wp post list --post_type=page --name=$slug --field=ID | head -1)
  [ -n "$PID" ] && wp menu item add-post main "$PID"
done
wp menu location assign main primary
```

### Change WhatsApp number
Edit one line — `functions.php` constant `NUVIRAHUB_WHATSAPP`. Then `./sync-theme.sh`.

### Change brand color
Edit `:root` in `style.css` (`--accent`, `--accent2`, `--accent3`). Applies everywhere.

### Rebuild production zip
```bash
cd theme-src && rm -f ../dist/nuvirahub.zip && zip -rq ../dist/nuvirahub.zip nuvirahub -x "*.DS_Store"
```

### Deploy to live Namecheap
Upload `dist/nuvirahub.zip` via wp-admin → Appearance → Themes → Add New → Upload. See `docs/GO-LIVE-CHECKLIST.md` for full procedure.

## Local dev
- XAMPP at `/Applications/XAMPP` — Apache + MySQL must be running
- Local WP at `/Applications/XAMPP/xamppfiles/htdocs/nuvirahub` (DO NOT EDIT — sync target)
- Local URL: http://localhost/nuvirahub/
- Local admin: admin/admin
- DB: `nuvirahub_local`, user `root`, no password, host `127.0.0.1` (Apache → MySQL via TCP)
- WP-CLI: `/tmp/wp-cli.phar` — run via `/opt/homebrew/bin/php /tmp/wp-cli.phar --path=<htdocs path>`
- **Do NOT symlink** theme-src into htdocs — Apache can't traverse `/Users/ranjana/`. Use `./sync-theme.sh` instead.

## Git
- Repo: **harshawalisundara97/nuvirahub** (private)
- Trunk: `main`
- Open PRs against `main` via feature branches `feat/{topic}`
- Commits use `gh` CLI conventions; co-author tag `Claude <noreply@anthropic.com>`

## Don'ts
- Don't add WooCommerce — spice orders intentionally go through WhatsApp
- Don't add a build step (no webpack, no Vite). It's pure WP.
- Don't edit `/Applications/XAMPP/xamppfiles/htdocs/nuvirahub/wp-content/themes/nuvirahub/` directly — it's the sync target, gets overwritten
- Don't enable `WP_DEBUG` on live (locally it's fine, on live the snippet in `docs/PRODUCTION-WP-CONFIG-SNIPPET.php` disables it)
- Don't commit the original `/nuvirahub.zip` at root or `nuvirahub_full_website_ui.html` — `.gitignore` excludes them

## Status snapshot (as of last edit)
- **13 published pages**: home, services, startup-launchpad, logistics, erp-solutions, spices, portfolio, about, contact, blog, privacy-policy, terms-of-service, shipping-refunds
- All return HTTP 200 with > 28 KB body
- Schema.org JSON-LD live on every page (Organization + LocalBusiness + FAQPage on Launchpad)
- OG/Twitter cards live on every page (favicon + og-image pending — `brand/logo.png` not yet on disk last I checked)
- WhatsApp number: **+94 71 672 2599** (centralised in `NUVIRAHUB_WHATSAPP`)
- 9-spice catalog with EUR pricing + WhatsApp deep-link "Buy" buttons
- 10 animation features active (parallax, magnetic buttons, 3D tilt, scroll progress, testimonial carousel, animated SVG icons, etc.)
- Floating WhatsApp button (bottom-right) with pulse animation

## What's NOT done yet
- Real images (still emojis for portfolio thumbs, spice covers, hero) — need user to provide
- Favicons + OG share image (need `brand/logo.png` saved to disk first, then I generate via `sips`)
- SMTP setup (live only — requires user's Gmail App Password)
- Yoast / Search Console / GA4 / Google Business Profile (live only)
- Cookie consent banner (live only — install plugin)
- Wordfence / UpdraftPlus / Limit Login (live only)

Git & Release Workflow — Follow Strictly

1. Branching


Never commit or push directly to main.
All work (features, bug fixes) happens on a dedicated branch off main:

feature/<short-name> for new features
fix/<short-name> for bug fixes



Branch names should be short, lowercase, hyphenated.


2. During development


Keep commits scoped to the branch's purpose.
Test manually as we go, but do not consider the branch "done" until Section 3 is complete.


3. Before opening a Pull Request

Before I say "create a PR" / "let's PR this", you must:


Check whether test cases exist for the feature/fix being touched, and for any existing related features that currently lack tests. If missing, write them.
Run the full test suite locally and show me the results.
If GitHub Actions CI is configured, confirm the workflow/build passes (check .github/workflows/, and if possible, check the latest run status) before proceeding.
Only after tests + build are green, open the PR.
Do not silently skip any of steps 1–4. If something can't be run (e.g., no CI configured yet), tell me explicitly instead of assuming it's fine.


4. After PR approval & merge


Once a PR is approved and merged into main, ask me for confirmation before deleting the feature branch (both local and remote, if applicable). Never delete it automatically.
Wait for my explicit "yes, delete it" before running the delete.


5. General rule of thumb


Test coverage first, PR second, merge third, branch cleanup last (with my confirmation).
If any step is ambiguous or CI/test setup is missing in a given repo, flag it and ask rather than guessing.
