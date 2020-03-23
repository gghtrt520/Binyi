<?php


namespace frontend\widgets;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class Menu extends \yii\base\Widget
{
    
    public function run()
    {
        parent::run();
        return $this->getItem();
    }

    private function getItem()
    {
        $items = \common\models\FrontendMenu::find()->asArray()->all();
        foreach ($items as $value) {
            $return[] = [
                'label' => $value['name'],
                'url'   => [Url::to($value['route'])]
            ]; 
        }
        return $return;
    }

    
}