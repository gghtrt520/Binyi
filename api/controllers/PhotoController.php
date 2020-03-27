<?php
namespace api\controllers;

use Yii;

class PhotoController extends BaseController
{

    public function actionPhotoCreate()
    {
        $model   = new \common\models\Photo(); 
        $model->room_id = Yii::$app->requset->post('room_id');
        $model->name    = Yii::$app->requset->post('name');
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

    public function actionPhotoDetail()
    {   
        $room_id = Yii::$app->requset->post('room_id');
        $model   = \common\models\Photo::find()->where(['room_id'=>$room_id])->all();
        $option = [
            'common\models\Photo' => [
                'name',
                'detail'=> function ($post){
                    return $post->photoList;
                },
            ],
        ];
        $data = yii\helpers\ArrayHelper::toArray($model,$option);
        return [
            'code'    => 1,
            'message' => '操作成功',
            'data'    => $data
        ];

    }


    public function actionPhotoUpload()
    {
        $model  = new \common\models\PhotoList();
        $upload = new \common\models\Upload();
        $result = $upload->uploadFile($model, $this->root_path, 'photo_url');
        $path   = Yii::$app->request->hostInfo.$result;
        return [
            'code' => 1,
            'message'=>'操作成功',
            'data' => [
                'path' => $path
            ]
        ];
    }


    public function actionPhotoListCreate()
    {
        $model  = new \common\models\PhotoList();
        $model->photo_id = Yii::$app->requset->post('photo_id');
        $model->photo_url = Yii::$app->requset->post('photo_url');
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
    

    public function actionPhotoListDetail()
    {
        $photo_id = Yii::$app->requset->post('photo_id');
        $data = \common\models\PhotoList::find()->where(['photo_id'=>$photo_id])->asArray()->all();
        return [
            'code'    => 1,
            'message' => '操作成功',
            'data'    => $data
        ];
    }



    

    


    
}
