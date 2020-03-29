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

    public function actionIndex()
    {
        return ['message'=>'这是一个测试'];
    }
    
    public function actionLogin()
    {
        /* $login = new \api\models\LoginForm();
        $login->setAttributes(Yii::$app->getRequest()->post());
        if ($user = $login->login()) {
            if ($user instanceof yii\web\IdentityInterface) {
                return [
                    'access_token' => $user->access_token,
                ];
            } else {
                return $user->errors;
            }
        } else {
            return $login->errors;
        } */

        $js_code    = Yii::$app->request->post('js_code');
        $nick_name  = Yii::$app->request->post('nick_name');
        $avatar_url = Yii::$app->request->post('avatar_url');
        $gender     = Yii::$app->request->post('gender');
        $client   = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://api.weixin.qq.com/sns/jscode2session')
            ->setData([
                'appid'      => $this->AppID,
                'secret'     => $this->AppSecret,
                'js_code'    => $js_code,
                'grant_type' => 'authorization_code'
            ])->send();
        if ($response->isOk) {
            if (isset($response->data['errcode'])) {
                return ['code'=>self::FAILED,'message'=>'接口请求错误'];
            } else {
                $result = \common\models\User::checkUserExistAndSave($response->data['openid'], $response->data['session_key'], $nick_name, $avatar_url, $gender);
                if ($result) {
                    return [
                        'code'    => self::SUCCESS,
                        'data'    => ['openid'=> $response->data['openid'],'access_token'=> $result->access_token,'user_id'=>$result->id],
                        'message' => '请求成功'
                    ];
                } else {
                    return ['code'=>self::FAILED,'message'=>'数据保存错误'];
                }
            }
        } else {
            return ['code'=>self::FAILED,'message'=>'接口请求错误'];
        }

    }


    public function actionPayBack()
    {
        $pay = Yii::$app->pay->wechat();
        try{
            $data = $pay->verify();
        } catch (\Exception $e) {
            $e->getMessage();
        }
        $model = \common\models\Pay::findOne($data->out_trade_no);
        $model->is_success = 1;
        if($pay->save()){
            return $pay->success()->send();
        }else{
            return $model->getErrors();
        }
    }

}
