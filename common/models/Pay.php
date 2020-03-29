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
            [['type', 'pay_num', 'user_id', 'type_id'], 'required'],
            [['type', 'pay_num', 'user_id', 'type_id','is_success'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['pay_order'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pay_order' => Yii::t('app', 'Pay Order'),
            'type' => Yii::t('app', 'Pay Type'),
            'pay_num' => Yii::t('app', 'Pay Num'),
            'user_id' => Yii::t('app', 'Pay User ID'),
            'type_id' => Yii::t('app', 'Pay Type ID'),
            'is_success' => Yii::t('app', 'Is Success'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getPayProduct()
    {
        if($this->type == 1){
            return $this->hasOne(Room::className(),['id'=>'type_id']);
        }elseif ($this->type == 2) {
            return $this->hasOne(Background::className(),['id'=>'type_id']);
        }elseif ($this->type == 3) {
            return $this->hasOne(Product::className(),['id'=>'type_id']);
        }elseif ($this->type == 4) {
            return $this->hasOne(Combination::className(),['id'=>'type_id']);
        }else {
            return false;
        }
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}