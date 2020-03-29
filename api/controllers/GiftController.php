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
        $gift = \common\models\Gift::find()->joinWith(['user','product'])->where(['gift.room_id'=>$room_id])->orderBy('id desc')->all();
        $option = [
            'common\models\Gift' => [
                'created_at',
                'nick_name'=> function ($post){
                    return $post->user ? $post->user->nick_name:'--';
                },
                'name' => function ($post){
                    return $post->product ? $post->product->name:'--';
                },
                'style' => function ($post){
                    return $post->product ? $post->product->style:'--';
                },
            ],
        ];
        $gift_data = yii\helpers\ArrayHelper::toArray($gift,$option);

        $comment   = \common\models\Comment::find()->where(['room_id'=>$room_id])->orderBy('id desc')->all();
        $option = [
            'common\models\Comment' => [
                'content',
                'user'=> function ($model){
                    return $model->user ? $model->user->nick_name : '游客';
                },
                'created_at'
            ],
        ];
        $comment_list = yii\helpers\ArrayHelper::toArray($comment,$option);
        return [
            'code'    => 1,
            'message' => '操作成功',
            'data'    => [
                'gift'=>$gift_data,
                'comment'=>$comment_list
            ]
        ];
    }

    public function actionPresentCount()
    {
        $room_id = Yii::$app->request->post('room_id');
        $data = \common\models\Gift::find()->where(['room_id'=>$room_id])->groupBy('gift.product_id')->all();
        $return = [];
        if($data){
            foreach($data as $value){
                $return [] = [
                    'name' => $value->product ? $value->product->name : '已删除',
                    'total'=> $value->getCount(),
                    'style'=> $value->product ? $value->product->style : '已删除',
                ];
            }
        }
        return [
            'code'    => 1,
            'message' => '操作成功',
            'data'    => $return
        ];
    }

    



    

    


    
}
