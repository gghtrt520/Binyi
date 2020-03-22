<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%frontend_menu}}".
 *
 * @property int $id
 * @property string $name 菜单名称
 * @property string $route 路由信息
 * @property int $order 排序
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class FrontendMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%frontend_menu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'route'], 'required'],
            [['order'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['name', 'route'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'route' => Yii::t('app', 'Route'),
            'order' => Yii::t('app', 'Order'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
