<?php
header('Content-Type: application/xml');
$domain = Yii::$app->params['site_domain'];
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<?xml-stylesheet type="text/xsl" href="' . $domain . '/xml/sitemap.xsl"?>';
?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php
    for ($i = 1; $i <= $total_page; $i++) {
        ?>
        <sitemap>
            <loc><?= $domain ?>/categories-sitemap-page-<?= $i ?>.xml</loc>
        </sitemap>
        <?php
    }
    ?>
</sitemapindex>
<?php
die;
?>
