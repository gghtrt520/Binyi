<?php
namespace api\controllers;

use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class RoomController extends BaseController
{

    public function actionShow()
    {
        $category = Yii::$app->request->post('category');
        $category = explode(',', $category);
        $data = \common\models\Room::find()->where(['rule'=>1])->andFilterWhere([
            'in','category',$category
        ])->asArray()->all();
        return [
            'code' => 1,
            'message'=>'操作成功',
            'data' => $data
        ];
    }

    public function actionSelf()
    {
        $name    = Yii::$app->request->post('name');
        $user_id = Yii::$app->user->identity->id;
        $data = \common\models\Room::find()->where(['user_id'=>$user_id])->andFilterWhere(['like','name',$name])->asArray()->all();
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

    public function actionAdd()
    {
        $model  = new \common\models\Room();
        $model->user_id = Yii::$app->request->post('user_id');
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
            return [
                'code'    => 1,
                'message' => '操作成功',
                'data'    => $model
            ];
        } else {
            return [
                'code'    => 0,
                'message' =>$this->getErrorMessage($model),
            ];
        }
    }


    public function actionChange()
    {
        $id     = Yii::$app->request->post('id');
        $model  = \common\models\Room::findOne($id);
        if($model){
            $model->avatar_url = Yii::$app->request->post('avatar_url');
            $model->name       = Yii::$app->request->post('name');
            $model->gender     = Yii::$app->request->post('gender');
            $model->birthdate  = Yii::$app->request->post('birthdate');
            $model->death      = Yii::$app->request->post('death');
            $model->age        = Yii::$app->request->post('age');
            $model->description = Yii::$app->request->post('description');
            $model->province   = Yii::$app->request->post('province');
            $model->city       = Yii::$app->request->post('city');
            $model->area       = Yii::$app->request->post('area');
            $model->religion   = Yii::$app->request->post('religion');
            $model->category   = Yii::$app->request->post('category');
            $model->is_pay     = Yii::$app->request->post('is_pay');
            $model->rule       = Yii::$app->request->post('rule');
        }else{
            throw new NotFoundHttpException('数据查询失败');
        }
        if ($model->save()) {
            return [
                'code'    => 1,
                'message' => '操作成功',
                'data'    => $model
            ];
        } else {
            return [
                'code'    => 0,
                'message' =>$this->getErrorMessage($model),
            ];
        }
    }


    public function actionDetail()
    {
        $id = Yii::$app->request->post('id');
        $model = \common\models\Room::findOne($id);
        if($model){
            return [
                'code'    => 1,
                'message' => '操作成功',
                'data'    => $model
            ];
        }else{
            throw new NotFoundHttpException('数据查询失败');
        }
    }


    public function actionChangeBg()
    {
        $id    = Yii::$app->request->post('id');
        $bg_id = Yii::$app->request->post('bg_id');
        $model = \common\models\Room::findOne($id);
        $model->background_id = $bg_id;
        if($model->save()){
            return [
                'code'    => 1,
                'message' => '操作成功'
            ];
        }else{
            return [
                'code'    => 0,
                'message' =>$this->getErrorMessage($model),
            ];
        }
    }


    public function actionDeleteRoom()
    {
        $room_id = Yii::$app->request->post('room_id');
        $model   = \common\models\Room::findOne($room_id);
        if($model->delete()){
            return [
                'code'   => 1,
                'message'=> '操作成功'
            ];
        }else{
            return [
                'code'    => 0,
                'message' =>$this->getErrorMessage($model),
            ];
        }
    }

    public function actionCommentList()
    {
        $room_id = Yii::$app->request->post('room_id');
        $model   = \common\models\Comment::find()->where(['room_id'=>$room_id])->all();
        $option = [
            'common\models\Comment' => [
                'content',
                'user'=> function ($model){
                    return $model->user ? $model->user->nick_name : '游客';
                },
                'created_at'
            ],
        ];
        $data = yii\helpers\ArrayHelper::toArray($model,$option);
        return [
            'code'   => 1,
            'message'=> '操作成功',
            'data'=>$data
        ];
    }

    public function actionRoomSetting()
    {
        $model = \common\models\Setting::findOne(['key'=>'room_price']);
        return [
            'code'   => 1,
            'message'=> '操作成功',
            'data'=> [
                'price'=>$model->price
            ]
        ];
    }


    
}
