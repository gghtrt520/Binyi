<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\httpclient\Client;
use common\models\LoginForm;
use common\models\User;
use common\models\UserAssign;
use backend\components\event\UserEvent;

class SiteController extends Controller
{
    const SUCCESS = 1;
    const FAILED  = 0;

    private $AppID;
    private $AppSecret;

    public function init()
    {
        parent::init();
        $this->AppID     = Yii::$app->params['AppID'];
        $this->AppSecret = Yii::$app->params['AppSecret'];
    }


    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    
    public function actionIndex()
    {
        return ['name'=>'admin','password'=>'qwe123'];
    }

    public function actionList()
    {
        return 456;
    }
    
    public function actionLogin()
    {
        print_r(123);die;
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


}
