<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class AuthController extends Controller
{
    private $login_url = 'https://open.weixin.qq.com/connect/qrconnect?appid=wx07a5baa6f39cd947&redirect_uri=https://xcx.xhbinyi.com/site/wxcallback&response_type=code&scope=snsapi_login&state=STATE';

    public function  init()
    {
        parent::init();
        if(Yii::$app->user->isGuest){
            $this->redirect($this->login_url);
        }
    }


    public function actionMyself()
    {
        $user_id = Yii::$app->user->identity->id;
        $room    = \common\models\Room::find()->where(['user_id'=>$user_id])->all();
        return $this->render('myself',['room'=>$room]);
    }

    public function actionCreate()
    {
        return $this->render('create');
    }

    
}
