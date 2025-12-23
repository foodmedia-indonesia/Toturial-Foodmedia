# Toturial-Foodmedia — Deploy Guide

Static multi-page site (HTML/CSS/JS) suitable for shared hosting or modern static hosts.

## Local Preview

```bash
python3 -m http.server 5500
# open http://localhost:5500/index.html
```

## Option A — cPanel / File Manager
- Zip project contents, including index.html and other pages.
- cPanel → File Manager → open `public_html/`.
- Upload ZIP → Extract → ensure `index.html` is directly inside `public_html/`.
- Visit `https://yourdomain.com`.

## Option B — FTP/SFTP (FileZilla/Cyberduck)
- Create/find FTP account in cPanel.
- Connect to `ftp.yourdomain.com` (prefer SFTP/port 22 if available).
- Upload all files to `/public_html/`.

Via terminal:
```bash
# SFTP
sftp user@yourdomain.com
put -r /Users/hamzah/ProjectDev/Toturial-Foodmedia/* public_html/

# rsync over SSH
rsync -avz --delete /Users/hamzah/ProjectDev/Toturial-Foodmedia/ user@yourdomain.com:public_html/
```

## Option C — Netlify
- Push repo to GitHub.
- Netlify → New site → Import from Git.
- Build command: (leave empty) • Publish directory: `.` 
- Deploy → Add custom domain → set DNS CNAME → enable HTTPS.

## Option D — Vercel
- New Project → Import GitHub repo.
- Framework: “Other/Static” • Build command: (empty) • Output dir: `.` 
- Deploy → Add custom domain → update DNS → HTTPS auto-enabled.

## Option E — GitHub Pages
- Repo → Settings → Pages → Source: `main` • Folder: `/ (root)`.
- Site: `https://username.github.io/repo`.
- For custom domain: set in Pages and add a CNAME DNS record.

## Post-Deploy Checklist
- HTTPS works on your domain.
- Hero video on `index.html` autoplays muted and loops.
- Images and YouTube thumbnails render (disable ad/privacy blockers if testing issues).
- Test on mobile: plays inline, navigation and modals work.

## Troubleshooting
- Use HTTPS to minimize autoplay restrictions.
- Serve from HTTP(S); do not open via `file://`.
- If hero video doesn’t autoplay, ensure browser extensions aren’t blocking iframes/YouTube.

## Optional: Shared Hosting Optimizations
- `.htaccess` included to force HTTPS and enable simple caching/compression (if modules are available on your host).

## SEO Setup

This repo includes base SEO metadata on key pages and a permissive `robots.txt`. To complete SEO:

1) Share your production domain (e.g., https://foodmedia.id)
2) I will generate `sitemap.xml` with absolute URLs and optionally add canonical tags.

If you prefer to create it yourself, use this quick template for `sitemap.xml`:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url><loc>https://YOUR-DOMAIN/</loc></url>
	<url><loc>https://YOUR-DOMAIN/index.html</loc></url>
	<url><loc>https://YOUR-DOMAIN/tutorials.html</loc></url>
	<url><loc>https://YOUR-DOMAIN/ppt-tutorial.html</loc></url>
	<url><loc>https://YOUR-DOMAIN/blog.html</loc></url>
	<url><loc>https://YOUR-DOMAIN/blog-detail.html</loc></url>
	<url><loc>https://YOUR-DOMAIN/Artikel.html</loc></url>
	<url><loc>https://YOUR-DOMAIN/faq.html</loc></url>
	<url><loc>https://YOUR-DOMAIN/kantor-wilayah.html</loc></url>
	<url><loc>https://YOUR-DOMAIN/linktree.html</loc></url>
	<url><loc>https://YOUR-DOMAIN/login.html</loc></url>
</urlset>
```

Then add this line to `robots.txt` after deploy:

```
Sitemap: https://YOUR-DOMAIN/sitemap.xml
```