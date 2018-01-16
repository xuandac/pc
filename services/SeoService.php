<?php

/* 
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Jan 2, 2018, 11:03:45 AM. 
 * *********************************************
 */
namespace app\services;


use yii\web\View;
use app\models\IcSeo;
use app\services\PostService;

class SeoService 
{
    public function Ic_Seo( $where=array()){
    $data = IcSeo::find()
                ->where($where)                
                ->asArray()
                ->all();
    return array('Data_Seo' => $data);
    }
    
    
    public function Seo_Homepage(View $view, $Data_Seo)
    {
        $Config = \Yii::$app->params;   
       $Data = json_decode($Data_Seo[0]['SEO_Value'], true);
        //Standard meta
        $view->title=$Data['seo_title'];
       
        $view->registerMetaTag(['name' => 'robots', 'content' =>'index,follow,noydir,noodp']);
        $view->registerLinkTag(['rel' => "canonical", 'href' => $Config['site_domain'].$_SERVER['REQUEST_URI']]);
        $view->registerMetaTag(['name' => 'description', 'content' => $Data['seo_description']]);
        $view->registerMetaTag(['name' => 'keywords', 'content' =>$Data['seo_keyword'] ]);
        //Facebook open graph meta tag
       /* $view->registerMetaTag(['property' => 'fb:admins', 'content' => $fb_admin]);    
        $view->registerMetaTag(['property' => 'og:type', 'content' => $Seo_Default['og_type_index']]);
        $view->registerMetaTag(['property' => 'og:title', 'content' => $view->title]);
        $view->registerMetaTag(['property' => 'og:description', 'content' => $seo_tag['description_' . $lang]]);
        $view->registerMetaTag(['property' => 'og:url', 'content' => $url]);
        $view->registerMetaTag(['property' => 'og:site_name', 'content' => $site_name]);
		$view->registerMetaTag(['property' => 'og:author', 'content' =>'http://'.$_SERVER['SERVER_NAME']]);
        $view->registerMetaTag(['property'=>'og:image','content'=>$seo_img]);
        
        //Twitter Card meta tag
        $view->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary']);
        $view->registerMetaTag(['name' => 'twitter:url', 'content' => $url]);
        $view->registerMetaTag(['name' => 'twitter:title', 'content' => $view->title]);
        $view->registerMetaTag(['name' => 'twitter:description', 'content' => $seo_tag['description_' . $lang]]);
        $view->registerMetaTag(['name' => 'twitter:tag', 'content' => $seo_tag['keywords_' . $lang]]);
        $view->registerMetaTag(['name'=>'twttier:image','content'=> $seo_img]);*/
    }
    
