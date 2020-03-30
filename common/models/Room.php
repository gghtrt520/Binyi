<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%room}}".
 *
 * @property int $id
 * @property string $avatar_url 头像
 * @property string $surname 姓
 * @property string $name 名
 * @property string $gender 性别
 * @property string $birthdate 生辰
 * @property string $death 忌日
 * @property int $age 年龄
 * @property string $native 籍贯
 * @property string $religion 宗教
 * @property string $relation 关系
 * @property int $rule 查看权限 0:私有 1:公开
 * @property string|null $updated_at 更新时间
 * @property string|null $created_at 创建时间
 */
class Room extends Base
{

    public static function tableName()
    {
        return '{{%room}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'gender', 'birthdate', 'death', 'age', 'province','city' ,'area','religion','category','description','rule'], 'required'],
            [['gender'], 'string'],
            [['birthdate', 'death'], 'date'],
            [['updated_at', 'created_at'], 'safe'],
            [['age', 'rule','is_show','user_id','background_id','is_pay'], 'integer'],
            ['background_id', 'default', 'value' =>0],
            ['is_pay', 'default', 'value' =>0],
            ['rule', 'default', 'value' =>0],
            [['avatar_url'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 100],
            [['name', 'religion','province','city','area','category'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'avatar_url' => Yii::t('app', 'Death Avatar Url'),
            'name' => Yii::t('app', 'Name'),
            'gender' => Yii::t('app', 'Gender'),
            'birthdate' => Yii::t('app', 'Birthdate'),
            'death' => Yii::t('app', 'Death'),
            'age' => Yii::t('app', 'Age'),
            'description' => Yii::t('app', 'Description'),
            'province' => Yii::t('app', 'Province'),
            'city' => Yii::t('app', 'City'),
            'area' => Yii::t('app', 'Area'),
            'religion' => Yii::t('app', 'Religion'),
            'category' => Yii::t('app', 'Category'),
            'rule' => Yii::t('app', 'Rule'),
            'background_id'=>Yii::t('app', 'Background Name'),
            'is_pay'=>Yii::t('app', 'Is Pay'),
            'is_show' => Yii::t('app', 'Is Show'),
            'user_id' => Yii::t('app', 'User Id'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getBackground()
    {
        return $this->hasOne(Background::className(),['id'=>'background_id']);
    }
}
