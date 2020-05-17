<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class AuthController extends Controller
{
    private $login_url = 'https://open.weixin.qq.com/connect/qrconnect?appid=wx07a5baa6f39cd947&redirect_uri=https://xcx.xhbinyi.com/site/wxcallback&response_type=code&scope=snsapi_login&state=STATE';
    private $root_path;
    
    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect($this->login_url);
        }
        $this->root_path = Yii::getAlias('@frontend/web');
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
        return $this->asJson([
            'code' => 1,
            'message'=>'操作成功',
            'data' => [
                'path' => $path
            ]
        ]);
    }

    public function actionAdd()
    {
        $model  = new \common\models\Room();
        $model->user_id = Yii::$app->user->identity->id;
        $model->avatar_url = Yii::$app->request->post('avatar_url');
        $model->name = Yii::$app->request->post('name');
        $model->gender = Yii::$app->request->post('gender');
        $model->birthdate = Yii::$app->request->post('birthdate');
        $model->death = Yii::$app->request->post('death');
        $model->description = Yii::$app->request->post('description');
        $model->age = Yii::$app->request->post('age');
        $model->province = Yii::$app->request->post('province');
        $model->city = Yii::$app->request->post('city');
        $model->area = Yii::$app->request->post('area');
        $model->religion = Yii::$app->request->post('religion');
        $model->category = Yii::$app->request->post('category');
        $model->is_pay     = Yii::$app->request->post('is_pay');
        $model->rule = Yii::$app->request->post('rule');
        if ($model->save()) {
            return  $this->asJson([
                'code'    => 1,
                'message' => '操作成功',
                'data'    => $model
            ]);
        } else {
            return  $this->asJson([
                'code'    => 0,
                'message' =>$this->getErrorMessage($model),
            ]);
        }
    }

    
}
