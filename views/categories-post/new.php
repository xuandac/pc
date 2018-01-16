<?php
/*
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Sep 28, 2017, 2:01:27 PM. 
 * *********************************************
 */
use app\services\PostService;
use yii\widgets\LinkPager;

$this->title = 'Kết quả nhanh';
$Config = Yii::$app->params;
$Url_Media = $Config['media'];
$Service = new PostService();
?>
<div id="box_panel1" class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="item-one">
                            
                            <?php 
                            if(count($Data)>0){
                              $Img_Top = json_decode($Data[0]['Thumb'],true);  
                            ?>
                            <div class="col-md-4">
                               <a class="name-post" href="<?= $Service->makeUrl($Data[0])?>"><?= $Data[0]['Title']?></a>
                                <p class="text-justify"><?= $Service->subStringv($Data[0]['Summary'], 150)?></p>
                                <!--<ul class="list-tags">
                                   <?php
                                          $Array_Tags = explode(',', $Data[0]['Tags']);                                         
                                          foreach ($Array_Tags as $vl_Tags){
                                              if($vl_Tags  !=null){
                                        ?>
                                        <li><a href="<?= $Service->makeUrlTag($vl_Tags)?>"><?= $vl_Tags?></a></li>
                                          <?php } }?>
                                </ul>-->
                            </div>
                            <div class="col-md-8">
                                <div class="img">
                                    <a href="<?= $Service->makeUrl($Data[0]);?>"><img src="<?= $Url_Media.$Img_Top['size1']?>"/></a>
                                </div>
                            </div>
                            <?php 
                            unset($Data[0]); }                             
                            ?>
                            <?php
                            foreach ($Data as $key=>$value){
                                if($key == 7){break;}
                            ?>
                            <div class="col-md-4 item-box-one">
                                <a href="<?= $Service->makeUrl($value)?>"><?= $value['Title']?></a>
                            </div>
                            <?php unset($Data[$key]); } ?>


                        </div>

                        

                        <div class="list-new-category">
                            <?php
                                                    foreach ($Data as  $i=>$item){
                                                      $List_img = json_decode($item['Thumb'], true);
                            ?>
                            <div class="col-md-12 item-list-new">
                                <div class="content-item-list-new">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="img">
                                                <a href="<?= $Service->makeUrl($item);?>"><img src="<?=  $Url_Media.$List_img['size1']?>"/></a>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="caption-it">
                                                <a href="<?= $Service->makeUrl($item);?>"><?= $item['Title']?></a>
                                                <p><?= $Service->subStringv($item['Summary'], 220)?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                    <?php } ?>
                            
                           
                           
                           
                        

                            <div class="col-md-12">
                                <nav class="pull-right">
                                   <?= LinkPager::widget(['pagination' => $pagination,]) ?>
                                </nav>
                            </div>
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
                            <a href="<?= $Service->makeUrl($Most_View[0])?>"><?= $Most_View[0]['Title']?></a>
                            
                        </div>						

                    </div>
                    <?php unset($Most_View[0]); } ?>

                    <ul class="list-first-new">
                        <?php foreach ($Most_View as $i_m=>$item_m){?>
                        <li><a href="<?= $Service->makeUrl($item_m);?>"><?= $item_m['Title']?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="box-adv adv2">
                        <a href="#"><img src="/images/adv7.png"/></a>
                    </div>

                </div>

                <!-- Bảng xếp hạng ---->
                <div class="col-md-12">
                    <div class="title-box5 title-box-category">
                        <div class="left-title-box5 pull-left">
                            <img class="pull-left" src="/images/ic-cl.png"/>
                            <h2 class="pull-left">Lịch thi đấu - Kết quả bóng đá</h2>
                        </div>


                    </div>
                </div>

                <div class="col-md-12">
                    <div class="sub-title-box5">
                        <img src="/images/lg-p.png"/>
                        <h3>LTĐ Premier League  2017 (Vòng 3)</h3>
                    </div>
                </div>

                <div class="col-md-3">
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
                </div>
                <div class="col-md-9">
                    <table class="ltd-kq-box5">
                        <tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="/images/logo-by.png"/> Bayern Munich</td>
                            <td class="kq"><span>23:03</span></td>
                            <td class="t-td-last"><img src="/images/logo-chs.png"/> Chelsea</td>
                            <td class="ac"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="/images/logo-mu.png"/> Mancheter United</td>
                            <td class="kq"><span>23:03</span></td>
                            <td class="t-td-last"><img src="/images/logo-ev.png"/> Southamton</td>
                            <td class="ac"><i class="fa fa-star f-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="/images/logo-by.png"/> Bayern Munich</td>
                            <td class="kq"><span>23:03</span></td>
                            <td class="t-td-last"><img src="/images/logo-chs.png"/> Chelsea</td>
                            <td class="ac"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="/images/logo-mu.png"/> Mancheter United</td>
                            <td class="kq"><span>23:03</span></td>
                            <td class="t-td-last"><img src="/images/logo-ev.png"/> Southamton</td>
                            <td class="ac"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="/images/logo-by.png"/> Bayern Munich</td>
                            <td class="kq"><span>23:03</span></td>
                            <td class="t-td-last"><img src="/images/logo-chs.png"/> Chelsea</td>
                            <td class="ac"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="/images/logo-mu.png"/> Mancheter United</td>
                            <td class="kq"><span>23:03</span></td>
                            <td class="t-td-last"><img src="/images/logo-ev.png"/> Southamton</td>
                            <td class="ac"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="/images/logo-by.png"/> Bayern Munich</td>
                            <td class="kq"><span>23:03</span></td>
                            <td class="t-td-last"><img src="/images/logo-chs.png"/> Chelsea</td>
                            <td class="ac"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="/images/logo-mu.png"/> Mancheter United</td>
                            <td class="kq"><strong>0 : 2</strong></td>
                            <td class="t-td-last"><img src="/images/logo-ev.png"/> Southamton</td>
                            <td class="ac"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="/images/logo-by.png"/> Bayern Munich</td>
                            <td class="kq"><strong>0 : 0</strong></td>
                            <td class="t-td-last"><img src="/images/logo-chs.png"/> Chelsea</td>
                            <td class="ac"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="/images/logo-mu.png"/> Mancheter United</td>
                            <td class="kq"><strong>3 : 0</strong></td>
                            <td class="t-td-last"><img src="/images/logo-ev.png"/> Southamton</td>
                            <td class="ac"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="d-td">Thứ 7 	&nbsp; 17/8</td>
                            <td class="t-td"><img src="/images/logo-by.png"/> Bayern Munich</td>
                            <td class="kq"><strong>3 : 0</strong></td>
                            <td class="t-td-last"><img src="/images/logo-chs.png"/> Chelsea</td>
                            <td class="ac"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-info" aria-hidden="true"></i></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
       <?php echo $this->render('/element/slidebar'); ?>
    </div>

</div> 
