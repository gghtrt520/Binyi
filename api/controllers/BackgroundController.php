<?php
namespace api\controllers;

use Yii;

class BackgroundController extends BaseController
{


    public function actionBglist()
    {
        $data  = \common\models\Background::find()->asArray()->all();
        return [
            'code'    => 1,
            'message' => '操作成功',
            'data'    => $data
        ];
    }

    



    

    


    
}
