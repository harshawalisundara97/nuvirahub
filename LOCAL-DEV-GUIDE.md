# Nuvirahub — Local Dev with XAMPP, then Push to Namecheap

This is your complete workflow:
**Edit theme locally → preview with XAMPP → re-zip → upload to your live Namecheap site.**

---

## Folder layout (what you have now)

```
Nuvirahub/
├── nuvirahub.zip              ← original theme (keep as backup)
├── SETUP-GUIDE.md             ← live-site install instructions (Step 1)
├── LOCAL-DEV-GUIDE.md         ← THIS FILE
├── theme-src/
│   └── nuvirahub/             ← editable source of the theme (live working copy)
│       ├── style.css
│       ├── functions.php
│       ├── front-page.php
│       ├── template-*.php
│       └── …
└── dist/
    └── nuvirahub.zip          ← freshly-built zip, ready to upload to live
```

You edit files inside `theme-src/nuvirahub/`. When you're happy, you re-zip into `dist/` and upload that zip to your live site.

---

## PART 1 — Install XAMPP

1. Download XAMPP for macOS: <https://www.apachefriends.org/download.html>
   Pick the **PHP 8.2 (or newer)** installer.
2. Open the `.dmg` and drag XAMPP into `/Applications`.
3. Launch **XAMPP** (Applications → XAMPP → manager-osx).
4. In the manager, go to the **Manage Servers** tab and click **Start All**
   (Apache + MySQL must both show *Running* / green).
5. Quick sanity check — open <http://localhost> in your browser.
   You should see the XAMPP dashboard.

> **Webroot path on macOS XAMPP:** `/Applications/XAMPP/xamppfiles/htdocs/`
> Everything inside that folder is served from `http://localhost/…`.

---

## PART 2 — Install WordPress locally

### 2.1  Download WordPress

```bash
cd ~/Downloads
curl -O https://wordpress.org/latest.zip
unzip latest.zip
mv wordpress /Applications/XAMPP/xamppfiles/htdocs/nuvirahub
```

You now have WordPress at `http://localhost/nuvirahub`.

### 2.2  Create the database

1. Open <http://localhost/phpmyadmin>
2. Click **New** in the left sidebar.
3. Database name: `nuvirahub_local` — Collation: `utf8mb4_unicode_ci`
4. Click **Create**.

### 2.3  Run the WP installer

1. Open <http://localhost/nuvirahub>
2. Choose language → English.
3. Fill in the database screen:

   | Field        | Value             |
   |--------------|-------------------|
   | Database     | `nuvirahub_local` |
   | Username     | `root`            |
   | Password     | *(leave blank)*   |
   | DB host      | `localhost`       |
   | Table prefix | `wp_`             |

4. Site title: **Nuvirahub** — set an admin username, strong password, and your email.
5. Click **Install WordPress** → **Log in**.

You're now in the local WP admin: <http://localhost/nuvirahub/wp-admin>

---

## PART 3 — Wire up the theme for live development

Instead of re-uploading the zip every time you tweak something, **symlink** the source folder into the WP themes directory so saving a file updates the local site instantly.

```bash
# 1. Remove any existing copy
rm -rf /Applications/XAMPP/xamppfiles/htdocs/nuvirahub/wp-content/themes/nuvirahub

# 2. Symlink the source
ln -s /Users/ranjana/Harsha/Nuvirahub/theme-src/nuvirahub \
      /Applications/XAMPP/xamppfiles/htdocs/nuvirahub/wp-content/themes/nuvirahub
```

In WP admin → **Appearance → Themes** → activate **Nuvirahub**.

Then follow Steps 2–5 of `SETUP-GUIDE.md` to create the pages
(About, Services, Portfolio, Contact, Blog, Home) and assign each its template.

> Edit any file under `theme-src/nuvirahub/` → save → refresh `http://localhost/nuvirahub` → see the change. No re-zip, no upload.

---

## PART 4 — Iterate on the redesign

The redesigned theme uses an **Editorial Atelier** aesthetic:

- Warm bone-paper background `#F1ECE2` + paper-grain overlay
- Deep ink type `#13110E`
- Single sharp accent: **vermillion** `#D63A1A`
- Fonts: **Instrument Serif** (italic display) · **Newsreader** (body) · **JetBrains Mono** (labels)
- Hairline rules, numbered sections (§ 01 — 04), no shadows

All design tokens live at the top of `theme-src/nuvirahub/style.css` inside `:root`. Tweak there to retheme globally:

