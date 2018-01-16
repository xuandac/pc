<?php

/*
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Sep 22, 2017, 9:16:41 AM. 
 * *********************************************
 */

namespace app\services;

use app\models\SoccerMatch;
use yii\db\Expression;
use yii\db\Query;
use yii\data\Pagination;

class SoccerMathService {

    public function get_ltd_kq($limit=null,$where=array()) {
        $query = new Query();
        $Data_Match = $query->select([
                    'a.ID', 'a.MatchId', 'a.HomeId', 'a.AWayId', 'a.Score', 'a.StartTime', 'a.Status', 'a.LeagueId','a.Vong',
                    'b.Name as NameLeague',
                    'c.Name as NameHome', 'c.Logo as HomeLogo',
                     'd.Name as NameAWay', 'd.Logo as AWayLogo',
                     'e.StartTime as Season_StartTime', 'e.EndTime as Season_EndTime'
                ])->from('soccer_match as a')
                ->innerJoin('soccer_league as b', 'a.LeagueId = b.LeagueId')               
                ->innerJoin('team as c', 'a.HomeId = c.ID')
                ->innerJoin('team as d', 'a.AWayId = d.ID')     
                ->innerJoin('soccer_season as e', 'a.SeasonId = e.SeasonID')
                ->limit($limit)
               // ->groupBy('a.ID')
                ->orderBy('a.ID DESC')
                ->where($where)
               // ->andWhere(['<=', 'a.DatePublic', date('Y-m-d H:i:s')])
                // ->asArray()            
                ->all();

        return array('data' => $Data_Match);
    }

    public function get_post_page($where) {

        $query = new Query();
        $query->select([
                    'a.ID', 'a.Title', 'a.Summary', 'a.Slug', 'a.Thumb', 'a.DateCreate', 'a.Tags',
                ])->from('post as a')
                ->orderBy('a.ID DESC')
                ->where(['a.Post_Type' => 'POST', 'a.Status' => 1, 'a.IsDelete' => 0])
                ->andWhere($where)
                ->andWhere(['<=', 'a.DatePublic', date('Y-m-d H:i:s')]);
        //->all();
        $pagination = new Pagination([
            'defaultPageSize' => 19,
            'totalCount' => $query->count()
        ]);
        $Data_Post = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return array('data' => $Data_Post, 'pagination' => $pagination);
    }

    public function get_post_hot_categories($id_categories) {
        $query = new Query();
        $Data_Post = $query->select([
                    'a.ID', 'a.Title', 'a.Summary', 'a.Slug', 'a.Thumb', 'a.DateCreate', 'a.Tags',
                    'b.CategoriesId',
                    'c.ID as Cat_Id',
                ])->from('post as a')
                ->innerJoin('post_categories as b', 'a.ID = b.PostId')
                ->innerJoin('categories as c', 'b.CategoriesId = c.ID')
                ->limit(7)
                ->orderBy('a.ID DESC')
                ->where(['c.ID' => $id_categories, 'a.hot' => 1, 'a.Status' => 1, 'a.IsDelete' => 0])
                ->andWhere(['<=', 'a.DatePublic', date('Y-m-d H:i:s')])
                // ->asArray()            
                ->all();

        return array('data' => $Data_Post);
    }

    public function get_post_categories($id_categories, $where = [], $limit = 12) {
        $Data_Hot = $this->get_post_hot_categories($id_categories);
        $Array_Id_hot = [];
        foreach ($Data_Hot['data'] as $key => $value) {
            array_push($Array_Id_hot, $value['ID']);
        }

        $query = new Query();
        $query->select([
                    'a.ID', 'a.Title', 'a.Summary', 'a.Slug', 'a.Thumb', 'a.DateCreate', 'a.Tags',
                    'b.CategoriesId',
                    'c.ID',
                ])->from('post as a')
                ->innerJoin('post_categories as b', 'a.ID = b.PostId')
                ->innerJoin('categories as c', 'b.CategoriesId = c.ID')
                ->orderBy('a.ID DESC')
                ->where(['c.ID' => $id_categories, 'a.Status' => 1, 'a.IsDelete' => 0])
                ->andWhere($where)
                ->andWhere(['not in', 'a.ID', $Array_Id_hot])
                ->andWhere(['<=', 'a.DatePublic', date('Y-m-d H:i:s')]);
        //->all();
        $pagination = new Pagination([
            'defaultPageSize' => $limit,
            'totalCount' => $query->count()
        ]);
        $Data_Post = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return array('data' => $Data_Post, 'pagination' => $pagination);
    }

