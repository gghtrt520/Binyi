<?php
namespace api\controllers;

use Yii;

class GiftController extends BaseController
{


    public function actionPresent()
    {
        $model = new \common\models\Gift();
        $model->user_id = Yii::$app->user->identity->id;
        $model->room_id = Yii::$app->request->post('room_id');
        $model->product_id = Yii::$app->request->post('product_id');
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


    public function actionPresentList()
    {
        $room_id = Yii::$app->request->post('room_id');
        $data = \common\models\Gift::find()->select([
            'user.nick_name','product.name','gift.created_at'
        ])->where([
            'room_id'=>$room_id
        ])->joinWith(['user','product'])->asArray()->all();
        return [
            'code'    => 1,
            'message' => '操作成功',
            'data'    => $model
        ];
    }

    



    

    


    
}
