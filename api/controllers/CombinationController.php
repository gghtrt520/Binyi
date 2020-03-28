<?php
namespace api\controllers;

use Yii;

class CombinationController extends BaseController
{

    public function actionCombinationList()
    {
        $data = \common\models\Combination::find()->asArray()->all();
        return [
            'code'   => 1,
            'message'=> '操作成功',
            'data'   => $data
        ];
    }


    



    

    


    
}