    public function view_post($slug) {
        $date = date('Y-m-d H:i:s');
        $query = new Query();
        $Data_Post = $query->select([
                    'a.ID', 'a.Title', 'a.Summary', 'a.Content', 'a.Slug', 'a.Thumb', 'a.Tags', 'a.DateCreate',
                    'a.Type', 'a.Post_Type', 'a.SEO_Title', 'a.SEO_Description', 'a.SEO_Keywords', 'a.SEO_Canonical', 'a.View',
                    'b.CategoriesID', 'GROUP_CONCAT(b.CategoriesID SEPARATOR ",") AS CategoriesId',
                    'GROUP_CONCAT(c.Title SEPARATOR ",") AS NameCategories',
                    'd.Iframe', 'd.Video_File',
                ])->from('post as a')
                ->leftJoin('post_categories as b', 'a.ID = b.PostId')
                ->leftJoin('categories as c', 'b.CategoriesID = c.ID')
                ->leftJoin('video as d', 'a.ID = d.Post_Id')
                ->where(['a.Slug' => $slug, 'a.Status' => 1, 'a.IsDelete' => 0])
                ->andWhere(['<=', 'a.DatePublic', $date])
                // ->groupBy(['b.PostId'])
                // ->asArray()
                ->one();
        $Data_same = $this->get_post_same($Data_Post, 9, ['a.Post_Type' => 'POST']);
        $Data_video_same = $this->get_post_same($Data_Post, 3, ['a.Post_Type' => 'VIDEO']);

        return array('data' => $Data_Post, 'data_same' => $Data_same, 'data_video_same' => $Data_video_same);
    }

    public function get_most_view() {
        $date = date('Y-m-d H:i:s');
        $query = new Query();
        $Data_Post = $query->select([
                    'a.ID', 'a.Title', 'a.Summary', 'a.Content', 'a.Slug', 'a.Thumb', 'a.Tags', 'a.DateCreate',
                    'a.SEO_Title', 'a.SEO_Description', 'a.SEO_Keywords', 'a.SEO_Canonical', 'a.View',
                    'b.CategoriesID', 'GROUP_CONCAT(b.CategoriesID SEPARATOR ",") AS CategoriesId',
                    'GROUP_CONCAT(c.Title SEPARATOR ",") AS NameCategories',
                ])->from('post as a')
                ->leftJoin('post_categories as b', 'a.ID = b.PostId')
                ->leftJoin('categories as c', 'b.CategoriesID = c.ID')
                ->where(['a.Status' => 1, 'a.IsDelete' => 0])
                ->andWhere(['<=', 'a.DatePublic', $date])
                ->limit(5)
                ->orderBy('View DESC')
                ->groupBy(['b.PostId'])
                // ->asArray()
                ->all();

        return array('data' => $Data_Post,);
    }

    public function get_post_same($Data_Post, $limit = null, $where = []) {
        $Array_Cat = explode(',', $Data_Post['CategoriesID']);

        $query = new Query();
        $Data = $query->select([
                    'a.ID', 'a.Title', 'a.Summary', 'a.Slug', 'a.Thumb', 'a.DateCreate'
                ])->from('post as a')
                ->innerJoin('post_categories as b', 'a.ID = b.PostId')
                ->innerJoin('categories as c', 'b.CategoriesId = c.ID')
                ->limit($limit)
                ->orderBy('a.ID DESC')
                ->where(['c.ID' => $Array_Cat[0], 'a.Status' => 1, 'a.IsDelete' => 0])
                ->andWhere($where)
                ->andWhere(['<=', 'a.DatePublic', date('Y-m-d H:i:s')])
                // ->asArray()            
                ->all();
        return $Data;
    }

    public function get_post_tieu_diem_lq($id_post = null, $array_tags = array(), $like, $where = []) {
        $date = date('Y-m-d H:i:s');
        $query = Post::find();
        /* $pagination = new Pagination([
          'defaultPageSize' => 2,
          'totalCount' => $query->count(),
          ]); */
        if (count($array_tags) > 0) {
            foreach ($array_tags as $value) {
                $query->Where(['like', $like, $value]);
            }
        }
        $query->orderBy(new Expression('rand()'))
                ->limit(9)
                ->andWhere($where)
                ->andWhere(['!=', 'ID', $id_post])
                ->andWhere(['Status' => 1, 'IsDelete' => 0,])
                ->andWhere(['<=', 'DatePublic', $date]);

        $data = $query->asArray()->all();
        return array('data' => $data);
    }

    public function get_post_tags($id_post = null, $array_tags = array()) {
        $date = date('Y-m-d H:i:s');
        $query = Post::find();
        /* $pagination = new Pagination([
          'defaultPageSize' => 2,
          'totalCount' => $query->count(),
          ]); */
        if (count($array_tags) > 0) {
            foreach ($array_tags as $value) {
                $query->orWhere(['like', 'Tags', $value]);
            }
        }
        $query->orderBy(new Expression('rand()'))
                ->limit(3)
                ->andWhere(['!=', 'ID', $id_post])
                ->andWhere(['Status' => 1, 'IsDelete' => 0,])
                ->andWhere(['<=', 'DatePublic', $date]);

        $data = $query->asArray()->all();
        return array('data' => $data);
    }

    public function get_all_post_tags($tags) {
        $date = date('Y-m-d H:i:s');
        $query = Post::find();
        /* $pagination = new Pagination([
          'defaultPageSize' => 2,
          'totalCount' => $query->count(),
          ]); */

        $query->where(['like', 'Tags', $tags])
                ->andWhere(['Status' => 1, 'IsDelete' => 0,])
                ->andWhere(['<=', 'DatePublic', $date]);

        $pagination = new Pagination([
            'defaultPageSize' => 15,
            'totalCount' => $query->count()
        ]);
        $Data_Post = $query->offset($pagination->offset)
                        ->limit($pagination->limit)
                        ->asArray()->all();

        return array('data' => $Data_Post, 'pagination' => $pagination);
    }

  
}
