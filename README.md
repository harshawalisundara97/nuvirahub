# Nuvirahub — WordPress Theme

The official WordPress theme + local-dev workflow for **[Nuvirahub](https://nuvirahub.com)** — a Sri Lankan multi-service company delivering software development, business growth consulting, end-to-end startup launch services, sea & air freight logistics, creative & 3D design, brand marketing, and enterprise ERP.

> One partner. Seven service pillars. The team behind the team.

---

## What's in the box

```
.
├── theme-src/nuvirahub/      Editable source of the WordPress theme
│   ├── style.css             v3.0.0 — dark glassmorphism (Syne + DM Sans)
│   ├── functions.php         Theme setup, font enqueue, contact handler
│   ├── header.php · footer.php · front-page.php
│   ├── template-services-hub.php       (7-pillar Services hub)
│   ├── template-startup-launchpad.php  (Flagship: 5-step roadmap + docs + authorities)
│   ├── template-logistics.php          (Sea & air freight)
│   ├── template-erp.php                (Enterprise ERP)
│   ├── template-about.php · template-contact.php · template-portfolio.php
│   └── assets/main.js · index.php · single.php · page.php · archive.php · search.php
├── dist/nuvirahub.zip        Production-ready build (upload to live WordPress)
├── sync-theme.sh             Copies theme-src → local XAMPP htdocs (also has --watch mode)
├── LOCAL-DEV-GUIDE.md        Step-by-step XAMPP setup
└── SETUP-GUIDE.md            Step-by-step live-site install (Namecheap cPanel)
```

## Pages this theme provides

| URL | Template | What it shows |
|---|---|---|
| `/` | `front-page.php` | Hero · 7-pillar grid · Startup Launchpad spotlight · process · testimonials |
| `/services/` | `template-services-hub.php` | All 7 pillars + anchored detail sections |
| `/startup-launchpad/` | `template-startup-launchpad.php` | 5-step launch roadmap, document checklist, 8 government authorities directory |
| `/logistics/` | `template-logistics.php` | Sea & air freight, 5-step shipping process, coverage map |
| `/erp-solutions/` | `template-erp.php` | 6 ERP modules, industries, 8–12-week implementation timeline |
| `/portfolio/` | `template-portfolio.php` | Project showcase |
| `/about/` | `template-about.php` | Company story + skill bars |
| `/contact/` | `template-contact.php` | Contact form (posts to `admin-post.php`) |
| `/blog/` | `index.php` | Blog post listing |

## Quick start (local dev with XAMPP)

```bash
# 1. Install XAMPP from https://www.apachefriends.org/
# 2. Start Apache + MySQL via XAMPP manager
# 3. Set up WordPress at /Applications/XAMPP/xamppfiles/htdocs/nuvirahub
#    (see LOCAL-DEV-GUIDE.md for the full walkthrough)
# 4. Sync this theme into WordPress:
./sync-theme.sh

# Or auto-sync on every save (recommended):
brew install fswatch
./sync-theme.sh --watch
```

Visit **http://localhost/nuvirahub** to see it live.

Full guide: [LOCAL-DEV-GUIDE.md](./LOCAL-DEV-GUIDE.md)

## Deploy to live site (Namecheap cPanel)

1. Build a fresh zip:
   ```bash
   cd theme-src && zip -rq ../dist/nuvirahub.zip nuvirahub -x "*.DS_Store"
   ```
2. WordPress admin → **Appearance → Themes → Add New → Upload Theme** → choose `dist/nuvirahub.zip` → **Install Now** → **Activate**.

Full guide: [SETUP-GUIDE.md](./SETUP-GUIDE.md)

## Design system

Tokens live in `theme-src/nuvirahub/style.css` `:root`:

| Token | Value | Purpose |
|---|---|---|
| `--bg` | `#05080f` | Page background |
| `--bg2` | `#0a0f1e` | Footer / strip |
| `--accent` | `#6c63ff` | Primary purple |
| `--accent2` | `#a78bfa` | Lavender highlight |
| `--accent3` | `#38bdf8` | Cyan secondary |
| `--text` | `#f0f0f8` | Body text |
| `--display` | `'Syne', sans-serif` | All headings + brand |
| `--body` | `'DM Sans', sans-serif` | Body text |

Visual language: **frosted-glass cards**, **floating gradient orbs**, **gradient text on key headlines**, hairline borders, subtle hover lift. Built mobile-first.

## Tech

- WordPress 6.x compatible
- PHP 8.0+
- Google Fonts (Syne + DM Sans) via CDN — see `functions.php`
- No build step. No node. Pure PHP + CSS + a tiny `main.js` for the mobile menu + scroll-reveal.

## License

GPL-2.0-or-later (WordPress standard).
