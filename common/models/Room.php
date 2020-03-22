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
    /**
     * {@inheritdoc}
     */
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
            [['avatar_url', 'surname', 'name', 'gender', 'birthdate', 'death', 'age', 'native', 'religion', 'relation'], 'required'],
            [['gender'], 'string'],
            [['birthdate', 'death', 'updated_at', 'created_at'], 'safe'],
            [['age', 'rule'], 'integer'],
            [['avatar_url'], 'string', 'max' => 150],
            [['surname', 'name', 'religion', 'relation'], 'string', 'max' => 30],
            [['native'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'avatar_url' => Yii::t('app', 'Avatar Url'),
            'surname' => Yii::t('app', 'Surname'),
            'name' => Yii::t('app', 'Name'),
            'gender' => Yii::t('app', 'Gender'),
            'birthdate' => Yii::t('app', 'Birthdate'),
            'death' => Yii::t('app', 'Death'),
            'age' => Yii::t('app', 'Age'),
            'native' => Yii::t('app', 'Native'),
            'religion' => Yii::t('app', 'Religion'),
            'relation' => Yii::t('app', 'Relation'),
            'rule' => Yii::t('app', 'Rule'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
