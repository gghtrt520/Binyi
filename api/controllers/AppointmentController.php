<?php
namespace api\controllers;

use Yii;

class AppointmentController extends BaseController
{

    public function actionAppointmentCreate()
    {
        $model = new \common\models\Appointment();
        $model->cemetery = Yii::$app->request->post('cemetery');
        $model->cemetery_num = (string)Yii::$app->request->post('cemetery_num');
        $model->date     = Yii::$app->request->post('date');
        $model->start    = Yii::$app->request->post('start');
        $model->end      = Yii::$app->request->post('end');
        $model->combination_id = Yii::$app->request->post('combination_id');
        if($model->save()){
            $person = new \common\models\AppointmentPerson();
            $person->appointment_id = $model->attributes['id'];
            $person->name   = Yii::$app->request->post('name');
            $person->idcard = Yii::$app->request->post('idcard');
            $person->phone  = Yii::$app->request->post('phone');
            if($person->save()){
                return [
                    'code' => 1,
                    'message'=>'操作成功',
                ];
            }else{
                return [
                    'code'    => 0,
                    'message' =>$this->getErrorMessage($person),
                ];
            }
        }else{
            return [
                'code'    => 0,
                'message' =>$this->getErrorMessage($model),
            ];
        }
    }


    



    

    


    
}
