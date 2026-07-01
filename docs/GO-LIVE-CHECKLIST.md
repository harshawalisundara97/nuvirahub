# Nuvirahub — Go-Live Checklist

A one-pass checklist to take the site from local XAMPP → live at **nuvirahub.com** safely.

Tick each box as you complete it. Most steps take 5 minutes. The whole list is ~2 hours, mostly waiting for cPanel.

---

## ☐ Phase 1 — Security & legal (do these first)

### ☐ 1.1 Force HTTPS on Namecheap
1. cPanel → **SSL/TLS Status**
2. Find `nuvirahub.com` + `www.nuvirahub.com`
3. Click **Run AutoSSL** (free Let's Encrypt cert)
4. Wait ~5 min for the cert
5. **Domains → Force HTTPS Redirect** → ON for nuvirahub.com

### ☐ 1.2 Update live `wp-config.php`
1. cPanel → **File Manager** → `public_html/wp-config.php`
2. Right-click → **Edit**
3. **Replace** the `define('WP_DEBUG', true);` block with the production block from `docs/PRODUCTION-WP-CONFIG-SNIPPET.php`
4. Save

### ☐ 1.3 Strong admin password + 2FA
1. wp-admin → **Users → admin** (your account)
2. Click **Set New Password** → generate a 24-char password → save in a password manager
3. Install plugin **WP 2FA** or **Two Factor**
4. Activate → enable TOTP, scan with Google Authenticator / 1Password

### ☐ 1.4 Install security plugin (Wordfence)
1. wp-admin → **Plugins → Add New** → search "Wordfence"
2. Install + Activate
3. Skip the email signup or enter `nuvirahub@gmail.com`
4. **Wordfence → All Options** → enable Brute Force Protection, Login Lockout after 5 failures, country blocking if desired

### ☐ 1.5 Install backup plugin (UpdraftPlus)
1. wp-admin → **Plugins → Add New** → search "UpdraftPlus"
2. Install + Activate
3. **Settings → UpdraftPlus Backups**
4. Set schedule: Files = **Weekly**, Database = **Daily**, retain 4 of each
5. Remote storage: **Google Drive** (or Dropbox) → authenticate
6. Click **Backup Now** to confirm it works

### ☐ 1.6 Install Limit Login Attempts Reloaded
1. wp-admin → **Plugins → Add New** → "Limit Login Attempts Reloaded"
2. Install + Activate (default settings are fine)

---

## ☐ Phase 2 — Upload theme & content

### ☐ 2.1 Upload the latest theme
1. **Locally:**
   ```bash
   cd /Users/ranjana/Harsha/Nuvirahub/theme-src
   zip -rq ../dist/nuvirahub.zip nuvirahub -x "*.DS_Store"
   ```
2. **wp-admin:** Appearance → Themes → Add New → Upload Theme → choose `dist/nuvirahub.zip` → Install Now → Activate
3. If a prior version exists, delete it first via Theme Details → Delete

### ☐ 2.2 Create the 12 pages
Each page: **Pages → Add New** → set title → **Page Attributes → Template** → publish.

| Title | Template |
|---|---|
| Home | (Default) |
| Services | Nuvirahub Services Hub |
| Startup Launchpad | Nuvirahub Startup Launchpad |
| Logistics | Nuvirahub Logistics |
| ERP Solutions | Nuvirahub ERP |
| Spices | Nuvirahub Spices (Nuvira Spice Co.) |
| Portfolio | Nuvirahub Portfolio |
| About | Nuvirahub About |
| Contact | Nuvirahub Contact |
| Blog | (Default) |
| Privacy Policy | Nuvirahub Privacy Policy |
| Terms of Service | Nuvirahub Terms of Service |
| Shipping & Refunds | Nuvirahub Shipping & Refunds |

### ☐ 2.3 Settings
1. **Settings → Reading** → Your homepage displays: **A static page** → Homepage: Home, Posts page: Blog → Save
2. **Settings → Permalinks** → choose **Post name** → Save (regenerates `.htaccess`)
3. **Settings → General** → Site Title: `Nuvirahub`, Tagline: `One partner for software, business growth, logistics, creative, marketing and ERP`, Admin email: `nuvirahub@gmail.com`

### ☐ 2.4 Build the menu
1. **Appearance → Menus → Create new menu** "Main"
2. Add (in this order): Home · Services · Startup Launchpad · Logistics · ERP Solutions · Spices · Portfolio · About · Blog · Contact
3. **Menu Settings → Primary Menu** ☑ → Save

### ☐ 2.5 Upload favicons
Once I generate `assets/favicons/` from your logo.png, the favicon block in `header.php` will automatically work. No extra action needed if `dist/nuvirahub.zip` was rebuilt after favicon generation.

---

## ☐ Phase 3 — Email (WP Mail SMTP via Gmail)

WordPress's default `wp_mail()` from cPanel often lands in spam. Routing through Gmail fixes it.

### ☐ 3.1 Enable Gmail 2-Step Verification
1. https://myaccount.google.com/security
2. Turn ON **2-Step Verification** (required for App Passwords)

### ☐ 3.2 Generate a Gmail App Password
1. https://myaccount.google.com/apppasswords
2. App: **Mail**, Device: **Other** → name it "Nuvirahub WP"
3. Copy the 16-character password (will look like `abcd efgh ijkl mnop`)

### ☐ 3.3 Install WP Mail SMTP
1. wp-admin → **Plugins → Add New** → search "WP Mail SMTP"
2. Install + Activate
3. **WP Mail SMTP → Settings**:
   - From Email: `nuvirahub@gmail.com`
   - From Name: `Nuvirahub`
   - Mailer: **Other SMTP**
   - SMTP Host: `smtp.gmail.com`
   - Encryption: **TLS**
   - SMTP Port: **587**
   - Authentication: ON
   - SMTP Username: `nuvirahub@gmail.com`
   - SMTP Password: paste the App Password (no spaces)
4. Save → **Email Test** tab → send a test to your own address → confirm it arrives

---

## ☐ Phase 4 — SEO baseline

### ☐ 4.1 Install Yoast SEO
1. wp-admin → **Plugins → Add New** → "Yoast SEO"
2. Install + Activate
3. Walk through the configuration wizard:
   - Site represents: **A company**
   - Company name: `Nuvirahub (Pvt) Ltd`
   - Company logo: upload `/brand/logo.png`
4. Yoast auto-generates **sitemap.xml** and **robots.txt**

### ☐ 4.2 Google Search Console
1. https://search.google.com/search-console
2. Add property: `https://nuvirahub.com`
3. Verify via DNS TXT record (Namecheap → Domain → Advanced DNS → add TXT) OR HTML file upload
4. Submit sitemap: `https://nuvirahub.com/sitemap_index.xml`

### ☐ 4.3 Google Analytics 4
1. https://analytics.google.com → Create property "Nuvirahub"
2. Copy the Measurement ID (`G-XXXXXXXXXX`)
3. wp-admin → install plugin **"Site Kit by Google"** → connect → paste the GA4 ID

### ☐ 4.4 Google Business Profile
1. https://www.google.com/business
2. Add business: Nuvirahub, address 27/2E Pieris Avenue Kalubowila Dehiwala 10350, category Software Company
3. Verify by postcard (Google mails a 5-digit code to your address)
4. Add hours, photos, website link → publish

---

## ☐ Phase 5 — Final checks

### ☐ 5.1 Test rich-result preview
- Paste `https://nuvirahub.com/` into https://search.google.com/test/rich-results — expect Organization + LocalBusiness detected
- Paste `https://nuvirahub.com/startup-launchpad/` — expect FAQPage detected

### ☐ 5.2 Test OG card preview
- https://www.opengraph.xyz/ → paste your home URL → confirm logo + title + description appear

### ☐ 5.3 Mobile test
- https://search.google.com/test/mobile-friendly → paste home URL → must pass
- Click WhatsApp button on your phone → confirm it opens with the right number

### ☐ 5.4 Speed test
- https://pagespeed.web.dev/ → home URL → aim for 80+ mobile, 90+ desktop
- If low, install **LiteSpeed Cache** (free, cPanel-optimised) or **W3 Total Cache**

### ☐ 5.5 Form test
- Fill the contact form → confirm email arrives at `nuvirahub@gmail.com` from the SMTP setup
- Click a spice "Order" button → WhatsApp opens with the right pre-filled message

### ☐ 5.6 Legal pages link check
- Footer → Privacy → loads
- Footer → Terms → loads
- Footer → Shipping & Refunds → loads
- All link back to home + contain real address + email

### ☐ 5.7 404 page
- Visit `https://nuvirahub.com/this-does-not-exist/` → confirm the styled dark-theme 404 page renders

---

## ☐ Phase 6 — Soft launch

1. ☐ Share the live URL with 3–5 friends + ask for honest feedback
2. ☐ Fix anything obvious
3. ☐ Post on LinkedIn / Facebook announcing the site
4. ☐ Email past clients with the new URL
5. ☐ Reply to first 10 contact form / WhatsApp messages within 1 hour to set the response standard

---

## Quick re-deploy cheat sheet

When you want to push a theme update from local → live:

```bash
cd /Users/ranjana/Harsha/Nuvirahub/theme-src
zip -rq ../dist/nuvirahub.zip nuvirahub -x "*.DS_Store"
```

Then in wp-admin:
1. Appearance → Themes → Nuvirahub → Theme Details → Delete
2. Add New → Upload Theme → `dist/nuvirahub.zip` → Install → Activate

(Your content, plugins, settings are in the database — untouched by theme deletion.)
