<?php
namespace backend\controllers;

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


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','synchronize-login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
        return $this->render('index');
    }

    
    public function actionLogin()
    {
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


    public function actionSynchronizeLogin()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
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
                return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'接口请求错误']);
            } else {
                $result = User::checkUserExistAndSave($response->data['openid'], $response->data['session_key'], $nick_name, $avatar_url, $gender);
                if ($result) {
                    $event = new UserEvent;
                    $event->user_id = $result->id;
                    $this->trigger(self::INSERT, $event);
                    $user_assign = UserAssign::findOne(['user_id'=>$result->id]);
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
