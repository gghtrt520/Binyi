<?php
namespace api\controllers;
use Yii;

class RoomController extends BaseController
{

    public function actionShow(){
        return ['user'=> Yii::$app->user->identity];
    }
}
