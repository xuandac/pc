<?php

/*
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Sep 22, 2017, 9:16:21 AM. 
 * *********************************************
 */

namespace app\services;

use app\models\Categories;
use app\models\Menu;
use yii\db\Query;

Class CategoriesService {

    public function get_category_home($where = array(), $OrWhere = array(), $Limit = null, $orderBy = null) {

        $data_categories = Categories::find()
                ->where($where)
                ->orWhere($OrWhere)
                ->andWhere(['Status' => 1])
                ->orderBy($orderBy)
                ->asArray()
                ->all();

        $Array_Categories = array();
        foreach ($data_categories as $key => $value) {
            $ID = $value['ID'];
            $Data_categories = array(
                'ID' => $value['ID'],
                'Title' => $value['Title'],
                'Slug' => $value['Slug'],
                'Description' => $value['Description'],
                'ParentID' => $value['ParentID'],
                'Icon' => $value['Icon'],
                'Sub_categories' => array(),
                'ListPost' => array(),
                'ListVideo' => array(),
                'Tin_tieu_diem' => array(),
                'Tin_chuyen_nhuong'=>array(),
                'Menu_Category'=>array(),
                'Bxh_Category'=>array()
            );
            $sub_cat = $this->get_sub_categories($ID);
            array_push($Data_categories['Sub_categories'], $sub_cat['Sub_categories']);

            //----------End get sub-category-----------

            //----------Start get post-----------//
            $query = new Query();
            $Data_Post = $query->select([
                        'a.ID',
                        'b.CategoriesId',
                        'c.ID', 'c.Title', 'c.Summary', 'c.Slug', 'c.Thumb','c.Tags', 'c.Type',
                    ])->from('categories as a')
                    ->innerJoin('post_categories as b', 'a.ID = b.CategoriesId')
                    ->innerJoin('post as c', 'b.PostId = c.ID')
                    ->limit($Limit)
                    ->orderBy('c.ID DESC')
                    ->where(['a.ID' => $ID, 'c.Post_Type'=>'POST', 'c.Status' => 1, 'c.IsDelete' => 0])
                    ->andWhere(['<=', 'c.DatePublic', date('Y-m-d H:i:s')])
                    // ->asArray()            
                    ->all();

            array_push($Data_categories['ListPost'], $Data_Post);
            
            //---------------End Get-post-----------------
            
            //-------------Start get list video---------
             $query_video = new Query();
            $Data_Video = $query_video->select([
                        'a.ID',
                        'b.CategoriesId',
                        'c.ID', 'c.Title', 'c.Summary', 'c.Slug', 'c.Thumb','c.Tags', 'c.Type', //Table Post
                        'd.ID', 'd.Iframe','d.Video_File',
                    ])->from('categories as a')
                    ->innerJoin('post_categories as b', 'a.ID = b.CategoriesId')
                    ->innerJoin('post as c', 'b.PostId = c.ID')
                    ->innerJoin('video as d', 'c.ID = d.Post_Id')
                    ->limit(4)
                    ->orderBy('c.ID DESC')
                    ->where(['a.ID' => $ID, 'c.Post_Type'=>'VIDEO', 'c.Status' => 1, 'c.IsDelete' => 0])
                    ->andWhere(['<=', 'c.DatePublic', date('Y-m-d H:i:s')])
                    // ->asArray()            
                    ->all();
            array_push($Data_categories['ListVideo'], $Data_Video);
            
            //--------------End get Video--------------

            $Tin_Tieu_Diem = $this->get_post_f($ID, 3, ['c.Focus' => 1]);
            array_push($Data_categories['Tin_tieu_diem'], $Tin_Tieu_Diem);

            //----- Get tin chuyển nhượng
            $Tin_Chuyen_Nhuong = $this->get_post_chuyen_nhuong($sub_cat);
             array_push($Data_categories['Tin_chuyen_nhuong'], $Tin_Chuyen_Nhuong);
             
             
             //--------- Get menu category
             $Menu_Category = $this->get_menu_category(null,['StructureCode'=>$value['MenuCode']]);
              array_push($Data_categories['Menu_Category'], $Menu_Category[0]);
              
              
              //-------- Get bảng xếp hạng từng chuyên mục
              $Bxh = $this->get_bxh_category(1,['a.LeagueId'=>$value['LeagueId']]);
              array_push($Data_categories['Bxh_Category'], $Bxh[0]);
              
            array_push($Array_Categories, $Data_categories);
        }




        return array('data' => $Array_Categories);
    }
    public function get_menu_category($limit = null, $where = array()) {
        $query = Menu::find();
        /* $pagination = new Pagination([
          'defaultPageSize' => 2,
          'totalCount' => $query->count(),
          ]); */

        $data = $query->orderBy('id DESC')
                ->limit($limit)
                ->where($where)
                ->orderBy('Order ASC')
                /* ->andWhere(['IsDelete' => 0, 'Status' => 1])
                  ->andWhere(['<=', 'DatePublic', $date]) */
                ->asArray()
                ->all();
        return array($data);
    }
    
    public function get_bxh_category($limit=null,$where=array()){
        $query = new Query();
        $Data_League = $query->select([
                    'a.ID','a.Name',
                    'b.ID as SeasonID','b.StartTime as Season_StartTime', 'b.EndTime as Season_EndTime',
                  //  'c.ID', 'c.LeagueID', 'c.SeasonID', 'c.ST', 'c.Home_T', 'c.Home_H', 'c.Home_B', 'c.Home_TG','c.Home_TH',
                  //  'c.Away_T','c.Away_H','c.Away_B','c.Away_TG','c.Away_TH','c.HS','c.Point','c.Position',
                ])->from('soccer_league as a')
                ->innerJoin('soccer_season as b', 'a.ID = b.LeagueID')
               //->innerJoin('soccer_rank as c', 'b.ID = c.SeasonID')
                ->limit($limit)
                ->orderBy('b.StartTime DESC')
                ->where($where)                    
                ->one();
        
       $query_bxh = new Query(); 
      $Data_Bxh = $query_bxh->select([
                    'a.ID', 'a.LeagueID', 'a.SeasonID', 'a.ST', 'a.Home_T', 'a.Home_H', 'a.Home_B', 'a.Home_TG','a.Home_TH',
                    'a.Away_T','a.Away_H','a.Away_B','a.Away_TG','a.Away_TH','a.HS','a.Point','a.Position',
                   
                    'b.Name as NameTeam','b.Logo',       
                  
                ])->from('soccer_rank as a')                         
                ->innerJoin('team as b', 'a.Team_ID = b.AutoId')                      
                ->orderBy('a.Position ASC')
                ->where(['a.SeasonID'=>$Data_League['SeasonID']])
                //->andWhere(['<=', 'd.StartTime',$where_1])
                //->andWhere(['=>', 'd.StartTime',$where_2])
                // ->asArray()            
                ->all();
      $Data =array(
          'ID' =>$Data_League['ID'],
          'Name]' =>$Data_League['Name'],
          'SeasonID' => $Data_League['SeasonID'],
          'Season_StartTime' =>$Data_League['Season_StartTime'],
          'Season_EndTime' => $Data_League['Season_EndTime'],
          'Bxh'=>$Data_Bxh
      );     
        return array($Data);
    }

    public function get_sub_categories($ParentId) {
        $data_sub = Categories::find()
                        ->where(['Status' => 1, 'ParentID' => $ParentId])
                        ->asArray()->all();
        return array('Sub_categories' => $data_sub);
    }

    public function get_post_categories($Slug) {
        $query = new Query();
        $Data_Post = $query->select([
                    'a.ID',
                    'b.CategoriesId',
                    'c.ID', 'c.Title', 'c.Summary', 'c.Slug', 'c.Thumb', 'c.DateCreate'
                ])->from('categories as a')
                ->innerJoin('post_categories as b', 'a.ID = b.CategoriesId')
                ->innerJoin('post as c', 'b.PostId = c.ID')
                ->orderBy('c.ID DESC')
                ->where(['a.Slug' => $Slug, 'c.Status' => 1, 'c.IsDelete' => 0])
                ->andWhere(['<=', 'c.DatePublic', date('Y-m-d H:i:s')])
                // ->asArray()            
                ->all();
        return array('data' => $Data_Post);
    }

    public function get_post_f($Id_category, $limit = null, $where = array()) {
        $query = new Query();
        $Data_Post = $query->select([
                    'a.ID',
                    'b.CategoriesId',
                    'c.ID', 'c.Title', 'c.Summary', 'c.Slug', 'c.Thumb','c.Tags',
                ])->from('categories as a')
                ->innerJoin('post_categories as b', 'a.ID = b.CategoriesId')
                ->innerJoin('post as c', 'b.PostId = c.ID')
                ->limit($limit)
                ->orderBy('c.ID DESC')
                ->where($where)
                ->andwhere(['a.ID' => $Id_category, 'c.Post_Type'=>'POST', 'c.Status' => 1, 'c.IsDelete' => 0])
                ->andWhere(['<=', 'c.DatePublic', date('Y-m-d H:i:s')])
                // ->asArray()            
                ->all();
        return $Data_Post;
    }

    public function get_post_chuyen_nhuong($list_sub_category) {
//        echo '<xmp>';
//        print_r($list_sub_category);
//        echo '</xmp>';

        foreach ($list_sub_category['Sub_categories'] as $key => $value) {
            if (strpos($value['Title'], 'chuyển nhượng') == true) {
                $query = new Query();
                $Data_Post = $query->select([
                            'a.ID',
                            'b.CategoriesId',
                            'c.ID', 'c.Title', 'c.Summary', 'c.Slug', 'c.Thumb', 'c.Tags',
                        ])->from('categories as a')
                        ->innerJoin('post_categories as b', 'a.ID = b.CategoriesId')
                        ->innerJoin('post as c', 'b.PostId = c.ID')
                        ->limit(3)
                        ->orderBy('c.ID DESC')
                        ->where(['a.ID' => $value['ID'], 'c.Post_Type'=>'POST', 'c.Status' => 1, 'c.IsDelete' => 0])
                        ->andWhere(['<=', 'c.DatePublic', date('Y-m-d H:i:s')])
                         //->asArray();            
                        ->all();
                return $Data_Post;
            }
        }
    }
    
    
    public function get_cat_hot($limit=null, $where=array()){
         $data_categories = Categories::find()
              ->where(['CatHot'=>1,'Status' => 1])                             
              ->orderBy('OrderCatHot ASC')
                ->asArray()
                ->all();
          $Array_Categories = array();
        foreach ($data_categories as $key => $value) {
            $ID = $value['ID'];
            $Data_categories = array(
                'ID' => $value['ID'],
                'Title' => $value['Title'],
                'Slug' => $value['Slug'],
                'Description' => $value['Description'],
                'ParentID' => $value['ParentID'],
                'Icon' => $value['Icon'],              
                'ListPost' => array(),                
            );
            
            $query = new Query();
            $Data_Post = $query->select([
                        'a.ID',
                        'b.CategoriesId',
                        'c.ID', 'c.Title', 'c.Summary', 'c.Slug', 'c.Thumb',
                    ])->from('categories as a')
                    ->innerJoin('post_categories as b', 'a.ID = b.CategoriesId')
                    ->innerJoin('post as c', 'b.PostId = c.ID')
                    ->limit(4)
                    ->orderBy('c.ID DESC')
                    ->where(['a.ID' => $ID, 'c.Post_Type'=>'POST', 'c.Status' => 1, 'c.IsDelete' => 0])
                    ->andWhere(['<=', 'c.DatePublic', date('Y-m-d H:i:s')])
                    // ->asArray()            
                    ->all();

            array_push($Data_categories['ListPost'], $Data_Post);          
            array_push($Array_Categories, $Data_categories);
        }
          return array('data' => $Array_Categories);
    }
    
    public function get_category_detail($id){
        $query = Categories::find();
        /* $pagination = new Pagination([
          'defaultPageSize' => 2,
          'totalCount' => $query->count(),
          ]); */

        $data = $query       
                ->where(['ID'=>$id])               
                ->asArray()
                ->one();
        return array('data' => $data);
    }
    

}
