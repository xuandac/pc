<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\services\MenuService;
$Menu_Service = new MenuService();
$Get_Menu = $Menu_Service->get_menu(null,['StructureCode'=>'NDE1MTUwNjUwNDE4NzI2Mw']);
$Get_Menu_Hot = $Menu_Service->get_menu(null,['StructureCode'=>'NjkyMTUxMzIyNDI4OTU4MA']);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="google-site-verification" content="G-a7AD7LbDL5WQTsa8xv09NGUpCP_QB0cdtReL4pf6k" />
        <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>	
        
        <?php if($_SERVER['HTTP_HOST'] != 'localhost:8309'){
            echo '<link href="https://cdn.ketquanhanh.vn/static/pc/css/style.css?v='.time().'" rel="stylesheet">';
        }
        ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111790692-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-111790692-1');
</script>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <a href="/"><img src="<?= Yii::$app->params['site_domain']?>/images/logo.png"/></a>
                         <?php                        
                         if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') { ?>
                        <h1 class="slogan">Kết quả bóng đá nhanh chính xác nhất</h1>
                         <?php } ?>
                    </div>
                    <div class="col-md-10">
                        <div class="menu-site">                            
                                 <?= $Menu_Service->showMenu($Get_Menu['data']); ?>                  
                        </div>
                        <div class="hot-menu">
                           <!-- <ul>
                               <li><span>Hot</span></li>                            						
                            </ul>-->
                            <?= $Menu_Service->showMenu($Get_Menu_Hot['data']); ?>
                        </div>

                        <div class="search pull-right">
                            <button class="btn btn-search"><i class="fa fa-search" aria-hidden="true"></i></button>
                            <form action="" class="form-inline pull-left form-search" method="GET">
                                <div class="form-group">									
                                    <input type="text" class="form-control" name="tag" id="s" placeholder="Từ khóa tìm kiếm">
                                </div>

                                <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>	
            </div>
        </header>
        <?= $content;?>

        

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="menu-footer">
                            <?php
                            $Get_Menu_Footer_1 = $Menu_Service->get_menu(null,['StructureCode'=>'NTUxMTUxNDI1Mzg0MTkxNw']);
                            $Menu_Service->showMenu($Get_Menu_Footer_1['data']);              
                            ?>
                            
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="content-list-link">
                            <div class="row">
                                <?php
                            $Get_Menu_Footer_2 = $Menu_Service->get_menu(null,['StructureCode'=>'ODk4MTUxNDI1Mzg2MTgwMQ']);
                            $Menu_Service->showMenu_footer($Get_Menu_Footer_2['data']);              
                            ?>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <ul class="list-logo">
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg1.png"/></a></li>
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg2.png"/></a></li>
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg3.png"/></a></li>
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg4.png"/></a></li>
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg5.png"/></a></li>
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg6.png"/></a></li>
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg7.png"/></a></li>
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg8.png"/></a></li>
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg9.png"/></a></li>
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg10.png"/></a></li>
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg11.png"/></a></li>
                            <li><a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/lg12.png"/></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container-fuild bottom-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 text-center">
                            <a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/logo-footer.png"/></a></br></br>
                            <a href="#"><img src="<?= Yii::$app->params['site_domain']?>/images/logo-dmca.png"/></a>
                        </div>
                        <div class="col-md-5">
                            <p class="company">Phần mềm quản lý nội dung số Kết Quả Nhanh</p>
                            <p>Giấy phép thiết lập trang Thông tin điện tử tổng hợp số: 1183/GP-TTĐT cấp ngày 04/04/2016 bởi Sở TT-TT Hà Nội, thay thế giấy phép 258/GP-TTĐT cấp ngày 07/04/2011 bởi Sở TT-TT Hà Nội 
                              Nội dung thông tin hợp tác giữa báo Điện tử Thể thao Việt Nam và công ty Incom </p>	
                        </div>
                        <div class="col-md-5 text-left">
							
                            <p><span>Cơ quan chủ quản:</span>
                            Công ty Cổ phần Ứng dụng Công nghệ Truyền thông CTC</p>
                             <p><span>Địa chỉ:</span> Tầng 4, tòa nhà IC, số 82 Duy Tân, Dịch Vọng Hậu, Cầu Giấy, Hà Nội</p>
                            <p><span>Chịu trách nhiệm:</span> Nguyễn Công Trung </p>                           
                            <p><span>Điện thoại:</span> 0983 038 119 <!--- <span>Fax:</span> (04) 3.7833699 * --></p>
                            <!--<p><span>Email:</span> bongda24h@incom.vn </p>-->
                            <p>Quản lý vận hành bởi ICWeb phiên bản DCMv1.0</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
