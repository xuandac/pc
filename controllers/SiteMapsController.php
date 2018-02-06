<?php

namespace app\controllers;

use yii\web\Controller;
use app\services\SiteMapsService;

class SiteMapsController extends Controller {

    private $sitemapService = null;

    public function __construct($id, $module, $config = array()) {
        $this->sitemapService = new SiteMapsService();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex() {
        $this->layout = false;
        $data['data'] = $this->sitemapService->findByKey('VFlQRQ');
        return $this->render('index', $data);
    }

    public function actionCategories() {
        $dataSiteMaps = $this->sitemapService->findByKey('VFlQRQ');
        $data = json_decode($dataSiteMaps['Value'], true);
        $result = [];
        $view = "";
        if ($data['categories_check_page'] == 1) {
            $limit = $data['categories_page'];
            $result['total_page'] = $this->sitemapService->countPageSitemapCategories($limit);
            $view = "categories";
        } else {
            $result['data'] = $this->sitemapService->sitemapCategories();
            $view = "categories-list";
        }
        return $this->render($view, $result);
    }

    public function actionCategoriesPage($page) {
        $dataSiteMaps = $this->sitemapService->findByKey('VFlQRQ');
        $data = json_decode($dataSiteMaps['Value'], true);
        $limit = $data['categories_page'];
        $result['data'] = $this->sitemapService->sitemapCategoriesPage($limit, $page);
        return $this->render('categories-list', $result);
    }

    public function actionPost() {
        $dataSiteMaps = $this->sitemapService->findByKey('VFlQRQ');
        $data = json_decode($dataSiteMaps['Value'], true);
        $result = [];
        $result['google_news'] = $data['post_check_gnews'];
        $view = "";
        if ($data['post_check_page'] == 1) {
            $limit = $data['post_page'];
            $result['total_page'] = $this->sitemapService->countPageSitemapPost($limit);
            $view = "post";
        } else {
            $result['data'] = $this->sitemapService->sitemapPost();
            $view = "post-list";
        }
        return $this->render($view, $result);
    }

    public function actionPostPage($page) {
        $dataSiteMaps = $this->sitemapService->findByKey('VFlQRQ');
        $data = json_decode($dataSiteMaps['Value'], true);
        $limit = $data['post_page'];
        $result['data'] = $this->sitemapService->sitemapPostPage($limit, $page);
        $result['google_news'] = $data['post_check_gnews'];
        return $this->render('post-list', $result);
    }

    public function actionPostGoogleNews() {
        $dataSiteMaps = $this->sitemapService->findByKey('VFlQRQ');
        $data = json_decode($dataSiteMaps['Value'], true);
        if ($data['post_check_gnews'] == 1) {
            $result['data'] = $this->sitemapService->sitemapPostGoogleNews(1000);
            return $this->render('post-list-google-news', $result);
        } else {
            die('Không hỗ trợ');
        }
    }

    public function actionVideo() {
        $dataSiteMaps = $this->sitemapService->findByKey('VFlQRQ');
        $data = json_decode($dataSiteMaps['Value'], true);
        $result = [];
        $result['google_news'] = $data['video_check_gnews'];
        $view = "";
        if ($data['video_check_page'] == 1) {
            $limit = $data['video_page'];
            $result['total_page'] = $this->sitemapService->countPageSitemapVideo($limit);
            $view = "video";
        } else {
            $result['data'] = $this->sitemapService->sitemapVideo();
            $view = "video-list";
        }
        return $this->render($view, $result);
    }

    public function actionVideoPage($page) {
        $dataSiteMaps = $this->sitemapService->findByKey('VFlQRQ');
        $data = json_decode($dataSiteMaps['Value'], true);
        $limit = $data['video_page'];
        $result['data'] = $this->sitemapService->sitemapVideoPage($limit, $page);
        $result['google_news'] = $data['video_check_gnews'];
        return $this->render('video-list', $result);
    }

    public function actionVideoGoogleNews() {
        $dataSiteMaps = $this->sitemapService->findByKey('VFlQRQ');
        $data = json_decode($dataSiteMaps['Value'], true);
        if ($data['video_check_gnews'] == 1) {
            $result['data'] = $this->sitemapService->sitemapVideoGoogleNews(1000);
            return $this->render('video-list-google-news', $result);
        } else {
            die("Không hỗ trợ.");
        }
    }

}