```css
:root {
  --bone:        #F1ECE2;   /* page background */
  --ink:         #13110E;   /* main text */
  --vermillion:  #D63A1A;   /* the single accent */
  --serif:   "Instrument Serif", serif;   /* display */
  --body:    "Newsreader", Georgia, serif;/* body */
  --mono:    "JetBrains Mono", monospace; /* labels */
}
```

Templates you'll likely want to edit:

| File                       | What's in it                                    |
|----------------------------|-------------------------------------------------|
| `front-page.php`           | Home: hero, services, process, testimonials     |
| `template-about.php`       | About page (story + values + skills)            |
| `template-services.php`    | Services list + pricing                         |
| `template-portfolio.php`   | Project grid                                    |
| `template-contact.php`     | Contact form (posts to admin-post.php)          |
| `header.php` / `footer.php`| Nav + footer markup                             |
| `style.css`                | All visual design                               |
| `functions.php`            | Theme setup, font enqueue, contact handler      |

---

## PART 5 — Build & push to live Namecheap

When you're ready to ship a change:

### 5.1  Build a fresh zip

```bash
cd /Users/ranjana/Harsha/Nuvirahub/theme-src
rm -f ../dist/nuvirahub.zip
zip -rq ../dist/nuvirahub.zip nuvirahub -x "*.DS_Store"
```

The fresh zip is now at `dist/nuvirahub.zip`.

### 5.2  Upload to live site (Namecheap / cPanel)

1. Log in to your live site: `https://yourdomain.com/wp-admin`
2. **Appearance → Themes**
3. Hover the existing **Nuvirahub** card → **Theme Details** → **Delete** (bottom-right).
   *(Your content — pages, posts, menus — is in the database and is NOT affected.)*
4. Click **Add New** → **Upload Theme** → choose `dist/nuvirahub.zip` → **Install Now** → **Activate**.

### 5.3  Alternative: just replace `style.css` (faster for tiny CSS tweaks)

For one-off CSS changes you don't want to re-deploy the whole theme:

1. Namecheap cPanel → **File Manager**
2. Navigate to `public_html/wp-content/themes/nuvirahub/`
3. Right-click `style.css` → **Edit** (or upload your local one to overwrite)
4. Save. Hard-refresh the live site (`Cmd+Shift+R`).

---

## PART 6 — Suggested daily workflow

```bash
# Morning: start your local stack
open -a XAMPP    # then click "Start All" in the manager

# Edit theme files in your editor:
code /Users/ranjana/Harsha/Nuvirahub/theme-src/nuvirahub

# Preview live in browser:
open http://localhost/nuvirahub

# Done for the day — ship to live:
cd /Users/ranjana/Harsha/Nuvirahub/theme-src
zip -rq ../dist/nuvirahub.zip nuvirahub -x "*.DS_Store"
# then upload dist/nuvirahub.zip via wp-admin on the live site
```

---

## Troubleshooting

| Problem                                         | Fix                                                                                                       |
|-------------------------------------------------|-----------------------------------------------------------------------------------------------------------|
| `http://localhost/nuvirahub` shows a blank page | Apache or MySQL isn't running. Open XAMPP manager → Manage Servers → Start All.                           |
| "Error establishing a database connection"      | MySQL stopped, or `wp-config.php` has wrong DB name. Restart MySQL, check `wp-config.php`.                |
| Theme activates but pages are unstyled          | Hard-refresh `Cmd+Shift+R`. Or bump the version in `functions.php` `wp_enqueue_style` to bust cache.      |
| Symlink not seen by WordPress                   | Run `ls -la /Applications/XAMPP/xamppfiles/htdocs/nuvirahub/wp-content/themes/` and confirm the `->` arrow points at your source folder. Recreate if missing. |
| Fonts not loading                               | Check the browser console — `fonts.googleapis.com` must be reachable. They're loaded in `functions.php`.  |
| Contact form does nothing on live site          | Install **WP Mail SMTP** plugin and configure Gmail/SendGrid for reliable email delivery on shared hosting.|
| You broke something — want the original back    | Re-extract `nuvirahub.zip` (the original) into `theme-src/`. It's untouched in the project root.          |

---

## What changed vs the original theme

- **Aesthetic**: Dark glassmorphism → warm editorial paper brutalism
- **Fonts**: Syne/Inter → Instrument Serif · Newsreader · JetBrains Mono (loaded via Google Fonts in `functions.php`)
- **Colour**: neon gradients → bone + ink + a single vermillion accent
- **Layout language**: rounded cards → hairline-ruled grids, numbered sections, magazine-style marginalia
- **Motion**: orb floats → restrained fades + animated hairlines + slow marquee
- **All page templates retained** — no admin-side reconfiguration needed
