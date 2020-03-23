<?php
namespace api\controllers;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;

class RoomController extends \yii\rest\ActiveController
{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    HttpBasicAuth::className(),
                    HttpBearerAuth::className(),
                    [
                        'class' => QueryParamAuth::className(),
                        'tokenParam' => 'access_token',
                    ]
                ]
            ]
        ]);
    }


    public $modelClass = "api\models\Room";

    public function actionShow()
    {
        return 123;
    }
}
