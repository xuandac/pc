<?php
/*
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Sep 28, 2017, 2:01:27 PM. 
 * *********************************************
 */

use app\services\PostService;
use yii\web\View;
use app\services\SeoService;

$Config = Yii::$app->params;
$Url_Media = $Config['media'];
$Media_Video = $Config['media_video'];
$Service = new PostService();

$Data_Post = $Data['data'];
$Seo = new SeoService();
$Seo->Seo_Post($this, $Data_Post);
?>
<div id="box_panel1" class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="container-detail">
                            <div class="col-md-12">
                                <div class="top-detail clearfix">
                                    <?php
                                    $Day_Name = $Service->conver_date_vi('l',strtotime($Data_Post['DateCreate']));
                                    $date = date('d/m/Y', strtotime($Data_Post['DateCreate']));
                                    $time = date('H:i',strtotime($Data_Post['DateCreate']));
                                   
                                    ?>
                                    <time class="pull-lefft"><?= $Day_Name ?>, <?= $date ?> | <?=  $time ?></time>
                                    <ul class="list-extent pull-right">
                                        <li class="fb"><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                                        <li class="tw"><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                                        <li class="gp"><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                                        <li class="pr"><a href="#"><i class="fa fa-print" aria-hidden="true"></i></a></li>
                                        <li class="em"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>


                                <h1 class="name-post"><?= $Data_Post['Title'] ?></h1>
                                <ul class="list-tags">
                                    <li><a href="#">Liverpool</a></li>
                                    <li><a href="#">Chelsea</a></li>
                                </ul>


                            </div>
                            <!--<div class="col-md-12">
                                <div class="summary clear"><?= $Data_Post['Summary'] ?></div>                                
                            </div>
                            <div class="col-md-12">
                                <ul class="list-new-top">
                                    <?php foreach ($Data_Post_Tags as $key => $value) { ?>
                                        <li><a href="<?= $Service->makeUrl($value) ?>"><?= $value['Title'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>-->

                            <div class="col-md-12">
                                
                                <?php
                                if($Data_Post['Post_Type']=='VIDEO'){
                                    if($Data_Post['Iframe'] != null){
                                        echo '<div class="content-post">'.$Data_Post['Iframe'].'</div>';
                                    }else{
                                        if(substr($Data_Post['Video_File'],  0, 7)=='http://' || substr($Data_Post['Video_File'],  0, 8) =='https://'){
                                         echo '<div class="content-post"><video controls="" autoplay="" name="media"><source src="'.$Data_Post['Video_File'].'" type="video/mp4"></video></div>';   
                                        }else{
                                          echo '<div class="content-post"><video controls="" autoplay="" name="media"><source src="'.$Media_Video.$Data_Post['Video_File'].'" type="video/mp4"></video></div>';     
                                        }
                                    }
                                    
                                }
                                
                                ?>
                                <div class="content-post"><?= html_entity_decode($Data_Post['Content']) ?></div>
                            </div>
                            <section class="box-item-detail">
                                <div class="col-md-12">
                                    <div class="title-box-detail clearfix">
                                        <?php
                                         $Array_Tags = explode(',', $Data_Post['Tags']);
                                        ?>
                                        <h3>Tin liên quan <?= $Array_Tags[0]; ?></h3>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="list-item-top clearfix">
                                        <div class="row">

                                            <?php
                                               foreach ($Data_Post_Tieu_Diem_Top as $k_td=>$value_td){
                                                   $Img_td = json_decode($value_td['Thumb'],true);
                                                   if($k_td == 3){break;}
                                            ?>
                                            <div class="col-md-4">
                                                <div class="img">
                                                    <a href="<?= $Service->makeUrl($value_td);?>"><img src="<?= $Url_Media.$Img_td['size1']?>" alt="<?= $value_td['Title']?>"/></a>
                                                </div>
                                                <a href="<?= $Service->makeUrl($value_td);?>"><?= $value_td['Title']?></a>
                                            </div>
                                               <?php unset($Data_Post_Tieu_Diem_Top[$k_td]); } ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-post-box-detail">
                                         <?php
                                               foreach ($Data_Post_Tieu_Diem_Top as $k_td=>$value_td){
                                                   ?>
                                               
                                        <li><a href="<?= $Service->makeUrl($value_td);?>"><?= $value_td['Title']?> </a></li>
                                               <?php } ?>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="box-adv">
                                        <a href="#"><img src="/images/adv10.jpg"></a>
                                    </div>
                                </div>
                            </section>

                            <section class="box-item-detail">
                                <div class="col-md-12">
                                    <div class="title-box-detail clearfix">
                                        <h3>Tin sự kiện liên quan</h3>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="list-item-top clearfix">
                                        <div class="row">

                                            <?php
                                            foreach ($Data_Post_Tieu_Diem as $i => $index) {
                                                if ($i == 3) {
                                                    break;
                                                }
                                                $List_Img = json_decode($index['Thumb'], true);
                                                ?>
                                                <div class="col-md-4">
                                                    <div class="img">
                                                        <a href="<?= $Service->makeUrl($index) ?>"><img src="<?= $Url_Media . $List_Img['size1'] ?>"/></a>
                                                    </div>
                                                    <a href="<?= $Service->makeUrl($index) ?>"><?= $index['Title'] ?></a>
                                                </div>
                                                <?php
                                                unset($Data_Post_Tieu_Diem[$i]);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                              
                                foreach ($Data_Post_Tieu_Diem as $i => $index) {
                                    $List_Img = json_decode($index['Thumb'], true);
                                    ?>
                                    <div class="col-md-6 list-it">
                                        <div class="item-small">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href="<?= $Service->makeUrl($index) ?>"><img src="<?= $Url_Media . $List_Img['size1'] ?>"/></a>
                                                </div>
                                                <div class="col-md-8">
                                                    <a href="<?= $Service->makeUrl($index) ?>"><?= $index['Title'] ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>





                            </section>


                            <section class="box-item-detail">
                                <div class="col-md-12">
                                    <div class="title-box-detail clearfix">
                                        <?php
                                        if (strpos($Data_Post['NameCategories'], ',') !== false) {                                          
                                             $List_Category = explode(',', $Data_Post['NameCategories']);
                                             $Category = $List_Category[0];
                                        } else {
                                            $Category = $Data_Post['NameCategories'];
                                        }
                                        
                                        ?>
                                        <h3><?= $Category ?></h3>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="list-item-top clearfix">
                                        <div class="row">

                                            <?php
                                            foreach ($Data['data_same'] as $j => $item) {
                                                if ($j == 3) {
                                                    break;
                                                }
                                                $List_Img = json_decode($item['Thumb'], true);
                                                ?>
                                                <div class="col-md-4">
                                                    <div class="img">
                                                        <a href="<?= $Service->makeUrl($item) ?>"><img src="<?= $Url_Media . $List_Img['size1'] ?>"/></a>
                                                    </div>
                                                    <a href="<?= $Service->makeUrl($item) ?>"><?= $item['Title'] ?></a>
                                                </div>
                                                <?php
                                                unset($Data['data_same'][$j]);
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <?php
                                foreach ($Data['data_same'] as $j => $item) {
                                    $List_Img = json_decode($item['Thumb'], true);
                                    ?>
                                    <div class="col-md-6 list-it">
                                        <div class="item-small">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href="<?= $Service->makeUrl($item) ?>"><img src="<?= $Url_Media . $List_Img['size1'] ?>"/></a>
                                                </div>
                                                <div class="col-md-8">
                                                    <a href="<?= $Service->makeUrl($item) ?>"><?= $item['Title'] ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                <?php } ?>                   



                            </section>


                            <section class="box-item-detail">
                                <div class="col-md-12">
                                    <div class="title-box-detail clearfix">
                                        <h2>Video <?= $Category ?></h2>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="list-video-detail pull-left">
                                        <div class="row">
                                            <?php foreach ($Data['data_video_same'] as $k_v => $vl_v){
                                                 $Video_Img = json_decode($vl_v['Thumb'], true);
                                            
                                            ?>
                                            <div class="col-md-4 itemm-box-video">
                                                <div class="img-vd">
                                                    <a href="<?= $Service->makeUrl($vl_v);?>" class="play-video"><i class="fa fa-play-circle-o" aria-hidden="true"></i></a>
                                                    <a href="<?= $Service->makeUrl($vl_v);?>"><img src="<?= $Url_Media.$Video_Img['size1']?>" alt="<?= $vl_v['Title']?>"/></a>
                                                </div>
                                                <div class="caption-video">
                                                    <a href="<?= $Service->makeUrl($vl_v);?>"><?= $vl_v['Title']?></a> 
                                                   <!-- <p>(ICC 2017)</p>-->
                                                </div>
                                            </div>
                                            <?php } ?>
                                            
                                        </div>
                                    </div>
                                </div>


                            </section>
                        </div>












                    </div>

                </div>

                <div class="col-md-2 box-ltd">
                    <?php 
                    if(count($Most_View)>0){
                        $Img_m = json_decode($Most_View[0]['Thumb'],true);
                    ?>
                    <div class="row">
                        <div class="col-md-12 first-new">
                            <a href="<?= $Service->makeUrl($Most_View[0])?>">
                                <img src="<?= $Url_Media.$Img_m['size0'] ?>">
                            </a>
                            <h3><a href="<?= $Service->makeUrl($Most_View[0])?>"><?= $Most_View[0]['Title']?></a></h3>
                            
                        </div>						

                    </div>
                    <?php unset($Most_View[0]); } ?>

                    <ul class="list-first-new">
                        <?php foreach ($Most_View as $i_m=>$item_m){?>
                        <li><a href="<?= $Service->makeUrl($item_m);?>"><?= $item_m['Title']?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="box-adv adv2">
                        <a href="#"><img src="images/adv7.png"/></a>
                    </div>

                </div>





            </div>
        </div>
        <?php echo $this->render('/element/slidebar'); ?>
    </div>

</div> 
