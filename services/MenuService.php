<?php

/*
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Sep 22, 2017, 9:16:21 AM. 
 * *********************************************
 */

namespace app\services;

use Yii;
use app\models\Menu;
use yii\db\Query;

Class MenuService {

    public function get_menu($limit = null, $where = array()) {
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
        return array('data' => $data);
    }

    public function checkParent($data, $categorieID) {
        foreach ($data as $k => $item) {
            if ($item['ParentID'] == $categorieID) {
                return true;
            }
        }
        return false;
    }

    public function showMenu($menu, $id_parent = 0,$level=0) {
        $menu_tmp = array();
        foreach ($menu as $key => $item) {
            if ((int) $item['ParentID'] == (int) $id_parent) {
                $menu_tmp[] = $item;
                unset($menu[$key]);
            }
        }
        if ($menu_tmp) {
              $close_ul='';
            if($level == 0){
                echo '<ul>';
                $close_ul ='</ul>';
            }   
            if ($id_parent != 0) {
                echo '<ul>';               
            }
            
            $Config = Yii::$app->params;
            $Url_Media = $Config['media'];
            foreach ($menu_tmp as $key1 => $item) {        
                $http = substr($item['Link'], 0,7);
                $https = substr($item['Link'], 0,8);
                //echo $http.'--'.$https;
                if($http =='http://' || $https =='https://' || $item['Link'] =='#'){
                     $link = $item['Link'];
                }else{
                    $link = $Config['site_domain'].$item['Link'];
                   
                }
                
                    echo '<li>';
                    if($item['Icon'] !=''){
                        echo '<img class="icon-menu" src="'.$Url_Media.$item['Icon'].'" alt="icon-menu" />';
                    }
                    echo '<a href="' . $link. '" >' . $item['Name'];
                    if ($this->checkParent($menu, $item['ID'])) {
                        echo ' <i class="fa fa-caret-down" aria-hidden="true"></i>';
                    }
                    echo '</a>';
                    $this->showMenu($menu, $item['ID'], $level +=1);
                    echo '</li>';              
            }
            if ($id_parent != 0 ) {
                echo '</ul>';
            }
            echo  $close_ul;
            $level +=1;
        }
    }
    
     public function showMenu_footer($menu, $id_parent = 0, $level = 0) {
        $menu_tmp = array();
        foreach ($menu as $key => $item) {
            if ((int) $item['ParentID'] == (int) $id_parent) {
                $menu_tmp[] = $item;
                unset($menu[$key]);
            }
        }
        if ($menu_tmp) {
                
             $close_ul='';
            if($level == 0){
                echo '<ul class="list-link">';
                $close_ul ='</ul>';
            }   
            if ($id_parent != 0) {
                echo '<ul class="list-link">';
              
            }
            
            $Config = Yii::$app->params;
            $Url_Media = $Config['media'];
            foreach ($menu_tmp as $key1 => $item) {
                     $http = substr($item['Link'], 0,7);
                $https = substr($item['Link'], 0,8);                   
                     if($http =='http://' || $https =='https://' || $item['Link'] =='#'){
                     $link = $item['Link'];
                }else{
                    $link = $Config['site_domain'].$item['Link'];
                   
                }
                    echo '<li class="col-md-2">';
                    if($item['Icon'] !=''){
                        echo '<img class="icon-menu" src="'.$Url_Media.$item['Icon'].'" alt="icon-menu" />';
                    }
                    echo '<a href="' . $link . '" >' . $item['Name'];
                    if ($this->checkParent($menu, $item['ID'])) {
                        echo ' <i class="fa fa-caret-down" aria-hidden="true"></i>';
                    }
                    echo '</a>';
                    $this->showMenu_footer($menu, $item['ID'],  $level +=1);
                    echo '</li>';               
            }
            if ($id_parent != 0) {
                echo '</ul>';
            }
            echo $close_ul;
            $level +=1;
                    
        }
    }

    public function Menu_Mobile($data_cat, $id_parent = 0, $class = null, $sub_menu = 1) {

        $menu_tmp = array();

        foreach ($data_cat as $key => $item) {

            if ((int) $item->menu_item_parent == (int) $id_parent) {

                $menu_tmp[] = $item;

                unset($data_cat[$key]);
            }
        }

        if ($menu_tmp) {

            $class = 'sub-menu';

            if ($id_parent != 0) {

                echo '<ul class="sub-mn-mb sub-menu' . $sub_menu . '">';
            }



            //echo '<ul class="' . $class . '">';

            foreach ($menu_tmp as $key1 => $item) {

                $sub_menu += 1;

                if ($id_parent == 0) {

                    echo '<li><a href="' . $item->url . '"><i class="fa fa-cog" aria-hidden="true"></i>' . $item->title . '</a>';
                    if ($this->checkParent($data_cat, $item->ID)) {
                        echo '<i class="fa fa-caret-down item-mb" aria-hidden="true" data-target=".sub-menu' . $sub_menu . '"></i>';
                    }
                    $this->Menu_Mobile($data_cat, $item->ID, $class, $sub_menu);

                    echo '</li>';
                } else {

                    echo '<li>';

                    echo '<a href="' . $item->url . '"><i class="fa fa-angle-right" aria-hidden="true"></i>' . $item->title . '</a>';

                    $this->Menu_Mobile($data_cat, $item->ID, $class, $sub_menu);

                    echo '</li>';
                }
            }

            if ($id_parent != 0) {

                echo '</ul>';
            }
        }
    }

}
