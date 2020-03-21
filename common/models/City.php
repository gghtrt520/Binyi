<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property int $id 自增列
 * @property string $city_code 市代码
 * @property string $city_name 市名称
 * @property string $province_code 省代码
 * @property string $lng 经度
 * @property string $lat 纬度
 * @property int $sort 排序
 * @property string $created_at 创建时间
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_code', 'city_name'], 'required'],
            [['sort'], 'integer'],
            [['created_at'], 'safe'],
            [['city_code', 'city_name', 'province_code'], 'string', 'max' => 40],
            [['lng', 'lat'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_code' => 'City Code',
            'city_name' => '市',
            'province_code' => 'Province Code',
            'lng' => 'Lng',
            'lat' => 'Lat',
            'sort' => 'Sort',
            'created_at' => 'Created At',
        ];
    }
}
