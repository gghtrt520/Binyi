<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%combination}}".
 *
 * @property int $id
 * @property string $name 预约的名称
 * @property string $description 详情
 * @property int $price 套餐价格 默认0
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class Combination extends \common\models\Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%combination}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['price'], 'integer'],
            ['price', 'default', 'value' =>0],
            [['updated_at', 'created_at'], 'safe'],
            [['name'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Combinations Name'),
            'description' => Yii::t('app', 'Combinations Description'),
            'price' => Yii::t('app', 'Price'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
