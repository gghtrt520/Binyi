<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%unit_category}}".
 *
 * @property int $id
 * @property int $root
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property string $name
 * @property string $icon
 * @property int $icon_type
 * @property int $active
 * @property int $selected
 * @property int $disabled
 * @property int $readonly
 * @property int $visible
 * @property int $collapsed
 * @property int $movable_u
 * @property int $movable_d
 * @property int $movable_l
 * @property int $movable_r
 * @property int $removable
 * @property int $removable_all
 * @property int $child_allowed
 */
class UnitCategory extends \kartik\tree\models\Tree
{
    
    public static function tableName()
    {
        return '{{%unit_category}}';
    }

  
    


    public function isDisabled()
    {
        if (Yii::$app->user->identity->username !== 'admin') {
            return true;
        }
        return parent::isDisabled();
    }


    public static function getOtherCategory($lvl)
    {
        $all =  self::find()->where(['lvl'=>$lvl,'active'=>1,'visible'=>1])->select(['id','name'])->asArray()->all();
        if ($all) {
            return ArrayHelper::map($all, 'id', 'name');
        } else {
            return [];
        }
    }

    public static function getOtherCategoryByUp($first_id, $lvl)
    {
        $root = self::findOne($first_id);
        $all  = self::find()->where()->asArray([
            'and',
            ['root'=>$root->root],
            ['lvl'=>$lvl],
            ['>','lft',$root->lft],
            ['<','rgt',$root->rgt]
        ])->all();
        if ($all) {
            return ArrayHelper::map($all, 'id', 'name');
        } else {
            return [];
        }
    }

    public static function getApiCategory($lvl)
    {
        return self::find()->where(['lvl'=>$lvl,'active'=>1,'visible'=>1])->select(['id','name'])->asArray()->all();
    }
}
