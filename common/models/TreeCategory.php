<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%tree_category}}".
 *
 * @property int $id
 * @property string $name 树种名称
 * @property int $user_id 用户ID
 * @property string $created_at
 */
class TreeCategory extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%tree_category}}';
    }

    
    public function rules()
    {
        return [
            [['category', 'name', 'user_id'], 'required'],
            [['category'], 'string'],
            [['user_id'], 'integer'],
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
            'category' => '树种所属类别',
            'name' => '树种分类',
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }


    public function search($params)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
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


    public static function getCategoryList()
    {
        $all =  self::find()->select(['id','name'])->asArray()->all();
        if ($all) {
            return ArrayHelper::map($all, 'id', 'name');
        } else {
            return [];
        }
    }
}
