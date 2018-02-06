<?php

namespace app\services;

use app\models\Sitemap;
use app\models\Categories;
use app\models\Post;

class SiteMapsService {

    public function findByKey($key) {
        return Sitemap::find()->where(['Key' => $key])->one();
    }

    public function listSiteMaps() {
        
    }

    public function sitemapCategories() {
        return Categories::find()->where(['Status' => 1])->all();
    }

    public function sitemapPost() {
        return Post::find()
                        ->where(['Status' => 1])
                        ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                        ->andWhere(['IsDelete' => 0])
                        ->andWhere(['Post_Type' => 'POST'])->orderBy("ID DESC")->all();
    }

    public function sitemapVideo() {
        return Post::find()
                        ->where(['Status' => 1])
                        ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                        ->andWhere(['IsDelete' => 0])
                        ->andWhere(['Post_Type' => 'VIDEO'])->orderBy("ID DESC")->all();
    }

    public function sitemapCategoriesPage($limit, $page) {
        $offset = ($page - 1) * $limit;
        return Categories::find()->where(['Status' => 1])->limit($limit)->offset($offset)->all();
    }

    public function sitemapPostPage($limit, $page) {
        $offset = ($page - 1) * $limit;
        return Post::find()
                        ->where(['Status' => 1])
                        ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                        ->andWhere(['IsDelete' => 0])
                        ->andWhere(['Post_Type' => 'POST'])->orderBy("ID DESC")
                        ->limit($limit)->offset($offset)->all();
    }

    public function sitemapPostGoogleNews($limit) {
        $today = date("Y-m-d");
        $return_date = strtotime('-1 day', strtotime($today));
        $startDate = date('Y-m-d', $return_date) . " 00:00:00";
        $endDate = date('Y-m-d') . " 23:59:59";
        return Post::find()
                        ->where(['Status' => 1])
                        ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                        ->andWhere(['>=', 'DateUpdate', $startDate])
                        ->andWhere(['<=', 'DateUpdate', $endDate])
                        ->andWhere(['IsDelete' => 0])->orderBy("ID DESC")
                        ->limit($limit)->all();
    }

    public function sitemapVideoPage($limit, $page) {
        $offset = ($page - 1) * $limit;
        return Post::find()
                        ->where(['Status' => 1])
                        ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                        ->andWhere(['IsDelete' => 0])
                        ->andWhere(['Post_Type' => 'VIDEO'])->orderBy("ID DESC")
                        ->limit($limit)->offset($offset)->all();
    }

    public function sitemapVideoGoogleNews($limit) {
        $today = date("Y-m-d");
        $return_date = strtotime('-1 day', strtotime($today));
        $startDate = date('Y-m-d', $return_date) . " 00:00:00";
        $endDate = date('Y-m-d') . " 23:59:59";
        return Post::find()
                        ->where(['Status' => 1])
                        ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                        ->andWhere(['>=', 'DateUpdate', $startDate])
                        ->andWhere(['<=', 'DateUpdate', $endDate])
                        ->andWhere(['IsDelete' => 0])
                        ->andWhere(['Post_Type' => 'VIDEO'])->orderBy("ID DESC")
                        ->limit($limit)->all();
    }

    public function countPageSitemapCategories($limit) {
        $count = Categories::find()->where(['Status' => 1])->count();
        return ceil($count / $limit);
    }

    public function countPageSitemapPost($limit) {
        $count = Post::find()
                        ->where(['Status' => 1])
                        ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                        ->andWhere(['IsDelete' => 0])
                        ->andWhere(['Post_Type' => 'POST'])->orderBy("ID DESC")->count();
        return ceil($count / $limit);
    }

    public function countPageSitemapVideo($limit) {
        $count = Post::find()
                        ->where(['Status' => 1])
                        ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                        ->andWhere(['IsDelete' => 0])
                        ->andWhere(['Post_Type' => 'VIDEO'])->orderBy("ID DESC")->count();
        return ceil($count / $limit);
    }

}
