<?php
/*
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Oct 2, 2017, 9:28:32 AM. 
 * *********************************************
 */
use app\services\PostService;
use app\services\CategoriesService;
$Config = Yii::$app->params;
$Url_Media = $Config['media'];
$Post_Service = new PostService();
$Tin_Trong_Nuoc =  $Post_Service->get_post(4,['Post_Type'=>'POST','Type'=>1 ]);
 
$Categories_Service = new CategoriesService();
$Cat_Hot = $Categories_Service->get_cat_hot();

$Get_Video = $Post_Service->get_post(7,['Post_Type'=>'VIDEO']);

?>
<div class="col-md-3 slidebar-left">


    <div class="box-adv adv-4">
        <a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/cm1.jpg"/></a>
    </div>
    <div class="row">
        <div class="col-sm-12 title-slidebar">
            <a href="#">Video</a>
        </div>
        
        <?php
        if(count($Get_Video['data']) >0){
            $img_vd = json_decode($Get_Video['data'][0]['Thumb'], true);
        ?>
        <div class="col-sm-12">
            <div class="top-video-slidebar class">
                <a href="<?= $Post_Service->makeUrl($Get_Video['data'][0]); ?>">
                    <img src="<?= $Url_Media.$img_vd['size1'] ?>" alt="<?= $Get_Video['data'][0]['Title']?>"/>
                </a>
                <span class="icon-video">
                    <img src="<?= Yii::$app->params['site_domain']?>/images/ic-vd1.png" />
                    live
                </span>
                <a href="<?= $Post_Service->makeUrl($Get_Video['data'][0]); ?>"><?= $Get_Video['data'][0]['Title']?></a>
            </div>
        </div>
        <?php unset($Get_Video['data'][0]);} ?>
        <div class="col-sm-12">
            <div class="slide-video-slidebar owl-carousel owl-theme" data-items="2" data-nav="false" data-dots="true" data-loop="false" data-margin="15">
            <?php
            foreach ($Get_Video['data'] as $i=>$item){
                $Img_VD = json_decode($item['Thumb'],true);
            ?>
                <div class="item">
                    <a href="<?= $Post_Service->makeUrl($item);?>">
                        <img src="<?= $Url_Media.$Img_VD['size1']?>"/>
                        <span><?= $item['Title']?></span>
                    </a>
                </div>
            <?php } ?> 
            </div>
        </div>

    </div>

    <?php 
    foreach ($Cat_Hot['data'] as $key_cat=>$value_cat){    
         $Data_Post_Cat = $value_cat['ListPost'][0];
    ?>
    <div class="row">
        <div class="col-sm-12 title-slidebar">
            <h2><a href="<?= $Post_Service->makeUrl_Categoies($value_cat)?>"><?= $value_cat['Title']?></a></h2>
        </div>
        <div class="col-sm-12">
            <?php 
            if(count($Data_Post_Cat) > 0){                
        $Img_Post = json_decode($Data_Post_Cat[0]['Thumb'],true);
                ?>
            <div class="item-top-slidebar clear">
                <a href="<?= $Post_Service->makeUrl($Data_Post_Cat[0])?>"><?= $Data_Post_Cat[0]['Title'];?>  </a>
                <div class="row">
                    <div class="col-sm-6 img-post-slidebar">
                        <a href="<?= $Post_Service->makeUrl($Data_Post_Cat[0])?>">
                            <img src="<?= $Url_Media.$Img_Post['size0']?>" />
                        </a>
                    </div>
                    <div class="col-sm-6 shot-des">
                        <p><?= $Post_Service->subStringv($Data_Post_Cat[0]['Summary'], 100)?></p>
                    </div>
                </div>
            </div>
            <?php unset($Data_Post_Cat[0]); } ?>

            <ul class="list-item-slidebar">
                <?php foreach ($Data_Post_Cat as $i_post=>$iten_post){?>
                <li><a href="<?= $Post_Service->makeUrl($iten_post)?>"><?= $iten_post['Title']?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php } ?>

    
    <div class="box-adv adv-4">
        <a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/cm3.jpg"/></a>
    </div>
    <div class="row">
        <div class="col-sm-12 title-slidebar">
            <a href="#">Tin trong nước</a>
        </div>
        <div class="col-sm-12">
            <?php
            if(count($Tin_Trong_Nuoc['data'])>0){
                $Img_tn = json_decode($Tin_Trong_Nuoc['data'][0]['Thumb'],true);
            ?>
            <div class="item-top-slidebar clear">
                <a href="<?= $Post_Service->makeUrl($Tin_Trong_Nuoc['data'][0]);?>"><?= $Tin_Trong_Nuoc['data'][0]['Title']?> </a>
                <div class="row">
                    <div class="col-sm-6 img-post-slidebar">
                        <a href="<?= $Post_Service->makeUrl($Tin_Trong_Nuoc['data'][0]);?>">
                            <img src="<?= $Url_Media.$Img_tn['size0']?>" />
                        </a>
                    </div>
                    <div class="col-sm-6 shot-des">
                        <p><?= $Post_Service->subStringv($Tin_Trong_Nuoc['data'][0]['Summary'] ,100)?></p>
                    </div>
                </div>
            </div>
            <?php unset($Tin_Trong_Nuoc['data'][0]); } ?>

            <ul class="list-item-slidebar">
                <?php foreach ($Tin_Trong_Nuoc['data'] as $i=>$item){?>
                <li><a href="<?= $Post_Service->makeUrl($item) ?>"><?= $item['Title']?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 title-slidebar">
            <span>Các đội bóng</span>
        </div>
        <div class="col-sm-12">
            <select class="form-control select-team">
                <option>Laliga</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
            <div class="row">
                <div class="col-sm-6">
                    <div class="item-team">
                        <a href="#">
                            <img src="<?= Yii::$app->params['site_domain']?>/images/logo-mu.png" />
                            Mancheter United
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item-team">
                        <a href="#">
                            <img src="<?= Yii::$app->params['site_domain']?>/images/logo-chs.png" />
                            Chelsea
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item-team">
                        <a href="#">
                            <img src="<?= Yii::$app->params['site_domain']?>/images/logo-mu.png" />
                            Mancheter United
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item-team">
                        <a href="#">
                            <img src="<?= Yii::$app->params['site_domain']?>/images/logo-chs.png" />
                            Chelsea
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item-team">
                        <a href="#">
                            <img src="<?= Yii::$app->params['site_domain']?>/images/logo-mu.png" />
                            Mancheter United
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item-team">
                        <a href="#">
                            <img src="<?= Yii::$app->params['site_domain']?>/images/logo-chs.png" />
                            Chelsea
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item-team">
                        <a href="#">
                            <img src="<?= Yii::$app->params['site_domain']?>/images/logo-mu.png" />
                            Mancheter United
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item-team">
                        <a href="#">
                            <img src="<?= Yii::$app->params['site_domain']?>/images/logo-chs.png" />
                            Chelsea
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item-team">
                        <a href="#">
                            <img src="<?= Yii::$app->params['site_domain']?>/images/logo-mu.png" />
                            Mancheter United
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item-team">
                        <a href="#">
                            <img src="<?= Yii::$app->params['site_domain']?>/images/logo-chs.png" />
                            Chelsea
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-adv adv-4">
        <a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/cm4.jpg"/></a>
    </div>

    <div class="row">
        <div class="col-sm-12 title-yk">
            <span>Thăm dò ý kiến</span>
        </div>
        <div class="col-sm-12">
            <div class="list-yk clear">
                <p>Đội bóng nào sẽ vô địch Premier League 2017/18?</p>
                <div class="radio-team">
                    <input class="magic-radio" type="radio" id="1" name="radio"  value="option1">
                    <label for="1">
                        <img src="<?= Yii::$app->params['site_domain']?>/images/logo-chs.png" />
                        Chelsea
                    </label>
                </div>
                <div class="radio-team">
                    <input class="magic-radio" type="radio" id="2" name="radio"  value="option1">
                    <label for="2">
                        <img src="<?= Yii::$app->params['site_domain']?>/images/logo-chs.png" />
                        Chelsea
                    </label>
                </div>

                <div class="radio-team">
                    <input class="magic-radio" type="radio" id="3" name="radio"  value="option1">
                    <label for="3">
                        <img src="<?= Yii::$app->params['site_domain']?>/images/logo-chs.png" />
                        Chelsea
                    </label>
                </div>
                <div class="radio-team">
                    <input class="magic-radio" type="radio" id="4" name="radio"  value="option1">
                    <label for="4">
                        <img src="<?= Yii::$app->params['site_domain']?>/images/logo-chs.png" />
                        Chelsea
                    </label>
                </div>

                <div class="radio-team">
                    <input class="magic-radio" type="radio" id="5" name="radio"  value="option1">
                    <label for="5">
                        <img src="<?= Yii::$app->params['site_domain']?>/images/logo-chs.png" />
                        Chelsea
                    </label>
                </div>
                <div class="buttom-yk text-center">
                    <button class="btn-bc">Bình chọn</button>
                    <button class="btn-kq">Kết quả</button>
                </div>
            </div>
        </div>
    </div>
</div>
