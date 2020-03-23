<?php
namespace api\controllers;

use Yii;
use yii\web\UnauthorizedHttpException;
use yii\httpclient\Client;

class SiteController extends \yii\rest\Controller
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

    
    public function actionLogin()
    {
        throw new UnauthorizedHttpException("token验证失败");
    }

}
