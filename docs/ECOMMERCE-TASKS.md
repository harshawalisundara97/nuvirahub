# E-Commerce Module — Task Breakdown

Source: `Product Sales & E-Commerce Module.pdf` (spec sections §9–§15).
Decomposed into discrete, buildable tasks. Each task: **what** · **done-when** · **needs**.

## Current state (baseline)
- Pure WordPress theme, **no WooCommerce**, no build step.
- `template-spices.php` — Nuvira Spice Co.: 9 products, weight/price options, EUR, **WhatsApp ordering** (no cart/checkout/payments/accounts).
- Constants: `NUVIRAHUB_SPICE_CURRENCY` (€), `nuvirahub_wa_link()`.

## The one gate that splits the work
Tasks below are tagged:
- **[catalog]** — buildable now in pure WP, no platform change.
- **[woo]** — needs a transactional engine. Realistic option = **WooCommerce** (cart, checkout, payments, accounts, orders, coupons, reviews, shipping all come built-in). This overrides the current "no WooCommerce" rule.
- **[ops]** — business/admin setup, not code (gateway accounts, SSL, etc.).

---

## PHASE 1 — Catalogue & B2B (pure WP, ships without WooCommerce)

### §9 Product Catalogue
- **E1 [catalog] Product data model.** Extend each product with: Name, SKU/Code, image gallery, description, weight/volume, country of origin, stock status, unit price, **bulk price**, specifications, shipping info. *Done-when:* one source array (or CPT) holds all fields; spices migrated to it.
- **E2 [catalog] Category system.** Categories: Spices, Food, Tea & Coffee, Herbal, Logistics Equipment, Other. *Done-when:* catalogue filters by category (reuse portfolio filter pattern).
- **E3 [catalog] Catalogue listing page.** Card grid: image, name, price, origin, stock, weight, tags + buttons (Add to Cart / Buy Now / Request Wholesale). *Done-when:* renders all products with working filters.
- **E4 [catalog] Product detail page.** Gallery, description, features & benefits, nutrition (if applicable), packaging, weight options, quantity, certificates, shipping; actions: Add to Cart, Buy Now, **Add to Wishlist** (localStorage), **Share**. *Done-when:* one detail view per product, deep-linkable.
- **E5 [catalog] Reviews & ratings (display).** Star rating + review list on product. *Done-when:* shows ratings; submission can be WhatsApp/manual in P1, native in P2.

### §14 Wholesale / B2B
- **E6 [catalog] Wholesale inquiry form.** Fields: Company, Contact Person, Product, Quantity, Destination Country, Special Requirements + "Request Wholesale Quotation" → email + WhatsApp deep-link. *Done-when:* form submits and routes the lead.

### §15 Sales & Marketing
- **E7 [catalog] Merchandising sections.** Featured / Best Sellers / New Arrivals / Special Offers (badges + home rows). *Done-when:* products flaggable and surfaced.
- **E8 [catalog] WhatsApp order support + newsletter.** Keep WhatsApp buy path; newsletter already exists. *Done-when:* both wired on catalogue.

---

## PHASE 2 — Transactional store (requires WooCommerce decision)

### §9 Shopping Cart
- **E9 [woo] Cart.** View items, update qty, remove, discount codes, shipping estimate, tax, order summary. *Done-when:* cart persists and totals correctly.

### §9 Checkout
- **E10 [woo] Checkout.** Customer info (name, company optional, email, phone, billing + delivery address), shipping options (Standard / Express / International / Local Pickup), order summary (product + shipping + tax − discount = total). *Done-when:* an order can be placed end-to-end (payment stubbed until P3).

### §11 Customer Accounts
- **E11 [woo] Auth.** Register, login, reset password. *Done-when:* accounts persist with sessions.
- **E12 [woo] Customer dashboard.** View orders, track shipments, download invoices, saved addresses, manage profile. *Done-when:* all five panels work.

### §12 Order Management (admin)
- **E13 [woo] Admin order ops.** Add/edit products, manage inventory, update prices, manage orders, process refunds, reports, export customers. *Done-when:* admin runs the store from wp-admin.
- **E14 [woo] Order status pipeline.** Pending → Processing → Packed → Shipped → Delivered / Cancelled, with customer notifications. *Done-when:* status changes notify the customer.

### §13 Shipping & Logistics
- **E15 [woo] Shipping calculator.** Cost by weight, dimensions, destination country, method. *Done-when:* checkout shows live shipping cost.
- **E16 [woo] Tracking.** Tracking number + status updates + delivery notifications. *Done-when:* customers receive tracking.

