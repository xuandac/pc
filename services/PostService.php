<?php

/*
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Sep 22, 2017, 9:16:41 AM. 
 * *********************************************
 */

namespace app\services;

use app\models\Post;
use yii\db\Expression;
use yii\db\Query;
use yii\data\Pagination;

class PostService {

    public function get_post($limit = null, $where) {
        $date = date('Y-m-d H:i:s');
        $query = Post::find();
        /* $pagination = new Pagination([
          'defaultPageSize' => 2,
          'totalCount' => $query->count(),
          ]); */

        $data = $query->orderBy('id DESC')
                ->limit($limit)
                ->where($where)
                ->andWhere(['IsDelete' => 0, 'Status' => 1])
                ->andWhere(['<=', 'DatePublic', $date])
                ->asArray()
                ->all();
        return array('data' => $data);
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
                    'a.SEO_Canonical','a.SEO_301',
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

    public function UpdateView($id_post, $View) {
        $Find_Data = Post::findOne($id_post);
        @$Find_Data->View = @$View;
        $Find_Data->update();
    }

    public static function makeUrl($data_post, $full = false) {
        $name_post = $data_post['Title'];
        $url = \Yii::$app->params['site_domain'].'/'. (isset($data_post['Slug']) ? $data_post['Slug'] : self::makeAlias($name_post));

        if ($full)
            $url =  \Yii::$app->params['site_domain'].'/' . $url;
        return $url;
    }

    public static function makeUrl_Categoies($data_post, $full = false) {

        $name_post = $data_post['Title'];
        $url = \Yii::$app->params['site_domain'].'/' . (isset($data_post['Slug']) && $data_post['Slug'] != '' ? $data_post['Slug'] . '-c' . $data_post['ID'] : self::makeAlias($name_post) . '-c' . $data_post['ID']);

        if ($full)
            $url = \Yii::$app->params['site_domain'].'/' . $url;
        return $url;
    }

    public static function makeUrlTag($TagName, $full = false) {
        //$name_post = $data_post['Title'];
        $url = \Yii::$app->params['site_domain'].'/tag/' . self::makeAlias($TagName) . '?key=' . $TagName;
        //$url = '/?tag=' . $TagName;

        if ($full)
            $url =  \Yii::$app->params['site_domain'].'/' . $url;
        return $url;
    }

    public static function makeAlias($str, $lowerCase = true) {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $str = preg_replace($search, $replace, $str);
        $str = preg_replace('/(-)+/', '-', $str);
        if ($lowerCase)
            $str = strtolower($str);
        return $str;
    }

    function subStringv($str, $len) {

        //$str = html_entity_decode($str, ENT_QUOTES, $charset='UTF-8');

        if (strlen($str) > $len) {

            $arr = explode(' ', $str);

            $str = substr($str, 0, $len);

            $arrRes = explode(' ', $str);

            $last = $arr[count($arrRes) - 1];

            unset($arr);

            if (strcasecmp($arrRes[count($arrRes) - 1], $last)) {

                unset($arrRes[count($arrRes) - 1]);
            }

            return implode(' ', $arrRes) . "...";
        }

        return $str;
    }

    function conver_date_vi($format, $time = 0, $debug=false) {
        if (!$time)
            $time = time();

        $lang = array();
        $lang['sunday'] = 'Chủ nhật';
        $lang['monday'] = 'Thứ hai';
        $lang['tuesday'] = 'Thứ ba';
        $lang['wednesday'] = 'Thứ tư';
        $lang['thursday'] = 'Thứ năm';
        $lang['friday'] = 'Thứ sáu';
        $lang['saturday'] = 'Thứ bảy';
        if($debug = true){
            $lang['sunday'] = 'Chủ nhật';
        $lang['monday'] = 'Thứ 2';
        $lang['tuesday'] = 'Thứ 3';
        $lang['wednesday'] = 'Thứ 4';
        $lang['thursday'] = 'Thứ 5';
        $lang['friday'] = 'Thứ 6';
        $lang['saturday'] = 'Thứ 7';
        }
        
        $lang['sun'] = 'CN';
        $lang['mon'] = 'T2';
        $lang['tue'] = 'T3';
        $lang['wed'] = 'T4';
        $lang['thu'] = 'T5';
        $lang['fri'] = 'T6';
        $lang['sat'] = 'T7';      
        $lang['january'] = 'Tháng Một';
        $lang['february'] = 'Tháng Hai';
        $lang['march'] = 'Tháng Ba';
        $lang['april'] = 'Tháng Tư';
        $lang['may'] = 'Tháng Năm';
        $lang['june'] = 'Tháng Sáu';
        $lang['july'] = 'Tháng Bảy';
        $lang['august'] = 'Tháng Tám';
        $lang['september'] = 'Tháng Chín';
        $lang['october'] = 'Tháng Mười';
        $lang['november'] = 'Tháng M. một';
        $lang['december'] = 'Tháng M. hai';
        $lang['jan'] = 'T01';
        $lang['feb'] = 'T02';
        $lang['mar'] = 'T03';
        $lang['apr'] = 'T04';
        $lang['may2'] = 'T05';
        $lang['jun'] = 'T06';
        $lang['jul'] = 'T07';
        $lang['aug'] = 'T08';
        $lang['sep'] = 'T09';
        $lang['oct'] = 'T10';
        $lang['nov'] = 'T11';
        $lang['dec'] = 'T12';

        $format = str_replace("r", "D, d M Y H:i:s O", $format);
        $format = str_replace(array("D", "M"), array("[D]", "[M]"), $format);
        $return = date($format, $time);

        $replaces = array(
            '/\[Sun\](\W|$)/' => $lang['sun'] . "$1",
            '/\[Mon\](\W|$)/' => $lang['mon'] . "$1",
            '/\[Tue\](\W|$)/' => $lang['tue'] . "$1",
            '/\[Wed\](\W|$)/' => $lang['wed'] . "$1",
            '/\[Thu\](\W|$)/' => $lang['thu'] . "$1",
            '/\[Fri\](\W|$)/' => $lang['fri'] . "$1",
            '/\[Sat\](\W|$)/' => $lang['sat'] . "$1",
            '/\[Jan\](\W|$)/' => $lang['jan'] . "$1",
            '/\[Feb\](\W|$)/' => $lang['feb'] . "$1",
            '/\[Mar\](\W|$)/' => $lang['mar'] . "$1",
            '/\[Apr\](\W|$)/' => $lang['apr'] . "$1",
            '/\[May\](\W|$)/' => $lang['may2'] . "$1",
            '/\[Jun\](\W|$)/' => $lang['jun'] . "$1",
            '/\[Jul\](\W|$)/' => $lang['jul'] . "$1",
            '/\[Aug\](\W|$)/' => $lang['aug'] . "$1",
            '/\[Sep\](\W|$)/' => $lang['sep'] . "$1",
            '/\[Oct\](\W|$)/' => $lang['oct'] . "$1",
            '/\[Nov\](\W|$)/' => $lang['nov'] . "$1",
            '/\[Dec\](\W|$)/' => $lang['dec'] . "$1",
            '/Sunday(\W|$)/' => $lang['sunday'] . "$1",
            '/Monday(\W|$)/' => $lang['monday'] . "$1",
            '/Tuesday(\W|$)/' => $lang['tuesday'] . "$1",
            '/Wednesday(\W|$)/' => $lang['wednesday'] . "$1",
            '/Thursday(\W|$)/' => $lang['thursday'] . "$1",
            '/Friday(\W|$)/' => $lang['friday'] . "$1",
            '/Saturday(\W|$)/' => $lang['saturday'] . "$1",
            '/January(\W|$)/' => $lang['january'] . "$1",
            '/February(\W|$)/' => $lang['february'] . "$1",
            '/March(\W|$)/' => $lang['march'] . "$1",
            '/April(\W|$)/' => $lang['april'] . "$1",
            '/May(\W|$)/' => $lang['may'] . "$1",
            '/June(\W|$)/' => $lang['june'] . "$1",
            '/July(\W|$)/' => $lang['july'] . "$1",
            '/August(\W|$)/' => $lang['august'] . "$1",
            '/September(\W|$)/' => $lang['september'] . "$1",
            '/October(\W|$)/' => $lang['october'] . "$1",
            '/November(\W|$)/' => $lang['november'] . "$1",
            '/December(\W|$)/' => $lang['december'] . "$1");

        return preg_replace(array_keys($replaces), array_values($replaces), $return);
    }

}
