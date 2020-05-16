<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class AuthController extends Controller
{
    $login_url = 'https://open.weixin.qq.com/connect/qrconnect?appid=wx07a5baa6f39cd947&redirect_uri=https://xcx.xhbinyi.com/site/wxcallback&response_type=code&scope=snsapi_login&state=STATE';

    public function  init()
    {
        if(Yii::$app->user->isGest){
            $this->redirect($login_url);
        }else{
            parent::init();
        }
    }


    public function actionMyself()
    {
        return $this->render('myself');
    }

    public function actionCreate()
    {
        return $this->render('create');
    }

    
}
