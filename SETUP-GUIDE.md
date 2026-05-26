# Nuvirahub WordPress Theme — Setup Guide

This is your custom WordPress theme (`nuvirahub.zip`). It recreates the full dark glassmorphism design — animated nav, gradient hero, smooth entrance animations, and all six pages — and works on your self-hosted WordPress (Namecheap cPanel) site.

## Step 1 — Install the theme

1. Log in to your WordPress dashboard (`yourdomain.com/wp-admin`).
2. Go to **Appearance → Themes → Add New → Upload Theme**.
3. Click **Choose File**, select `nuvirahub.zip`, then **Install Now**.
4. Click **Activate**.

Your site now uses the Nuvirahub theme.

## Step 2 — Create the pages

The design expects six pages. Go to **Pages → Add New** and create each one with the exact title shown, then assign the matching template under **Page Attributes → Template** (right-hand sidebar) before publishing:

| Page title | Template to select        |
|------------|---------------------------|
| About      | Nuvirahub About           |
| Services   | Nuvirahub Services        |
| Portfolio  | Nuvirahub Portfolio       |
| Contact    | Nuvirahub Contact         |
| Blog       | (leave as Default)        |

You do not need to add any content inside these pages — the design is built into the templates. (Anything you *do* type into the About page body will appear below the designed section, which is handy for extra text later.)

## Step 3 — Set the homepage and blog page

1. Create one more page titled **Home** (leave template as Default, no content needed).
2. Go to **Settings → Reading**.
3. Set **Your homepage displays** to **A static page**.
4. Homepage → **Home**. Posts page → **Blog**.
5. Save.

The Home page automatically uses the designed front page (hero, services, process, testimonials).

## Step 4 — Build the navigation menu

1. Go to **Appearance → Menus**.
2. Create a menu named "Main", add the pages: Home, About, Services, Portfolio, Blog, Contact (in that order).
3. Under **Menu Settings**, tick **Primary Menu**.
4. Save.

(If you skip this, the theme shows a sensible default menu automatically.)

## Step 5 — Set your site title

Go to **Settings → General** and set **Site Title** to `Nuvirahub`. This appears in the logo and footer. You can also upload a logo image under **Appearance → Customize → Site Identity**.

## The contact form

The Contact page form works out of the box and emails submissions to your admin email (**Settings → General → Administration Email Address**). For reliable delivery on shared hosting, consider a free SMTP plugin like **WP Mail SMTP** later.

## Editing content

- **Blog posts:** Posts → Add New. They appear automatically on the Blog page with the styled cards.
- **Placeholder text** (stats, testimonials, services, portfolio projects) lives inside the template files. When you're ready to swap in real content, send me the details and I'll give you updated files — or you can edit them directly under **Appearance → Theme File Editor**.

## Notes

- The current content is placeholder, as agreed. Real bio, services, projects, and contact details can be dropped in anytime.
- Colours, fonts, and spacing are all defined at the top of `style.css` (the `:root` variables) if you ever want to tweak the palette.
