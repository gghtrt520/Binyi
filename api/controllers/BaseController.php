<?php
namespace api\controllers;

use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;

class BaseController extends \yii\rest\Controller
{
    public $root_path;

    public function init()
    {
        parent::init();
        $this->root_path = Yii::getAlias('@frontend/web');
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                //使用ComopositeAuth混合认证
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

    public function getErrorMessage($model)
    {
        $errors  = $model->getErrors();
        $first   = array_shift($errors);
        return array_shift($first);
    }

}