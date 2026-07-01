# Sprint Status — Nuvirahub

Live tracker. Updated as items move. See `docs/GO-LIVE-CHECKLIST.md` for the full how-to on each live-site item.

Legend: ✅ done · 🟡 in progress · ⏳ blocked on user input · ⏸ ready for user to execute · ❌ todo

---

## Sprint 1 — Launch readiness

Goal: **legally and technically safe to point nuvirahub.com at the site.**

| # | Item | Status | Notes |
|---|---|---|---|
| 1.1 | **Favicon set** (16/32/180/192/512) | ⏳ blocked | Waiting for `brand/logo.png` on disk |
| 1.2 | **Logo in header** (replace gradient text) | ⏳ blocked | Same — needs logo file |
| 1.3 | **OG share image** (1200×630) | ⏳ blocked | Generated from logo + tagline |
| 1.4 | **SSL on Namecheap** | ⏸ user action | cPanel → SSL/TLS Status → Run AutoSSL → Force HTTPS |
| 1.5 | **Disable WP_DEBUG on live** | ⏸ user action | Snippet ready at `docs/PRODUCTION-WP-CONFIG-SNIPPET.php` |
| 1.6 | **Privacy Policy page** | ✅ done | Live at `/privacy-policy/` — PDPA + GDPR |
| 1.7 | **Terms of Service page** | ✅ done | Live at `/terms-of-service/` |
| 1.8 | **Shipping & Refunds page** | ✅ done | Live at `/shipping-refunds/` — EU consumer law |
| 1.9 | **Cookie consent banner** | ⏸ user action | Plugin install on live (Cookie Notice & Compliance — free) |
| 1.10 | **Real address/phone/email in footer + schema** | ✅ done | 27/2E Pieris Avenue · +94 71 672 2599 · nuvirahub@gmail.com |
| 1.11 | **Contact form SMTP via Gmail** | ⏸ user action | Needs Gmail App Password + WP Mail SMTP plugin (steps in checklist) |
| 1.12 | **Backup plan** | ⏸ user action | UpdraftPlus → Google Drive (steps in checklist) |
| 1.13 | **Strong admin password + 2FA** | ⏸ user action | Two Factor plugin (steps in checklist) |
| 1.14 | **Wordfence security** | ⏸ user action | Plugin install + Brute Force Protection |
| 1.15 | **Limit Login Attempts** | ⏸ user action | Plugin install |
| 1.16 | **Custom 404 page** | ✅ done | Dark-theme styled, on-brand |
| 1.17 | **Open Graph + Twitter cards** | ✅ done | Every page (og-image pending logo) |
| 1.18 | **Schema.org JSON-LD** | ✅ done | Organization + LocalBusiness + FAQPage on Launchpad |
| 1.19 | **Sitemap.xml + robots.txt** | ⏸ user action | Install Yoast SEO on live (auto-generates) |
| 1.20 | **Google Search Console + GA4** | ⏸ user action | Steps in checklist |

**Sprint 1 progress: 8/20 done · 1 area blocked on user (logo file) · 11 items waiting on user to execute the live-site setup**

**🚨 Immediate unblocker:** Save `brand/logo.png` → I do items 1.1, 1.2, 1.3 in one batch.

---

## Sprint 2 — Real content

Goal: **replace every placeholder/emoji with real photos and copy.**

All items blocked on user supplying assets. **One reply per asset is fine** — drag/paste files into the chat with a label.