    public function Seo_Category(View $view, $Data_category)
    {
         $Config = \Yii::$app->params;   
        $title = $Data_category['SEO_Title'];
       if($Data_category['SEO_Title'] ==''){
           $title = $Data_category['Title'];
       }
        //Standard meta
      // <meta http-equiv="refresh" content="5;url=http://example.com/" />
       //<link rel="next" href="http://xoso666.com/soi-cau-mb/page/2/" />
       $url = explode('?',$_SERVER['REQUEST_URI']);
       if(isset($url[1])){
       $page = explode('=', $url[1]);
       $number_page = $page[1]+1;
       }else{
        $number_page = 2;   
       }
       
        $view->title=$title;
          $view->registerMetaTag(['name' => 'robots', 'content' =>'index,follow,noydir,noodp']);
          $view->registerLinkTag(['rel' => "canonical", 'href' => $Config['site_domain'].$url[0]]);
           $view->registerLinkTag(['rel' => "next", 'href' => $Config['site_domain'].$url[0].'?page='.$number_page]);
        $view->registerMetaTag(['name' => 'description', 'content' => $Data_category['SEO_Description']]);
        $view->registerMetaTag(['name' => 'keywords', 'content' =>$Data_category['SEO_Keyword'] ]);
        //Facebook open graph meta tag
       /* $view->registerMetaTag(['property' => 'fb:admins', 'content' => $fb_admin]);    
        $view->registerMetaTag(['property' => 'og:type', 'content' => $Seo_Default['og_type_index']]);
        $view->registerMetaTag(['property' => 'og:title', 'content' => $view->title]);
        $view->registerMetaTag(['property' => 'og:description', 'content' => $seo_tag['description_' . $lang]]);
        $view->registerMetaTag(['property' => 'og:url', 'content' => $url]);
        $view->registerMetaTag(['property' => 'og:site_name', 'content' => $site_name]);
		$view->registerMetaTag(['property' => 'og:author', 'content' =>'http://'.$_SERVER['SERVER_NAME']]);
        $view->registerMetaTag(['property'=>'og:image','content'=>$seo_img]);
        
        //Twitter Card meta tag
        $view->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary']);
        $view->registerMetaTag(['name' => 'twitter:url', 'content' => $url]);
        $view->registerMetaTag(['name' => 'twitter:title', 'content' => $view->title]);
        $view->registerMetaTag(['name' => 'twitter:description', 'content' => $seo_tag['description_' . $lang]]);
        $view->registerMetaTag(['name' => 'twitter:tag', 'content' => $seo_tag['keywords_' . $lang]]);
        $view->registerMetaTag(['name'=>'twttier:image','content'=> $seo_img]);*/
    }
    
      public function Seo_Post(View $view, $Data_Post)
    {
       $Uty = new PostService();   
       
        $title = $Data_Post['SEO_Title'];
       if($Data_Post['SEO_Title'] ==''){
           $title = $Data_Post['Title'];
       }
       $SEO_Description = $Data_Post['SEO_Description'];
       if($Data_Post['SEO_Description'] ==''){
         $SEO_Description= $Uty->subStringv($Data_Post['Summary'], 250);  
       }
      
        //Standard meta
      // <meta http-equiv="refresh" content="5;url=http://example.com/" />
        $view->title=$title;
        if($Data_Post['SEO_Canonical'] != ''){
        $view->registerLinkTag(['rel' => "canonical", 'href' =>$Data_Post['SEO_Canonical']]);
        }
        $view->registerMetaTag(['name' => 'robots', 'content' =>'index,follow,noydir,noodp']);
        $view->registerMetaTag(['name' => 'description', 'content' => $SEO_Description]);
        $view->registerMetaTag(['name' => 'keywords', 'content' =>$Data_Post['SEO_Keywords'] ]);
        //Facebook open graph meta tag
       /* $view->registerMetaTag(['property' => 'fb:admins', 'content' => $fb_admin]);    
        $view->registerMetaTag(['property' => 'og:type', 'content' => $Seo_Default['og_type_index']]);
        $view->registerMetaTag(['property' => 'og:title', 'content' => $view->title]);
        $view->registerMetaTag(['property' => 'og:description', 'content' => $seo_tag['description_' . $lang]]);
        $view->registerMetaTag(['property' => 'og:url', 'content' => $url]);
        $view->registerMetaTag(['property' => 'og:site_name', 'content' => $site_name]);
		$view->registerMetaTag(['property' => 'og:author', 'content' =>'http://'.$_SERVER['SERVER_NAME']]);
        $view->registerMetaTag(['property'=>'og:image','content'=>$seo_img]);
        
        //Twitter Card meta tag
        $view->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary']);
        $view->registerMetaTag(['name' => 'twitter:url', 'content' => $url]);
        $view->registerMetaTag(['name' => 'twitter:title', 'content' => $view->title]);
        $view->registerMetaTag(['name' => 'twitter:description', 'content' => $seo_tag['description_' . $lang]]);
        $view->registerMetaTag(['name' => 'twitter:tag', 'content' => $seo_tag['keywords_' . $lang]]);
        $view->registerMetaTag(['name'=>'twttier:image','content'=> $seo_img]);*/
    }

   
}
