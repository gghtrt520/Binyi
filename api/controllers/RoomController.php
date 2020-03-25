<?php
namespace api\controllers;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;

class RoomController extends \yii\rest\Controller
{
    public $root_path;

    public function init(){
        parent::init();
        $this->root_path = Yii::getAlias('@frontend/web');
    }

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


    public function actionShow()
    {
        return 123;
    }

    public function actionUpload()
    {
        $model  = new \common\models\Room();
        $upload = new \common\models\Upload();
        $result = $upload->uploadFile($model,$this->root_path,'avatar_url');
        $path   = Yii::$app->request->hostInfo.$result;
        return [
            'code' => 1,
            'message'=>'上传成功',
            'data' => [
                'path' => $path
            ]
        ];
    }

    public function actionAdd()
    {
        $model  = new \common\models\Room();
        $upload = new \common\models\Upload();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id    = Yii::$app->user->identity->id;
            $model->avatar_url = Yii::$app->request->hostInfo.Yii::$app->homeUrl.$upload->uploadFile($model,$this->root_path,'avatar_url');
            if ($model->save()) {
                return [
                    'code' => 1,
                    'message'=>'操作成功',
                    'data' => $model
                ];
            }
        }else{
            return [
                'code' => 0,
                'message'=>$model->getErrors(),
            ];
        }
    }
}
