<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%property_unit}}".
 *
 * @property int $id
 * @property string $name 产权单位名称
 * @property int $province_code 省代码
 * @property int $city_code 市代码
 * @property int $area_code 区或县代码
 * @property int $parent_id 父级ID
 * @property int $user_id 用户ID
 * @property string $created_at
 */
class PropertyUnit extends \yii\db\ActiveRecord
{
    
    public $data = [];

    public static function tableName()
    {
        return '{{%property_unit}}';
    }

    
    public function rules()
    {
        return [
            [['name', 'province_code','user_id'], 'required'],
            ['city_code','integer'],
            ['area_code','integer'],
            ['level','integer', 'message' => '请选择父级单位'],
            ['level', 'default', 'value' => 1],
            ['parent_id', 'default', 'value' => 0],
            [['province_code', 'parent_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => '产权单位',
            'province_code' => '省',
            'city_code' => '市',
            'area_code' => '区或县',
            'parent_id' => '父级单位',
            'level' => '父级产权等级',
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => '创建时间',
        ];
    }


    public function search($params)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
        ]);
        $this->load($params);
        if (!$this -> validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like','name',$this->name]);
        return $dataProvider;
    }


    public static function getPropertyList()
    {
        $all =  self::find()->select(['id','name'])->asArray()->all();
        if ($all) {
            return ArrayHelper::map($all, 'id', 'name');
        } else {
            return [];
        }
    }


    public static function getPropertyFather($level)
    {
        $all =  self::find()->select(['id','name'])->where(['level'=>$level])->asArray()->all();
        if ($all) {
            return ArrayHelper::map($all, 'id', 'name');
        } else {
            return [];
        }
    }


    public static function getProvince()
    {
        $all =  Province::find()->select(['province_code','province_name'])->asArray()->all();
        if ($all) {
            return ArrayHelper::map($all, 'province_code', 'province_name');
        } else {
            return [];
        }
    }

    public static function getCityClone($province_code)
    {
        $all =  City::find()->select(['city_code','city_name'])->where(['province_code'=>$province_code])->asArray()->all();
        if ($all) {
            return ArrayHelper::map($all, 'city_code', 'city_name');
        } else {
            return [];
        }
    }

    public static function getAreaClone($city_code)
    {
        $all =  Area::find()->select(['area_code','area_name'])->where(['city_code'=>$city_code])->asArray()->all();
        if ($all) {
            return ArrayHelper::map($all, 'area_code', 'area_name');
        } else {
            return [];
        }
    }

    public static function getCity($province_code)
    {
        $all =  City::find()->select(['city_code','city_name'])->where(['province_code'=>$province_code])->asArray()->all();
        return $all;
    }

    public static function getArea($city_code)
    {
        $all =  Area::find()->select(['area_code','area_name'])->where(['city_code'=>$city_code])->asArray()->all();
        return $all;
    }


    public static function getProperty($level, $property_unit_id)
    {
        $son  = new PropertyUnit();
        $son->getSon($property_unit_id);
        $all =  self::find()->select(['id','name'])->where(['level'=>$level])->andWhere(['!=','id',$property_unit_id])->andFilterWhere([
            'not in','id',$son->data
        ])->asArray()->all();
        return $all;
    }

    public static function getLevel($level)
    {
        $all =  self::find()->select('level')->where(['level'=>$level])->groupBy('level')->asArray()->all();
        return $all;
    }


    public function getProvinceName()
    {
        return $this->hasOne(Province::className(), ['province_code'=>'province_code']);
    }

    public function getCityName()
    {
        return $this->hasOne(City::className(), ['city_code'=>'city_code']);
    }

    public function getAreaName()
    {
        return $this->hasOne(Area::className(), ['area_code'=>'area_code']);
    }


    public static function getLevelList()
    {
        $data = [];
        $all  = self::find()->select('level')->groupBy('level')->asArray()->all();
        if ($all) {
            return ArrayHelper::map($all, 'level', 'level');
        } else {
            return [];
        }
    }



    public function getSon($id)
    {
        $result = self::find()->where(['parent_id'=>$id])->all();
        if ($result) {
            foreach ($result as $value) {
                $this->data[] = $value['id'];
                $this->getSon($value['id']);
            }
        }
    }
}
