<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\services\PostService;
use app\services\CategoriesService;
use app\services\SoccerMathService;
use app\services\SoccerRankService;
use app\services\SeoService;
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		
        $Post_Service = new PostService();
        $category_service = new CategoriesService();
		
        $Data_hot = $Post_Service->get_post(7, ['hot'=>1]);
		
        $Data_Feature = $Post_Service->get_post(8,['Type'=>1, 'Post_Type'=>'POST', 'FeaturedNews'=>1, ]);
        $Data_New = $Post_Service->get_post(7,['Post_Type'=>'POST']);
        
        $Categories_Home_Big= $category_service->get_category_home($where=['ShowHomeBig'=>1],$Orwhere=[], $Limit=9, $oderby ='ShowHomeOrderBig ASC');
        $Categories_Home_Rank= $category_service->get_category_home($where=['ShowHomeRank'=>1],$Orwhere=[], $Limit=7, $oderby ='ShowHomeOrderRank ASC');
        $Categories_Home_Sm= $category_service->get_category_home($where=['ShowHomeSM'=>1],$Orwhere=[], $Limit=5, $oderby ='ShowHomeOrderSM ASC');
      
        // Lịch thi đấu kq PMLeague mới nhất
        $SoccerMathService  = new SoccerMathService();
        $Score_PmLeague = $SoccerMathService->get_ltd_kq(11,['a.LeagueId'=>1]);
        
        //Lây trận đấu Hot
        $Score_Hot = $SoccerMathService->get_ltd_kq(6,['a.Status'=>0, 'a.Hot'=>1]);
        
        
        //Bảng BXH PMLeague mùa giải mới nhất
        $SoccerRankService = new SoccerRankService();
        $Season_StartTime = date('Y-m-d', strtotime($Score_PmLeague['data'][0]['Season_StartTime']));
        $Season_EndTime = date('Y-m-d', strtotime($Score_PmLeague['data'][0]['Season_EndTime']));
        $SoccerRank_PmLeague = $SoccerRankService->get_rank(null,['a.LeagueID'=>1, 'd.StartTime'=>$Season_StartTime, 'd.EndTime'=>$Season_EndTime]);
        
        $Seo_Service = new SeoService();
        $Data_Seo = $Seo_Service->Ic_Seo(['SEO_Key'=>'seo_home']);
        
      
        
//  echo '<xmp>';  
// print_r(json_decode($Data_Seo['Data_Seo'][0]['SEO_Value'], true));die;
	   
        return $this->render('index',[
            'Data_Hot'=>$Data_hot['data'],
            'Data_Feature'=> $Data_Feature['data'],
            'Data_New'=>$Data_New['data'],
            'Categories_Home_Sm'=>$Categories_Home_Sm,
            'Categories_Home_Rank'=>$Categories_Home_Rank,
            'Categories_Home_Big'=>$Categories_Home_Big,
            'Score_PmLeague'=>$Score_PmLeague,
            'SoccerRank_PmLeague'=>$SoccerRank_PmLeague,
            'Score_Hot'=>$Score_Hot,
            'Data_Seo'=>$Data_Seo['Data_Seo']
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionError() {
        return $this->render('error');
    }
}
