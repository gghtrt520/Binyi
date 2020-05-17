<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class AuthController extends Controller
{
    private $login_url = 'https://open.weixin.qq.com/connect/qrconnect?appid=wx07a5baa6f39cd947&redirect_uri=https://xcx.xhbinyi.com/site/wxcallback&response_type=code&scope=snsapi_login&state=STATE';
    private $root_path = Yii::getAlias('@frontend/web');
    
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect($this->login_url);
        }
        return parent::beforeAction($action);
    }

    public function actionMyself()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect($this->login_url);
        }
        $user_id = Yii::$app->user->identity->id;
        $room    = \common\models\Room::find()->where(['user_id'=>$user_id])->all();
        return $this->render('myself',['room'=>$room]);
    }

    public function actionCreate()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect($this->login_url);
        }
        return $this->render('create');
    }

    public function actionUpload()
    {
        $model  = new \common\models\Room();
        $upload = new \common\models\Upload();
        $result = $upload->uploadFile($model, $this->root_path, 'avatar_url');
        $path   = Yii::$app->request->hostInfo.$result;
        return [
            'code' => 1,
            'message'=>'操作成功',
            'data' => [
                'path' => $path
            ]
        ];
    }

    
}