| # | Item | Status | What I need from you |
|---|---|---|---|
| 2.1 | **Logo source file** | ⏳ blocked | PNG (have screenshot, need disk file) — ideally also SVG for sharp scaling |
| 2.2 | **3 founder photos** | ⏳ blocked | Headshots of Harsha, Akalanka, Heshan (any square crop ≥ 400×400) |
| 2.3 | **Founder bios** | ⏳ blocked | 2–3 sentences each — role, background, what you bring |
| 2.4 | **6 portfolio screenshots** | ⏳ blocked | Real project shots — replaces masonry emojis |
| 2.5 | **5 real testimonials** | ⏳ blocked | Name, role, company, quote, optional photo. Even 1 real one is better than 5 fake. |
| 2.6 | **3–5 spice product photos** | ⏳ blocked | Actual spice packaging or close-up shots — replaces emoji covers |
| 2.7 | **Client logo strip** | ⏳ blocked | 6–12 client logos (PNG, transparent) for the "Trusted by" row |
| 2.8 | **Hero background asset** *(optional)* | ⏳ blocked | A video clip OR photo for behind the hero — current orbs are fine if you skip |
| 2.9 | **Real social handles** | ⏳ blocked | LinkedIn / Instagram / Facebook URLs (if any exist yet) |

**Sprint 2 progress: 0/9 done · all waiting on assets from you**

---

## Sprint 3 — Conversion + spice store maturity

Goal: **turn pretty traffic into paying customers + meet EU food regs.**

Scheduled to start **after Sprint 2 lands** (because items 3.5, 3.6, 3.7 need real spice photos).

| # | Item | Status | Notes |
|---|---|---|---|
| 3.1 | **Sticky CTA bar** ("Book free consult →" after scroll) | ❌ todo | I can build now — no assets needed |
| 3.2 | **Exit-intent popup** (free consultation offer) | ❌ todo | I can build now |
| 3.3 | **Live chat widget** (Tawk.to — free) | ⏸ user action | 5-min signup at tawk.to, paste embed code |
| 3.4 | **Calendly embed** (book a consult page) | ⏸ user action | Free Calendly account, paste URL |
| 3.5 | **EU food labelling on spice cards** | ❌ todo | Allergens, nutrition data (per spice), origin codes |
| 3.6 | **Best-before date + batch code display** | ❌ todo | Dynamic placeholders or per-product fields |
| 3.7 | **Multi-item spice cart** (vs current 1-click-1-product) | ❌ todo | Localstorage cart + 1 WA message with full order |
| 3.8 | **Latvian + Russian language toggle** (spice page only) | ❌ todo | Polylang plugin OR custom URL switcher |
| 3.9 | **Pricing comparison table** for services | ❌ todo | I can build now |
| 3.10 | **Bulk inquiry form** (mentioned in copy, not built) | ❌ todo | Either WPForms or custom |
| 3.11 | **Quote calculator** for services | ❌ todo | Custom JS — can build now |
| 3.12 | **Spice gift box** product (€45) | ❌ todo | Add as 10th product on spice page |
| 3.13 | **Recipe blog category** | ❌ todo | New WP category + sample posts |
| 3.14 | **Lead magnet** (Sri Lanka Biz Reg Checklist PDF) | ⏳ blocked on content | Need the PDF — I can design it |

**Sprint 3 progress: 0/14 · 4 items I can build today without any assets**

---

## What's actually possible right now (no user action needed)

If you want me to keep building while you gather Sprint 2 assets, I can do these **immediately** with zero extra input:

- [ ] **Sprint 3.1** Sticky CTA bar
- [ ] **Sprint 3.2** Exit-intent popup
- [ ] **Sprint 3.9** Pricing comparison table
- [ ] **Sprint 3.11** Service quote calculator
- [ ] **Sprint 3.5** EU food labelling on spice cards (placeholder allergen/origin data, you correct later)
- [ ] **Sprint 3.7** Multi-item spice cart with WhatsApp checkout
- [ ] **Sprint 3.12** Spice gift box product

Pick any of those and I'll execute.

---

## What needs user input (in priority order)

1. **Save `brand/logo.png` to disk** ← unblocks Sprint 1 favicons + OG image
2. **Send 3 founder photos + 1-line bios** ← unblocks About page polish
3. **Send 6 portfolio screenshots** ← unblocks gallery
4. **Send 3 real spice photos** ← unblocks spice page polish + Sprint 3.5
5. **Send 1+ real testimonial** (with permission) ← swap out fake ones
6. **Decide on live-deploy timing** — when ready, follow `docs/GO-LIVE-CHECKLIST.md`
