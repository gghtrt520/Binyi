<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%pay}}".
 *
 * @property int $id
 * @property int $type 付费产品 1:房间 2:背景 3:贡品
 * @property int $pay_num 付费金额
 * @property int $user_id 付费用户
 * @property int $type_id 付费产品的ID
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class Pay extends \common\models\Base
{
    
    public static function tableName()
    {
        return '{{%pay}}';
    }

    
    public function rules()
    {
        return [
            [['id', 'type', 'pay_num', 'user_id', 'type_id'], 'required'],
            [['id', 'type', 'pay_num', 'user_id', 'type_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Pay Type'),
            'pay_num' => Yii::t('app', 'Pay Num'),
            'user_id' => Yii::t('app', 'Pay User ID'),
            'type_id' => Yii::t('app', 'Pay Type ID'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}