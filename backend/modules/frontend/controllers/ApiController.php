<?php

namespace app\modules\frontend\controllers;

use yii\web\Controller;

/**
 * Default controller for the `frontend` module
 */
class ApiController extends Controller
{
    const SUCCESS = 0;
    const FAILED  = 1;

    private $AppID;
    private $AppSecret;

    public function init()
    {
        parent::init();
        $this->AppID     = Yii::$app->params['AppID'];
        $this->AppSecret = Yii::$app->params['AppSecret'];
    }
    
    public function actionSynchronizeLogin()
    {
        $code       = Yii::$app->request->post('code');
        $nick_name  = Yii::$app->request->post('nick_name');
        $avatar_url = Yii::$app->request->post('avatar_url');
        $gender     = Yii::$app->request->post('gender');
        $client   = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://api.weixin.qq.com/sns/oauth2/access_token')
            ->setData([
                'appid'      => $this->AppID,
                'secret'     => $this->AppSecret,
                'code'       => $js_code,
                'grant_type' => 'authorization_code'
            ])->send();
        if ($response->isOk) {
            if (isset($response->data['errcode'])) {
                return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'接口请求错误']);
            } else {
                $result = User::checkUserExistAndSave($response->data['openid'], $response->data['session_key'], $nick_name, $avatar_url, $gender);
                if ($result) {
                    return $this->asJson(['status'=>self::SUCCESS,'data'=>[
                        'openid'      => $response->data['openid'],
                        'rule'        => $user_assign->rule,
                        'is_write'    => $user_assign->is_write,
                        'apply_rule'  => $user_assign->apply_rule
                    ],'message'=>'请求成功']);
                } else {
                    return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'数据保存错误']);
                }
            }
        } else {
            return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'接口请求错误']);
        }
    }
}