<?php
header('Content-Type: application/xml');
$domain = Yii::$app->params['site_domain'];
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<?xml-stylesheet type="text/xsl" href="' . $domain . '/xml/sitemap.xsl"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php
    foreach ($data as $k => $item) {
        ?>
        <url>
            <loc><?= $domain . "/" . $item->Slug ?></loc>
            <lastmod><?= $item->DateUpdate ?></lastmod>
        </url>
        <?php
    }
    ?>
</urlset>
<?php
die;
?>
