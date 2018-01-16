<?php

/* 
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Sep 28, 2017, 1:59:10 PM. 
 * *********************************************
 */
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;


use app\services\PostService;
use app\services\CategoriesService;
class CategoriesPostController extends Controller
{
 public function actionIndex($slug=null,$id)
    {
    
        $Service_Post = new PostService();
        $Category_Service = new CategoriesService();
        $Data_Hot_Cat = $Service_Post->get_post_hot_categories($id);
        $Data_Post_cat = $Service_Post->get_post_categories($id,['a.Post_Type'=>'POST']);
        $Data_Video_Cat = $Service_Post->get_post_categories($id, ['a.Post_Type'=>'VIDEO'], 3);
        $Most_View = $Service_Post->get_most_view();
        $Data_category= $Category_Service->get_category_detail($id);
//     echo '<xmp>';
//     print_r($Data_category);
//     die;
        
       
        return $this->render('index',[
            'Data_Category'=>$Data_category['data'],
            'Data_Hot'=>$Data_Hot_Cat['data'],
            'Data_Post_cat'=>$Data_Post_cat['data'],
            'Data_Video_Cat'=>$Data_Video_Cat['data'],
            'pagination'=>$Data_Post_cat['pagination'],
            'Most_View'=>$Most_View['data']
        ]);
    }
    public function actionViewPost($slug){
      
         $Service_Post = new PostService();
         $Data_Post = $Service_Post->view_post($slug);
         $id_post = $Data_Post['data']['ID'];
        
         $Service_Post->UpdateView($id_post, $Data_Post['data']['View']+1);
         
        $Array_Tags = explode(',', $Data_Post['data']['Tags']);
        $Array_Key_Word = explode(',', $Data_Post['data']['SEO_Keywords']);
        $Data_Post_Tags = $Service_Post->get_post_tags($id_post, $Array_Tags);
        $Data_Post_Tieu_Diem = $Service_Post->get_post_tieu_diem_lq($id_post, $Array_Key_Word, 'SEO_Keywords',['Post_Type'=>'POST']);
        $Data_Post_Tieu_Diem_Top = $Service_Post->get_post_tieu_diem_lq($id_post, $Array_Tags, 'Tags',['Post_Type'=>'POST']);
         
          $Most_View = $Service_Post->get_most_view();
//          echo '<xmp>';
//         print_r($Data_Post);die;
        return $this->render('view-post',[
            'Data'=>$Data_Post,
            'Data_Post_Tags'=>$Data_Post_Tags['data'],
            'Data_Post_Tieu_Diem'=>$Data_Post_Tieu_Diem['data'],
            'Data_Post_Tieu_Diem_Top'=>$Data_Post_Tieu_Diem_Top['data'],
            'Most_View'=>$Most_View['data']
        ]);
    }
    
    public function actionTagPost(){
        $request = Yii::$app->request;
        $Tag = $request->get('key');
        
        $Service = new PostService();
        $Data_Tag = $Service->get_all_post_tags($Tag);
         $Most_View = $Service->get_most_view();
        //echo '<xmp>';
       // print_r($Data_Tag);die;
        return $this->render('tag-post',[
            'Data_Tag'=>$Data_Tag['data'],
            'pagination'=>$Data_Tag['pagination'],
            'Most_View'=>$Most_View['data']
        ]);
    }
    
    
    //Lây tin nổi bật
    public function actionNewFeature($alias){
         $Service_Post = new PostService();
         if($alias =='trong-nuoc'){
             $type = 1;
         }elseif($alias =='quoc-te'){
             $type = 0;
         }
         $Data_Feature = $Service_Post->get_post_page(['a.Type'=>$type, 'FeaturedNews'=>1,]);
         $Most_View = $Service_Post->get_most_view();
//         echo '<xmp>';
//         print_r($Data_Feature);
         return $this->render('new-feature',[
           'Data_Feature'=>$Data_Feature['data'],
           'pagination'=>$Data_Feature['pagination'],  
            'Most_View'=>$Most_View['data']
             
         ]);
    } 
    
    
    //Lấy tin mới
    public function actionNew($alias=null){
          $Service_Post = new PostService();
         if($alias =='trong-nuoc'){            
             $where = ['a.Type'=>1];
         }elseif($alias =='quoc-te'){
              $where = ['a.Type'=>0];
         }else{
              $where = [];
         }
       
         $Data = $Service_Post->get_post_page($where);
         $Most_View = $Service_Post->get_most_view();
          return $this->render('new',[
           'Data'=>$Data['data'],
           'pagination'=>$Data['pagination'],  
            'Most_View'=>$Most_View['data']
             
         ]);
    }
}
