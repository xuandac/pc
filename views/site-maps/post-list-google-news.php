<?php

function findString($string) {
    $search = ["'", "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+", "-", "=", '"', "/", "?", ":", ";", ".", ">", ",", "<", "}", "{", "[", "]", "|", '\\'];
    return str_replace($search, "", $string);
}

header('Content-Type: application/xml');
$domain = Yii::$app->params['site_domain'];
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<?xml-stylesheet type="text/xsl" href="' . $domain . '/xml/sitemap.xsl"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
     xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"
     xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
     xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
       http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
       http://www.google.com/schemas/sitemap-news/0.9
       http://www.google.com/schemas/sitemap-news/0.9/sitemap-news.xsd">
            <?php
            foreach ($data as $k => $item) {
                ?>
        <url>
            <loc><?= $domain . "/" . $item->Slug ?></loc>
            <lastmod><?= date("Y-m-d", strtotime($item->DateUpdate)) ?></lastmod>
            <news:news>
                <news:publication>
                    <news:name><?= findString($item->Title) ?></news:name>
                    <news:language>vi</news:language>
                </news:publication>
                <news:genres>PressRelease, Blog</news:genres>
                <news:publication_date><?= date("Y-m-d", strtotime($item->DateUpdate)) ?></news:publication_date>
                <news:title><?= findString($item->Title) ?></news:title>
                <news:keywords><?= $item->SEO_Keywords ?></news:keywords>
            </news:news>
        </url>
        <?php
    }
    ?>
</urlset>
<?php
die;
?>
