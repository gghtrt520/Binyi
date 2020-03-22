<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property string $name 贡品名称
 * @property int $price 价格
 * @property int $num 数量
 * @property string $style 贡品样式
 * @property string $norms 贡品规格
 * @property string|null $updated_at 更新时间
 * @property string|null $created_at 创建时间
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'num', 'style', 'norms'], 'required'],
            [['price', 'num'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['name'], 'string', 'max' => 30],
            [['style', 'norms'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Product Name'),
            'price' => Yii::t('app', 'Price'),
            'num' => Yii::t('app', 'Num'),
            'style' => Yii::t('app', 'Style'),
            'norms' => Yii::t('app', 'Norms'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
