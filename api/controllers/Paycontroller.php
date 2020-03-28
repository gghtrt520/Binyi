<?php
namespace api\controllers;

use Yii;

class Paycontroller extends BaseController
{

    public function actionPayCreate()
    {
        $model = new  \common\models\Pay();
        $model->type    = Yii::$app->request->post('type');
        $model->pay_num = Yii::$app->request->post('pay_num');
        $model->user_id = Yii::$app->request->post('user_id');
        $model->type_id = Yii::$app->request->post('type_id');
        if($model->save()){
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


    


    
}
