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


    public function actionPaySuccess()
    {
        $order = [
            'out_trade_no' => time(),
            'total_fee'    => '1',
            'body'         => 'test body - 测试',
            'openid'       => 'o4kYL4yivEMXVydsDh7OUpv9qMkA',
        ];
        $pay = Yii::$app->pay->wechat()->miniapp($order);
        return [
            'code' => 1,
            'message'=>'操作成功',
            'data' =>$pay
        ];
    }


    public function actionPayBack()
    {
        $pay = new \common\models\Pay();
        $pay->type = 1;
        $pay->pay_num = 1;
        $pay->user_id = 1;
        $pay->type_id = 1;
        if($pay->save()){
            $pay = Yii::$app->pay->wechat();
            try{
                $data = $pay->verify();
            } catch (\Exception $e) {
                $e->getMessage();
            }
            return $pay->success()->send();
        }else{
            return $pay->getErrors();
        }
    }


    



    

    


    
}
