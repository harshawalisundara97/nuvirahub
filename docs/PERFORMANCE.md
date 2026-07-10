# Performance optimizations (safe — no visual/functional change)

Applied to speed up the site without changing how it looks or works.

## In the theme (ships in the zip)
- `functions.php`: `main.js` loaded with **defer**; **preconnect** to Google Fonts hosts; WordPress **emoji** detection script/styles removed.
- `assets/img/**`: **WebP** copies generated next to each JPG/PNG (≈70% smaller). Originals kept as fallback.

## On the server — add to the site root `.htaccess` (NOT in the theme zip)
The block below lives in `wp-content`'s parent (`/.htaccess`, same file WordPress
manages). On localhost it's already added. **On live nuvirahub.com, paste this
block ABOVE the `# BEGIN WordPress` line** — and below any existing
`# BEGIN LSCACHE` / `# END NON_LSCACHE` block if your host's LiteSpeed
Cache plugin already added one (don't touch or reorder that block, it's
plugin-managed):

```apache
# ===== Nuvirahub performance (safe, no visual change) =====
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/plain text/css text/xml application/javascript application/x-javascript application/json image/svg+xml application/rss+xml application/xml font/ttf font/otf
</IfModule>

<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType text/css "access plus 1 year"
  ExpiresByType application/javascript "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType image/png "access plus 1 year"
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType image/svg+xml "access plus 1 year"
  ExpiresByType video/mp4 "access plus 1 year"
  ExpiresByType font/ttf "access plus 1 year"
  ExpiresByType font/woff2 "access plus 1 year"
  ExpiresByType image/x-icon "access plus 1 year"
</IfModule>

# Serve .webp automatically when supported and a matching .webp exists
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteBase /
  RewriteCond %{HTTP_ACCEPT} image/webp
  RewriteCond %{REQUEST_FILENAME} ^(.+)\.(jpe?g|png)$
  RewriteCond %1.webp -f
  RewriteRule ^(.+)\.(jpe?g|png)$ $1.webp [T=image/webp,L]
</IfModule>
<IfModule mod_headers.c>
  <FilesMatch "\.(jpe?g|png)$">
    Header append Vary Accept
  </FilesMatch>
</IfModule>
# ===== end Nuvirahub performance =====
```

Note: on live, `RewriteBase` is `/` (site at domain root) instead of `/nuvirahub/`.

## WebP for media-library images on live
Theme image WebPs ship in the zip. For **product/blog images** (in
`wp-content/uploads`), regenerate WebP on the live server, e.g.:

```bash
find wp-content/uploads -type f \( -iname '*.jpg' -o -iname '*.png' \) -size +20k \
  -exec sh -c 'cwebp -quiet -q 80 "$1" -o "${1%.*}.webp"' _ {} \;
```

…or install a WebP plugin (e.g. "Converter for Media") which does this automatically.

## Measured locally
- `style.css`: 128 KB → ~22 KB over the wire (gzip).
- Founder photo: 508 KB PNG → 22 KB WebP.
- Static assets cached for 1 year (instant repeat visits).
