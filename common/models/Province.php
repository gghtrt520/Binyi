<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%province}}".
 *
 * @property int $id 自增列
 * @property string $province_code 省份代码
 * @property string $province_name 省份名称
 * @property string $lng 经度
 * @property string $lat 纬度
 * @property int $sort 排序
 * @property string $created_at 创建时间
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%province}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_code', 'province_name'], 'required'],
            [['sort'], 'integer'],
            [['created_at'], 'safe'],
            [['province_code'], 'string', 'max' => 40],
            [['province_name'], 'string', 'max' => 50],
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
            'province_code' => 'Province Code',
            'province_name' => '省',
            'lng' => 'Lng',
            'lat' => 'Lat',
            'sort' => 'Sort',
            'created_at' => 'Created At',
        ];
    }
}
