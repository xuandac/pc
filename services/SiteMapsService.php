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
                ->andWhere(['IsDelete'=>0])
                ->andWhere(['Post_Type'=>'POST'])->all();
    }
    public function sitemapVideo() {
        return Post::find()
                ->where(['Status' => 1])
                ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                ->andWhere(['IsDelete'=>0])
                ->andWhere(['Post_Type'=>'VIDEO'])->all();
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
                ->andWhere(['IsDelete'=>0])
                ->andWhere(['Post_Type'=>'POST'])
                ->limit($limit)->offset($offset)->all();
    }
    public function sitemapVideoPage($limit, $page) {
        $offset = ($page - 1) * $limit;
        return Post::find()
                ->where(['Status' => 1])
                ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                ->andWhere(['IsDelete'=>0])
                ->andWhere(['Post_Type'=>'VIDEO'])
                ->limit($limit)->offset($offset)->all();
    }

    public function countPageSitemapCategories($limit) {
        $count = Categories::find()->where(['Status' => 1])->count();
        return ceil($count / $limit);
    }

    public function countPageSitemapPost($limit) {
        $count = Post::find()
                ->where(['Status' => 1])
                ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                ->andWhere(['IsDelete'=>0])
                ->andWhere(['Post_Type'=>'POST'])->count();
        return ceil($count / $limit);
    }
    public function countPageSitemapVideo($limit) {
        $count = Post::find()
                ->where(['Status' => 1])
                ->andWhere(['<=', 'DatePublic', date("Y-m-d H:i:s")])
                ->andWhere(['IsDelete'=>0])
                ->andWhere(['Post_Type'=>'VIDEO'])->count();
        return ceil($count / $limit);
    }

}
