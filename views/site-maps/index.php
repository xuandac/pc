<?php
header('Content-Type: application/xml');
$domain = Yii::$app->params['site_domain'];
$value = json_decode($data['Value'], true);
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<?xml-stylesheet type="text/xsl" href="' . $domain . '/xml/sitemap.xsl"?>';
?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php
    if ($value['post_check'] == 1) {
        ?>
        <sitemap>
            <loc><?= $domain ?>/post-sitemap.xml</loc>
        </sitemap>
        <?php
    }
    if ($value['video_check'] == 1) {
        ?>
        <sitemap>
            <loc><?= $domain ?>/video-sitemap.xml</loc>
        </sitemap>
        <?php
    }
    if ($value['categories_check'] == 1) {
        ?>
        <sitemap>
            <loc><?= $domain ?>/categories-sitemap.xml</loc>
        </sitemap>
        <?php
    }
    ?>
	<sitemap>
            <loc><?= $domain ?>/sitemap-post-google-news.xml</loc>
        </sitemap>
</sitemapindex>
<?php
die;
?>
