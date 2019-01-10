<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($site as $key => $value) { ?>
  <url>
    <loc><?php echo $value['loc']; ?></loc>
    <lastmod><?php echo $value['lastmod']; ?></lastmod>
    <changefreq><?php echo $value['changefreq']; ?></changefreq>
    <priority><?php echo $value['priority']; ?></priority>
  </url>
<?php } ?>
</urlset>