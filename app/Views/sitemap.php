<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($routes as $path): ?>
    <url>
        <loc><?= esc(base_url($path)) ?></loc>
        <lastmod><?= esc($lastmod) ?></lastmod>
    </url>
<?php endforeach; ?>
</urlset>
