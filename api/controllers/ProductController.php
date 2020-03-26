<?php
namespace api\controllers;

use Yii;

class ProductController extends BaseController
{


    public function actionList()
    {
        $data  = \common\models\Product::find()->asArray()->all();
        return [
            'code'    => 1,
            'message' => '操作成功',
            'data'    => $data
        ];
    }

    



    

    


    
}
