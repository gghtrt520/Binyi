<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user_assign}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rule 0:无权限 1:所有权限 2:地区权限 3:养护单位 4:施工单位 5:产权单位 
 * @property string $is_write
 * @property string $rule_data 权限数据 ‘’
 * @property int $apply_rule 0:未申请权限 1:申请权限 2:已分配权限
 */
class UserAssign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_assign}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'rule','apply_rule'], 'integer'],
            [['is_write'], 'string'],
            [['rule_data'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'rule' => '权限类型',
            'is_write' => '录入权限',
            'rule_data' => '权限数据',
            'apply_rule'=>'权限申请'
        ];
    }


    public static function show($value)
    {
        $data = [];
        if ($value == 1) {
            return ['所有权限'];
        }
        if ($value == 2) {
            $data = TreeInformation::find()->select(['id','district as name'])->asArray()->all();
            return ArrayHelper::map($data, 'name', 'name');
        }
        if ($value == 3) {
            $data = ConservationUnit::find()->select(['id','name'])->asArray()->all();
        }
        if ($value == 4) {
            $data = ConstructionUnit::find()->select(['id','name'])->asArray()->all();
        }
        if ($value == 5) {
            $data = PropertyUnit::find()->select(['id','name'])->asArray()->all();
        }
        if ($data) {
            return ArrayHelper::map($data, 'id', 'name');
        } else {
            return [];
        }
    }
}
