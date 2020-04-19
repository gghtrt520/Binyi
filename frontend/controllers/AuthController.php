<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class AuthController extends Controller
{



    public function actionMyself()
    {
        return $this->render('myself');
    }

    public function actionCreate()
    {
        return $this->render('create');
    }

    
}
