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


    public function actionShow($category)
    {
        $data = \common\models\Room::find()->where(['rule'=>1])->andFilterWhere([
            'in','category',$category
        ])->asArray()->all();
        return [
            'code' => 1,
            'message'=>'操作成功',
            'data' => $data
        ];
    }

    public function actionUpload()
    {
        $model  = new \common\models\Room();
        $upload = new \common\models\Upload();
        $result = $upload->uploadFile($model,$this->root_path,'avatar_url');
        $path   = Yii::$app->request->hostInfo.$result;
        return [
            'code' => 1,
            'message'=>'操作成功',
            'data' => [
                'path' => $path
            ]
        ];
    }

    public function actionAdd()
    {
        $model  = new \common\models\Room();
        $model->user_id = Yii::$app->request->post('user_id');
        $model->avatar_url = Yii::$app->request->post('avatar_url');
        $model->name = Yii::$app->request->post('name');
        $model->gender = Yii::$app->request->post('gender');
        $model->birthdate = Yii::$app->request->post('birthdate');
        $model->death = Yii::$app->request->post('death');
        $model->age = Yii::$app->request->post('age');
        $model->province = Yii::$app->request->post('province');
        $model->city = Yii::$app->request->post('city');
        $model->area = Yii::$app->request->post('area');
        $model->religion = Yii::$app->request->post('religion');
        $model->category = Yii::$app->request->post('category');
        $model->rule = Yii::$app->request->post('rule');
        if ($model->save()) {
            return [
                'code'    => 1,
                'message' => '操作成功',
                'data'    => $model
            ];
        }else {
            return [
                'code'    => 0,
                'message' =>$this->getErrorMessage($model),
            ];
        }
    }


    public  function getErrorMessage($model) {
        $errors  = $model->getErrors();
        $first   = array_shift($errors);
        return array_shift($first);
    }
}
