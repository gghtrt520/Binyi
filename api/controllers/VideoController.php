<?php
namespace api\controllers;

use Yii;

class GiftController extends BaseController
{

    public function actionVideoUpload()
    {
        $model  = new \common\models\Video();
        $upload = new \common\models\Upload();
        $result = $upload->uploadFile($model, $this->root_path, 'video_path');
        $path   = Yii::$app->request->hostInfo.$result;
        return [
            'code' => 1,
            'message'=>'操作成功',
            'data' => [
                'path' => $path
            ]
        ];
    }


    public function actionVideoCreate()
    {
        $model  = new \common\models\Video();
        $model->name       = Yii::$app->request->post('name');
        $model->room_id    = Yii::$app->request->post('room_id');
        $model->video_path = Yii::$app->request->post('path');
        if($model->save()){
            return [
                'code'    => 1,
                'message' => '操作成功',
                'data'    => $model
            ];
        }else{
            return [
                'code'    => 0,
                'message' =>$this->getErrorMessage($model),
            ];
        }
    }


    public function actionVideoList()
    {
        $room_id = Yii::$app->request->post('room_id');
        $data    = \common\models\Video::find()->where(['room_id'=>$room_id])->asArray()->all();
        return [
            'code'    => 1,
            'message' => '操作成功',
            'data'    => $data
        ];
    }

    



    

    


    
}
