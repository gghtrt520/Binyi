<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%background}}".
 *
 * @property int $id
 * @property string $background
 * @property int $price
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class Background extends \common\models\Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%background}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','background'], 'required'],
            [['price'], 'integer'],
            ['price', 'default', 'value' =>0],
            [['updated_at', 'created_at'], 'safe'],
            [['background'], 'string', 'max' => 200],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Background Name'),
            'background' => Yii::t('app', 'Background'),
            'price' => Yii::t('app', 'Price'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }


    public static function getList()
    {
        $data = self::find()->select('id,name')->all();
        $data = \yii\helpers\ArrayHelper::map(array_merge($data), 'id', 'name');
        return $data;
    }
}
