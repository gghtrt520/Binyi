<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%area}}".
 *
 * @property int $id 自增列
 * @property string $area_code 区代码
 * @property string $city_code 父级市代码
 * @property string $area_name 市名称
 * @property string $lng 经度
 * @property string $lat 纬度
 * @property int $sort 排序
 * @property string $created_at 创建时间
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%area}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['area_code', 'area_name'], 'required'],
            [['sort'], 'integer'],
            [['created_at'], 'safe'],
            [['area_code', 'city_code', 'area_name'], 'string', 'max' => 40],
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
            'area_code' => 'Area Code',
            'city_code' => 'City Code',
            'area_name' => '区或县',
            'lng' => 'Lng',
            'lat' => 'Lat',
            'sort' => 'Sort',
            'created_at' => 'Created At',
        ];
    }
}
