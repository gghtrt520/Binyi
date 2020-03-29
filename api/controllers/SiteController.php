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


    public function actionAddComment()
    {
        $path  = Yii::getAlias('@frontend/web').'/upload/key.txt';
        $list  = explode('|',file_get_contents($path)); 
        $model = new \common\models\Comment();
        $model->content = $this->sensitive($list, Yii::$app->request->post('content'));
        $model->room_id = Yii::$app->request->post('room_id');
        $model->user_id = Yii::$app->request->post('user_id');
        if($model->save()){
            return [
                'code'    => 1,
                'message' => '操作成功',
                'data'    => $model
            ];
        }else{
            return [
                'code'    => 0,
                'message' =>$model->getErrors(),
            ];
        }
    }



    public function sensitive($list, $string){
        $count = 0; 
        $sensitiveWord = ''; 
        $stringAfter = $string; //替换后的内容
        $pattern = "/".implode("|",$list)."/i"; //定义正则表达式
        if(preg_match_all($pattern, $string, $matches)){ //匹配到了结果
            $patternList = $matches[0]; //匹配到的数组
            $count = count($patternList);
            $sensitiveWord = implode(',', $patternList); //敏感词数组转字符串
            $replaceArray = array_combine($patternList,array_fill(0,count($patternList),'*')); //把匹配到的数组进行合并，替换使用
            $stringAfter = strtr($string, $replaceArray); //结果替换
        }
        return $stringAfter;
       }



    public function actionPayBack()
    {
        $pay = Yii::$app->pay->wechat();
        try{
            $data = $pay->verify();
        } catch (\Exception $e) {
            $e->getMessage();
        }
        $model = \common\models\Pay::findOne(['pay_order'=>$data->out_trade_no]);
        $model->is_success = 1;
        if($model->save()){
            if($model->type == 1){
                $room = \common\models\Room::findOne($model->type_id);
                $room->is_pay = 1;
                $room ->save();
            }
            return $pay->success()->send();exit;
        }else{
            return $model->getErrors();
        }
    }

}
