<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;

class BaseController extends Controller
{
    private $user;
    public function init()
    {
        parent::init();
    }
}