### §9/§15 Native reviews
- **E17 [woo] Native reviews & ratings.** Verified-buyer reviews tied to orders. *Done-when:* buyers can rate/review purchased items.
- **E18 [woo] Discount coupons + abandoned-cart recovery.** *Done-when:* coupons apply at cart; abandoned-cart emails fire.

---

## PHASE 3 — Payments, i18n & launch

### §10 Payment Gateways
- **E19 [ops] Accounts & compliance.** Registered business, SSL (have it), gateway approval, PCI via hosted fields. *Done-when:* live credentials in hand.
- **E20 [woo] Stripe** (cards: Visa/Mastercard/Amex; Apple Pay; Google Pay). *Done-when:* test + live card payment succeeds.
- **E21 [woo] PayPal.** *Done-when:* PayPal checkout succeeds.
- **E22 [woo] Revolut Pay / bank transfer / SEPA.** *Done-when:* alternative methods selectable.
- **E23 [woo] Fraud & verification.** Order verification, fraud rules. *Done-when:* basic protection active.

### §15 Currency & Language
- **E24 [woo] Multi-currency:** EUR (€), USD ($), GBP (£). *Done-when:* prices switch by currency.
- **E25 [woo] Multi-language:** English, Latvian, Russian. *Done-when:* UI + product strings translatable.

---

## Suggested order
P1: E1 → E2 → E3 → E4 → E5 → E6 → E7 → E8 (no platform change; immediate value).
P2: E9–E18 (after WooCommerce go-ahead).
P3: E19 (ops, parallel) → E20–E25.

## Open decisions (block P2/P3 only)
1. **Engine:** WooCommerce vs stay WhatsApp-first.
2. **Range:** spices-only first vs all 6 categories now.
3. **Payments:** set up now vs later.

---

# Page Architecture (how the requirements map to pages)

Modern store = a few focused pages + shared "shell" UX (header cart, drawers, modals).
Naming follows theme convention `template-{slug}.php` / WooCommerce templates.

## Public pages
| Page | Template | Owns tasks | Spec |
|------|----------|-----------|------|
| **Shop / Catalogue** | `template-shop.php` (evolve `template-spices.php`) | E1 E2 E3 E5 E7 E8 | §9 §15 |
| **Product Detail** | `single-product.php` (woo) / `template-product.php` | E4 E5 E17 | §9 |
| **Cart** | `cart` (woo) / `template-cart.php` | E9 | §9 |
| **Checkout** | `checkout` (woo) / `template-checkout.php` | E10 E20–E23 | §9 §10 |
| **My Account** | `myaccount` (woo) | E11 E12 E16 | §11 §13 |
| **Wholesale / B2B** | `template-wholesale.php` | E6 | §14 |
| **Wishlist** | `template-wishlist.php` (localStorage in P1) | E4 | §9 |
| **Order Tracking** | `template-track.php` | E16 | §13 |
| **Admin (wp-admin)** | WooCommerce admin (not public) | E13 E14 E18 | §12 §15 |

## Shared "shell" (in header/footer, every page)
- **Mega-menu** with the 6 categories (E2).
- **Mini-cart drawer** — slide-out from header cart icon (E9 preview).
- **Quick-view modal** — peek product without leaving the grid (E3/E4).
- **Sticky add-to-cart bar** on product detail (mobile) (E4).
- **Currency switcher** EUR/USD/GBP + **language** EN/LV/RU (E24 E25).
- **Search** with live suggestions (E3).
- Reuses existing brand shell: fixed glass nav, light/dark, WhatsApp button.

## Modern UX patterns to apply
- Breadcrumbs, skeleton loaders, optimistic "added to cart" toast.
- Product cards: hover gallery, badges (New/Best/Sale), wishlist heart.
- Detail: gallery with thumbnails + zoom, weight-option pills, qty stepper, tabs (Description / Specs / Shipping / Reviews).
- Checkout: single-page accordion (Info → Shipping → Payment), trust badges, order summary sticky aside.
- Account: dashboard cards (Orders, Tracking, Invoices, Addresses, Profile).
- All glassmorphism-consistent with the current theme; works in light/dark.

## Build order by page (Phase 1, no WooCommerce)
1. Shop/Catalogue (`template-shop.php`) + data model + categories — E1 E2 E3.
2. Product Detail (`template-product.php`) — E4 E5.
3. Wholesale (`template-wholesale.php`) — E6.
4. Wishlist + merchandising rows — E4 E7.
Cart/Checkout/Account/Payments arrive in Phase 2–3 once WooCommerce is greenlit.
