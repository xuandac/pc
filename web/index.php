<?php

$domain = "$_SERVER[REQUEST_URI]";
$listFix=['xsmb'=>1,'xsmn'=>1,'xsmt'=>1,'so-mo'=>1,'ket-qua-xo-so-hom-nay'=>1,'ket-qua-xo-so-hom-qua'=>1,'amp'=>1];
/*301 link tỉnh*/
$listTinh=['xsvt'=>1,'xstphcm'=>1,'xsla'=>1,'xskg'=>1,'xsbp'=>1,'xsbl'=>1,'xsag'=>1,'xsdlk'=>1,'xstth'=>1,'xsvl'=>1,'xstv'=>1,'xstg'=>1,'xstn'=>1,'xsst'=>1,'xshg'=>1,'xsdt'=>1,'xsdn'=>1,'xsdl'=>1,'xsct'=>1,'xscm'=>1,'xsbt'=>1,'xsbd'=>1,'xsbtr'=>1,'xskt'=>1,'xsqng'=>1,'xsdno'=>1,'xsnt'=>1,'xsgl'=>1,'xsqt'=>1,'xsqb'=>1,'xsbdi'=>1,'xsqn'=>1,'xsbn'=>1,'xshp'=>1,'xshn'=>1,'xsnd'=>1,'xstb'=>1,'xspy'=>1,'xsqna'=>1,'xsdna'=>1,'xskh'=>1];
$explo=explode('-',$domain);
if($explo!=null){
	$u=ltrim($explo[0],"/");
	if(isset($listTinh[$u])){
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /xo-so".$domain); 
		exit();
	}
	if(isset($listFix[$u])){
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: /xo-so".$domain); 
		exit();
	}
}

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
