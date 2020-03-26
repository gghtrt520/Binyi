<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%gift}}".
 *
 * @property int $id
 * @property int $room_id
 * @property int $product_id
 * @property int $user_id
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class Gift extends \common\models\Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%gift}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'product_id', 'user_id'], 'required'],
            [['room_id', 'product_id', 'user_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'room_id' => Yii::t('app', 'Room ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(),['id'=>'product_id']);
    }

    public function getRoom()
    {
        return $this->hasOne(Room::className(),['id'=>'room_id']);
    }
}
