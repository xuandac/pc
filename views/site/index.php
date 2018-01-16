<?php
/* @var $this yii\web\View */

use app\services\PostService;
use app\services\SeoService;

//$this->title = 'Kết quả nhanh';
$Config = Yii::$app->params;
$Url_Media = $Config['media'];
$Url_Media_Compress = $Config['media_compress'];
$Service = new PostService();
$Seo = new SeoService();
$Seo->Seo_Homepage($this, $Data_Seo);
?>
<div id="box_panel1" class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">

                        <div class="item-one">
                            <?php
                            if (count($Data_Hot > 0)) {
                                $img_hot = json_decode($Data_Hot[0]['Thumb'], true);
                                ?>
                                <div class="col-md-4">
                                    <a  class="name-post" href="<?= $Service->makeUrl($Data_Hot[0]) ?>"><?= $Data_Hot[0]['Title'] ?></a>
                                    <p class="text-justify"><?= $Service->subStringv($Data_Hot[0]['Summary'], 200) ?></p>
                                    <ul class="list-tags">
                                        <?php
                                          $Array_Tags = explode(',', $Data_Hot[0]['Tags']);
                                          foreach ($Array_Tags as $vl_Tags){
                                              if($vl_Tags  !=null){
                                        ?>
                                        <li><a href="<?= $Service->makeUrlTag($vl_Tags)?>"><?= $vl_Tags?></a></li>
                                          <?php } }?>
                                    </ul>
                                </div>
                                <div class="col-md-8">
                                    <div class="img">
                                        <a href="<?= $Service->makeUrl($Data_Hot[0]) ?>"><img src="<?= $Url_Media_Compress."/455-255-70/bong-da/". $img_hot['size1'] ?>"/></a>
                                    </div>
                                </div>
                                <?php
                            }
                            unset($Data_Hot[0]);
                            foreach ($Data_Hot as $key_hot => $value_hot) {
                                ?>
                                <div class="col-md-4 item-box-one">
                                    <a href="<?= $Service->makeUrl($value_hot) ?>"><?= $value_hot['Title'] ?></a>
                                </div>
                            <?php } ?>

                            <div class="col-md-12 box-adv adv1">
                                <a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/adv1.jpg" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 box-ltd">
					<h2 class="header-ltd1">Trận đấu hot</h2>
                    <table class="table-ltd1">
                        <tbody>
                            <?php foreach ($Score_Hot['data'] as $I_hot =>$VL_Hot){?>
                            <tr>
                                <td class="icf">
                                    <img src="<?= Yii::$app->params['site_domain']?>/images/ic1.png" />
                                    <?= date('d/m', strtotime($VL_Hot['StartTime']));?>
                                </td>
                                <td class="team"><?= $VL_Hot['NameHome']?></td>
                                <td class="time"><?= date('H:i', strtotime($VL_Hot['StartTime']));?></td>
                                <td class="team"><?= $VL_Hot['NameAWay']?></td>
                                <td class="btn-cm"><a href="#">Bình luận</a></td>
                            </tr>
                            <?php } ?>
                           
                            <!--<tr>
                                <td class="icf">
                                    <img src="images/ic1.png" />
                                    17/8
                                </td>
                                <td class="team">Bayern Munich</td>
                                <td class="time">04:00</td>
                                <td class="team">Manchester United</td>
                                <td class="btn-cm live"><i class="fa fa-video-camera" aria-hidden="true"></i> <a href="#">Live</a></td>
                            </tr>-->
                           
                          
                          
                        </tbody>
                    </table>
                    <div class="box-adv adv2">
                        <a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/adv2.jpg"/></a>
                    </div>
                    <div class="box-adv adv3">
                        <a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/adv3.jpg"/></a>
                    </div>
                </div>

                <div class="col-md-8 box-feature">
                    <div class="row">
                        <div class="col-md-12 title_box">
                            <div class="content_title_box">
                                <h3>Tin nổi bật</h3>
                            </div>
                        </div>



                        <div class="exTab1">	
                            <div class="col-md-12">
                                <ul class="nav nav-pills">
                                    <li class="active">
                                        <a  href="<?= Yii::$app->params['site_domain']?>/tin-noi-bat/trong-nuoc">Trong nước</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['site_domain']?>/tin-noi-bat/quoc-te">Quốc tế</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="clear"></div>
                            <div class="tab-content clearfix">
                                <div class="tab-pane active" id="1a">
                                    <?php
                                    foreach ($Data_Feature as $key_f => $value_f) {
                                        $Img_F = json_decode($value_f['Thumb'], true);
                                        ?>
                                        <div class="col-md-6 item-feature">
                                            <div class="content-item">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <a href="<?= $Service->makeUrl($value_f) ?>"><img src="<?= $Config['98x65x70'].$Img_F['size0'] ?>"/></a>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <a href="<?= $Service->makeUrl($value_f) ?>"><?= $value_f['Title'] ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>										
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 box-new">
                    <div class="row">
                        <div class="col-md-12 title_box">
                            <div class="content_title_box">
                                <h3>Tin mới nhất</h3>
                            </div>
                        </div>

                        <div class="exTab1">	
                            <div class="col-md-12">
                                <ul class="nav nav-pills">
                                    <li class="active">
                                        <a  href="<?= Yii::$app->params['site_domain']?>/tin-moi" >Tất cả</a>
                                    </li>
                                    <li>
                                        <a  href="<?= Yii::$app->params['site_domain']?>/tin-moi/trong-nuoc" >Trong nước</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::$app->params['site_domain']?>/tin-moi/quoc-te" >Quốc tế</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="clear"></div>
                            <div class="tab-content clearfix">
                                <div class="tab-pane active" id="1a">
                                    <?php
                                    foreach ($Data_New as $key_n => $value_n) {
                                        ?>
                                        <div class="col-md-12 item-new">
                                            <div class="content-item">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <span><?= date('H:i', strtotime($value_n['DateCreate'])) ?></span>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <a href="<?= $Service->makeUrl($value_n) ?>"><?= $value_n['Title'] ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>										
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="box-adv adv-4">
                <a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/adv4.jpg"/></a>
            </div>
            <div class="box-adv adv-5" style="margin-top:30px;">
                <a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/adv6.jpg"/></a>
            </div>
        </div>
    </div>

</div> 


<?php
foreach ($Categories_Home_Big['data'] as $key_big => $value_big) {
    ?>
    <div class="box-panel2 container">
        <div class="row">
            <div class="col-md-12">
                <div class="title_box_panel2">
                    <div class="content-title">
                        <a href="<?= $Service->makeUrl_Categoies($value_big) ?>"><img src="<?= $Url_Media . $value_big['Icon'] ?>"/></a>
                        <h2><a href="<?= $Service->makeUrl_Categoies($value_big) ?>"><?= $value_big['Title'] ?></a></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 menu-box-title">
                <ul class="pull-right">
                    <?php foreach ($value_big['Menu_Category'][0] as $k_big_menu =>$v_big_menu){?>
                    <li><a href="<?= $v_big_menu['Link']?>"><?= $v_big_menu['Name']?></a></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-md-3">
                <div class="title-tieudiem clearfix">
                    <img class="pull-left" src="<?= Yii::$app->params['site_domain']?>/images/ic-td.png"/>
                    <h3 class="pull-left">Tin tiêu điểm</h3>
                </div>
                <?php
                $Data_Tieu_Diem_Big = $value_big['Tin_tieu_diem'][0];
                if (count($Data_Tieu_Diem_Big) > 0) {
                    $Img_Tieu_Diem_Big = json_decode($Data_Tieu_Diem_Big[0]['Thumb'], true);
                    ?>
                    <div class="item-td">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="<?= $Service->makeUrl($Data_Tieu_Diem_Big[0]) ?>"><?= $Data_Tieu_Diem_Big[0]['Title'] ?></a>
                            </div>
                            <div class="col-md-5">
                                <a href="<?= $Service->makeUrl($Data_Tieu_Diem_Big[0]) ?>"><img src="<?= $Config['115x68x70'].$Img_Tieu_Diem_Big['size1'] ?>"/></a>
                            </div>
                            <div class="col-md-7">
                                <p><?= $Service->subStringv($Data_Tieu_Diem_Big[0]['Summary'], 100) ?></p>
                            </div>

                            <div class="col-md-12">
                                <ul class="list-tag2">
                                    
                                    <?php
                                          $Array_Tags = explode(',', $Data_Tieu_Diem_Big[0]['Tags']);
                                          foreach ($Array_Tags as $vl_Tags){
                                              if($vl_Tags  !=null){
                                        ?>
                                        <li><a href="<?= $Service->makeUrlTag($vl_Tags)?>"><?= $vl_Tags?></a></li>
                                          <?php } }?>
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="title-chuyen-nhuong clearfix">
                    <img src="<?= Yii::$app->params['site_domain']?>/images/ic-ch.png"/>
                    <h3>Tin chuyển nhượng</h3>
                </div>
                <div class="item-chuyen-nhuong clearfix">
                    <ul>
                        <?php
                        if(count($value_big['Tin_chuyen_nhuong'][0])>0){
                        foreach ($value_big['Tin_chuyen_nhuong'][0] as $key_ch_big => $value_ch_big) { ?>
                            <li><a href="<?= $Service->makeUrl($value_ch_big); ?>"><?= $value_ch_big['Title'] ?></a></li>
                        <?php }} ?>
                    </ul>
                </div>
                <div class="col-md-12 read-more">
                    <a class="pull-right" href="#">Xem tất cả</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="menu-box-center">
                            <ul>
                                <li class="active"><a href="<?= $Service->makeUrl_Categoies($value_big) ?>">Tổng hợp</a></li>
                                <?php
                                foreach ($value_big['Sub_categories'][0] as $key_sub_big => $value_sub_big) {
                                    if (strpos($value_sub_big['Title'], 'chuyển nhượng') == false) {
                                        ?>
                                        <li><a href="<?= $Service->makeUrl_Categoies($value_sub_big) ?>"><?= $value_sub_big['Title'] ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <?php
                        $Data_Post_Big = $value_big['ListPost'][0];
                        if (count($Data_Post_Big) > 0) {
                            $Img_Post_B = json_decode($Data_Post_Big[0]['Thumb'], true);
                            ?>
                            <div class="content-center">
                                <div class="row">
                                    <div class="col-md-5">
                                        <a href="<?= $Service->makeUrl($Data_Post_Big[0]); ?>">
                                            <img class="img-box-center" src="<?= $Config['265x148x70'].$Img_Post_B['size1'] ?>" />
                                        </a>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="caption-box">
                                            <a href="<?= $Service->makeUrl($Data_Post_Big[0]); ?>"><?= $Data_Post_Big[0]['Title'] ?></a>
                                            <p><?= $Service->subStringv($Data_Post_Big[0]['Summary'], 200) ?></p>
                                        </div>
                                        <ul class="list-tag2">
                                             <?php
                                          $Array_Tags = explode(',', $Data_Post_Big[0]['Tags']);
                                           foreach ($Array_Tags as $vl_Tags){
                                              if($vl_Tags  !=null){
                                        ?>
                                        <li><a href="<?= $Service->makeUrlTag($vl_Tags)?>"><?= $vl_Tags?></a></li>
                                          <?php } }?>
                                            
                                        </ul>
                                    </div>		

                                </div>

                            </div>
                            <?php
                            unset($Data_Post_Big[0]);
                        }
                        ?>

                        <div class="row">
                            <?php foreach ($Data_Post_Big as $key_post_big => $value_post_big) { ?>
                                <div class="col-md-6 item-box-center">
                                    <a href="<?= $Service->makeUrl($value_post_big) ?>"><?= $value_post_big['Title'] ?></a>
                                </div>
                            <?php } ?>

                            <div class="col-md-12 read-more">
                                <a class="pull-right" href="<?= $Service->makeUrl_Categoies($value_big) ?>">Xem tất cả</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <ul class="title-box-bxh">
                    <li><a href="#">Bxh</a></li>
                    <li><a href="#">Ltđ</a></li>
                </ul>

                <table class="bxh-ltd">
                    <tbody>
                        <?php
                        $Bxh = $value_big['Bxh_Category'][0]['Bxh'];
                        if(count($Bxh)>0){
                        $Stt = count($Bxh) - 3;
                       
                        foreach ($Bxh as $key_bxh_big => $value_bxh_big){
                            if($key_bxh_big > 6 && $key_bxh_big < $Stt )continue;
                        ?>
                        <tr>
                            <td class="stt"><?= $value_bxh_big['Position']?></td>
                            <td class="team-bxh"><img src="<?= str_replace('http://bongdaso.com/','https://cdn.ketquanhanh.vn/bds/',$value_bxh_big['Logo'])?>" width="22" height="22"/> <?= $value_bxh_big['NameTeam']?></td>
                            <td class="point"><?= $value_bxh_big['Point']?></td>
                        </tr>
                        <?php } } ?>
                       

                    </tbody>
                </table>
                <div class="col-sm-12 text-center more-bxh">
                    <a href="#">Xem thêm <img src="<?= Yii::$app->params['site_domain']?>/images/more.png"/></a>
                </div>
            </div>

            <div class="col-md-12">
                <div class="content-box-video">
                    <div  class="row">
                        <div class="col-md-12 title-box-video">
                            <img src="<?= Yii::$app->params['site_domain']?>/images/ic-vd.png"/> <h3>Video <?= $value_big['Title'] ?></h3>
                        </div>
                        <?php 
                        $Data_Video = $value_big['ListVideo'][0]; 
                        if(count($Data_Video)>0){
                            foreach ($Data_Video as $k_v=>$value_v){
                            $Img_Video = json_decode($value_v['Thumb'], true);
                        ?>
                        <div class="col-md-3 itemm-box-video">
                            <div class="img-vd">
                                <a href="<?= $Service->makeUrl($value_v);?>" class="play-video"><i class="fa fa-play-circle-o" aria-hidden="true"></i></a>
                                <a href="<?= $Service->makeUrl($value_v);?>"><img src="<?= $Config['292x176x70'].$Img_Video['size1'] ?>" alt="<?= $value_v['Title']?>"/></a>
                            </div>
                            <div class="caption-video">
                               <a href="<?= $Service->makeUrl($value_v);?>"><?= $value_v['Title']?> </a> 
                                <!--<p>(ICC 2017)</p>-->
                            </div>
                        </div>
                       
                        <?php }} ?>
                      
                    </div>
                </div>	
            </div>
        </div>
    </div>
<?php } ?>


<?php
foreach ($Categories_Home_Rank['data'] as $key_r => $value_r) {
    ?>

    <div class="box-panel3 container">
        <div class="row">
            <div class="col-md-12">
                <div class="title_box_panel2">
                    <div class="content-title">
                        <a href="<?= $Service->makeUrl_Categoies($value_r) ?>"><img src="<?= $Url_Media . $value_r['Icon'] ?>"/></a>
                        <h3><a href="<?= $Service->makeUrl_Categoies($value_r) ?>"><?= $value_r['Title'] ?></a></h3>
                       <!-- <span> / </span>
                        <a href="#"> <img src="images/ic-f1.png"/></a>
                        <h3 class="last"><a href="#">Bóng đá Châu Âu</a></h3>-->
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <div class="title-tieudiem clearfix">
                            <img class="pull-left" src="<?= Yii::$app->params['site_domain']?>/images/ic-td.png"/>
                            <h3 class="pull-left">Tin tiêu điểm</h3>
                        </div>

                        <div class="item-td">
                            <div class="row">
                                <?php
                                $Data_Tieu_Diem = $value_r['Tin_tieu_diem'][0];
                                if (count($Data_Tieu_Diem) > 0) {
                                    $Img_r = json_decode($Data_Tieu_Diem[0]['Thumb'], true);
                                    ?>
                                    <div class="col-md-12">
                                        <a href="<?= $Service->makeUrl($Data_Tieu_Diem[0]) ?>"><?= $Data_Tieu_Diem[0]['Title'] ?></a>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="<?= $Service->makeUrl($Data_Tieu_Diem[0]) ?>"><img src="<?= $Config['113x82x70'].$Img_r['size1'] ?>"/></a>
                                    </div>
                                    <div class="col-md-7">
                                        <p><?= $Service->subStringv($Data_Tieu_Diem[0]['Summary'], 100) ?></p>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="list-tag2">
                                              <?php
                                          $Array_Tags = explode(',', $Data_Tieu_Diem[0]['Tags']);
                                          foreach ($Array_Tags as $vl_Tags){
                                              if($vl_Tags  !=null){
                                        ?>
                                        <li><a href="<?= $Service->makeUrlTag($vl_Tags)?>"><?= $vl_Tags?></a></li>
                                          <?php } }?>
                                            
                                        </ul>

                                    </div>
                                    <?php
                                    unset($Data_Tieu_Diem[0]);
                                }
                                ?>

                                <div class="col-md-12">

                                    <div class="item-chuyen-nhuong">
                                        <ul>
                                            <?php foreach ($Data_Tieu_Diem as $key_r_td => $value_r_td) { ?>
                                                <li><a href="<?= $Service->makeUrl($value_r_td) ?>"><?= $value_r_td['Title'] ?></a></li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                </div>


                            </div>
                        </div>



                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="menu-box-center">
                                    <ul>
                                        <li class="active"><a href="<?= $Service->makeUrl_Categoies($value_r) ?>">Tổng hợp</a></li>
                                        <?php
                                        $List_Sub_Categories_r = $value_r['Sub_categories'][0];
                                        foreach ($List_Sub_Categories_r as $key_sub_cat_r => $value_sub_cat_r) {
                                            if (strpos($value_sub_cat_r['Title'], 'chuyển nhượng') == false) {
                                                ?>
                                                <li><a href="<?= $Service->makeUrl_Categoies($value_sub_cat_r); ?>"><?= $value_sub_cat_r['Title'] ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <?php
                                $Data_Post_Td = $value_r['ListPost'][0];
                                if (count($Data_Post_Td) > 0) {
                                    $Img_P = json_decode($Data_Post_Td[0]['Thumb'], true);
                                    ?>
                                    <div class="content-center">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <a href="<?= $Service->makeUrl($Data_Post_Td[0]); ?>">
                                                    <img class="img-box-center" src="<?= Yii::$app->params['site_domain']?>/images/a3.jpg" />
                                                </a>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="caption-box">
                                                    <a href="<?= $Service->makeUrl($Data_Post_Td[0]); ?>"><?= $Data_Post_Td[0]['Title'] ?></a>
                                                    <p><?= $Service->subStringv($Data_Post_Td[0]['Summary'], 200) ?></p>
                                                </div>
                                                <ul class="list-tag2">
                                                     <?php
                                          $Array_Tags = explode(',', $Data_Post_Td[0]['Tags']);
                                          foreach ($Array_Tags as $vl_Tags){
                                              if($vl_Tags  !=null){
                                        ?>
                                        <li><a href="<?= $Service->makeUrlTag($vl_Tags)?>"><?= $vl_Tags?></a></li>
                                          <?php } }?>
                                                   
                                                </ul>
                                            </div>		

                                        </div>

                                    </div>
                                    <?php
                                    unset($Data_Post_Td[0]);
                                }
                                ?>

                                <div class="row">
                                    <?php foreach ($Data_Post_Td as $key_p_r => $value_p_r) { ?>
                                        <div class="col-md-6 item-box-center">
                                            <a href="<?= $Service->makeUrl($value_p_r); ?>"><?= $value_p_r['Title'] ?></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="content-box-video">
                            <div  class="row">
                                <div class="col-md-12 title-box-video">
                                    <img class="pull-left" src="<?= Yii::$app->params['site_domain']?>images/ic-vd.png"/> 
									<h3 class="pull-left">Video <?= $value_r['Title'] ?></h3>
                                </div>
                                <?php 
                        $Data_Video_Rank = $value_r['ListVideo'][0]; 
                        if(count($Data_Video_Rank)>0){
                            foreach ($Data_Video_Rank as $k_v_r=>$value_v_r){
                            $Img_Video_r = json_decode($value_v_r['Thumb'], true);
                        ?>
                                <div class="col-md-3 itemm-box-video">
                                    <div class="img-vd">
                                        <a href="<?= $Service->makeUrl($value_v_r); ?>" class="play-video"><i class="fa fa-play-circle-o" aria-hidden="true"></i></a>
                                        <a href="<?= $Service->makeUrl($value_v_r); ?>"><img src="<?= $Url_Media . $Img_Video_r['size1'] ?>"/></a>
                                    </div>
                                    <div class="caption-video">
                                        <a href="<?= $Service->makeUrl($value_v_r); ?>"><?= $value_v_r['title']?> </a>
                                       <!--<p>(ICC 2017)</p>-->
                                    </div>
                                </div>
                        <?php }} ?>
                            
                            </div>
                        </div>	
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <ul class="title-box-bxh">
                    <li><a href="#">Bxh</a></li>
                    <li><a href="#">Ltđ</a></li>
                </ul>

                <table class="bxh-ltd">
                    <tbody>
                       <?php
                        $Bxh = $value_r['Bxh_Category'][0]['Bxh'];
                        if(count($Bxh)>0){
                        $Stt = count($Bxh) - 3;
                       
                        foreach ($Bxh as $key_bxh_big => $value_bxh_big){
                            if($key_bxh_big > 6 && $key_bxh_big < $Stt )continue;
                        ?>
                        <tr>
                            <td class="stt"><?= $value_bxh_big['Position']?></td>
                            <td class="team-bxh"><img src="<?= str_replace('http://bongdaso.com/','https://cdn.ketquanhanh.vn/bds/',$value_bxh_big['Logo'])?>" width="22" height="22"/> <?= $value_bxh_big['NameTeam']?></td>
                            <td class="point"><?= $value_bxh_big['Point']?></td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
                <div class="col-sm-12 text-center more-bxh">
                    <a href="#">Xem thêm <img src="<?= Yii::$app->params['site_domain']?>/images/more.png"/></a>
                </div>
            </div>


        </div>
    </div>
<?php } ?>

<div class="box-panel4 container">
    <div class="row">
        <?php
		
        foreach ($Categories_Home_Sm['data'] as $key_c_sm => $value_c_sm) {
            $Data_Post_C_Sm = isset($value_c_sm['ListPost'][0])? $value_c_sm['ListPost'][0] :[];
            if ($key_c_sm == 0 || $key_c_sm == 2) {
                ?>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 title-box-4">
                            <div class="content-title">                               
                                    <img class="pull-left" src="<?= $Url_Media . $value_c_sm['Icon'] ?>"/> 
									<h2> <a href="<?= $Service->makeUrl_Categoies($value_c_sm) ?>"><?= $value_c_sm['Title'] ?></a></h2>                                
                            </div>
                        </div>
                        <?php
                        if (count($Data_Post_C_Sm > 0)) {
							$sm=isset($Data_Post_C_Sm[0])?$Data_Post_C_Sm[0]:['Thumb'=>'','Title'=>''];
                            $Img_C_Sm = isset($sm)? json_decode($sm['Thumb'], true):[];
                            ?>
                            <div class="col-md-12 item-box-4">
                                <div class="img">
                                    <a href="<?= $Service->makeUrl($sm) ?>">
                                        <img src="<?= $Config['406x244x70'].$Img_C_Sm['size1'] ?>"/>
                                    </a>

                                </div>
                                <a href="<?= $Service->makeUrl($sm) ?>"><?= $sm['Title'] ?></a>
                            </div>
                            <?php
                        }
                        unset($Data_Post_C_Sm[0]);
                        ?>

                        <div class="col-md-12">
                            <ul class="list-item">
                                <?php foreach ($Data_Post_C_Sm as $key_p_sm => $value_p_sm) { ?>
                                    <li><a href="<?= $Service->makeUrl($value_p_sm) ?>"><?= $value_p_sm['Title'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 title-box-4">
                            <div class="content-title">
                               
                                    <img class="pull-left" src="<?= $Url_Media . $value_c_sm['Icon'] ?>"/> 
									<h2> <a href="<?= $Service->makeUrl_Categoies($value_c_sm) ?>"><?= $value_c_sm['Title'] ?> </a></h2>
                               
                            </div>
                        </div>


                        <?php
                        foreach ($Data_Post_C_Sm as $key_p_sm => $value_p_sm) {
                            $Img_Post_Sm = json_decode($value_p_sm['Thumb'], true);
                            ?>

                            <div class="col-md-12 item-center">
                                <div class="content-box-center">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="img">
                                                <a href="<?= $Service->makeUrl($value_p_sm) ?>"><img src="<?= $Config['122x80x70'].$Img_Post_Sm['size0'] ?>"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="caption-center">
                                               <a href="<?= $Service->makeUrl($value_p_sm) ?>"><?= $value_p_sm['Title'] ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>



                    </div>
                </div>

                <?php
            }
        }
        ?>

    </div>
</div>

<div class="box-panel5 container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-box5">
                        <div class="left-title-box5 pull-left">
                            <img class="pull-left" src="<?= Yii::$app->params['site_domain']?>/images/ic-cl.png"/>
                            <h2 class="pull-left">Lịch thi đấu - Kết quả bóng đá</h2>
                        </div>

                        <div class="right-title-box5 pull-right">
                            <ul>
                                <li class="active"><a href="#">Premier League</a></li>
                                <li><a href="#">La Liga</a></li>
                                <li><a href="#">Champions League</a></li>
                                <li><a href="#"> V-League</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="sub-title-box5">
                        <img src="<?= Yii::$app->params['site_domain']?>/images/lg-p.png"/>
                        <h3>
                            LTĐ Premier League  
                            <?php if(isset($Score_PmLeague['data']) && count($Score_PmLeague['data']) >0){
                                echo date('Y', strtotime($Score_PmLeague['data'][0]['Season_StartTime'])).' - '. date('Y', strtotime($Score_PmLeague['data'][0]['Season_EndTime']));
                            }  ?>
                        </h3>
                    </div>
                </div>

                <!--<div class="col-md-2">
                    <table class="tbl-vong-dau">
                        <tbody>
                            <tr>
                                <td class="v">Vòng 1</td>
                                <td class="d-v">17/8 - 22/8</td>								
                            </tr>
                            <tr>
                                <td class="v">Vòng 1</td>
                                <td class="d-v">17/8 - 22/8</td>								
                            </tr>
                            <tr class="v-f">
                                <td class="v">Vòng 1</td>
                                <td class="d-v">17/8 - 22/8</td>								
                            </tr>
                            <tr>
                                <td class="v">Vòng 1</td>
                                <td class="d-v">17/8 - 22/8</td>								
                            </tr>
                            <tr>
                                <td class="v">Vòng 1</td>
                                <td class="d-v">17/8 - 22/8</td>								
                            </tr>
                            <tr>
                                <td class="v">Vòng 1</td>
                                <td class="d-v">17/8 - 22/8</td>								
                            </tr>
                            <tr>
                                <td class="v">Vòng 1</td>
                                <td class="d-v">17/8 - 22/8</td>								
                            </tr>
                            <tr>
                                <td class="v">Vòng 1</td>
                                <td class="d-v">17/8 - 22/8</td>								
                            </tr>
                            <tr>
                                <td class="v">Vòng 1</td>
                                <td class="d-v">17/8 - 22/8</td>								
                            </tr>
                            <tr>
                                <td class="v">Vòng 1</td>
                                <td class="d-v">17/8 - 22/8</td>								
                            </tr>
                            <tr>
                                <td class="v">Vòng 1</td>
                                <td class="d-v">17/8 - 22/8</td>								
                            </tr>
                        </tbody>
                    </table>
                </div>-->
                <div class="col-md-7">
                    <table class="ltd-kq-box5">
                        <?php foreach ($Score_PmLeague['data'] as $I_s=>$Vl_S){?>
                        <?php $Day_Name = $Service->conver_date_vi('l',strtotime($Vl_S['StartTime'])); ?>
                        <tr>
                           <td class="v">Vòng <?= $Vl_S['Vong'] ?></td>
                           <td class="d-td"><?= $Day_Name ?> 	&nbsp; <?= date('d/m', strtotime($Vl_S['StartTime']))?></td>
                           <td class="t-td"><img src="<?= str_replace('http://bongdaso.com/','https://cdn.ketquanhanh.vn/bds/', $Vl_S['HomeLogo']) ?>" width="22" height="22"/> <?= $Vl_S['NameHome']?></td>
                            <td class="kq">
                                <?php if($Vl_S['Status'] ==1){?>
                                <strong><?= str_replace('-',':',$Vl_S['Score'])?></strong>
                                <?php }else{ ?>
                                <span><?= date('H:i', strtotime($Vl_S['StartTime']))?></span>
                                <?php } ?>
                                
                            </td>
                            <td class="t-td-last"><img src="<?= str_replace('http://bongdaso.com/','https://cdn.ketquanhanh.vn/bds/',$Vl_S['AWayLogo']) ?>" width="22" height="22"/> <?= $Vl_S['NameAWay']?></td>
                            <td class="ac"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>
                        <?php } ?>
                        <!--<tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="images/logo-mu.png"/> Mancheter United</td>
                            <td class="kq"><span>23:03</span></td>
                            <td class="t-td-last"><img src="images/logo-ev.png"/> Southamton</td>
                            <td class="ac"><i class="fa fa-star f-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>-->
                      

                    </table>
                </div>
                <div class="col-md-3">
                    <div class="title-bxh-box5">
                        <span>Bảng xếp hạng</span>
                    </div>
                    <table class="bxh-ltd">
                        <tbody>
                            <?php foreach ($SoccerRank_PmLeague['data'] as $I_Rank=>$V_Rank){?>
                            <?php
                            if($I_Rank > 6 && $I_Rank < 17 )continue; 
                           // if($I_Rank == 7)break;                           
                            ?>
                            <tr>
                                <td class="stt"><?= $V_Rank['Position']?></td>
                                <td class="team-bxh"><img src="<?= str_replace('http://bongdaso.com/','https://cdn.ketquanhanh.vn/bds/',$V_Rank['Logo'])?>" width="22" height="22"/> <?= $V_Rank['NameTeam']?></td>
                                <td class="point"><?= $V_Rank['Point']?></td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
                <div class="col-md-2">
                    <div class="adv">
                        <a href="#"><img style="width:100%" src="<?= Yii::$app->params['site_domain']?>/images/adv4.jpg" /></a>
                    </div>
                </div>
            </div>
        </div>
