<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%appointment}}".
 *
 * @property int $id
 * @property string $cemetery 墓地名称
 * @property string $date 预约日期
 * @property string|null $start
 * @property string|null $end
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class Appointment extends \common\models\Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%appointment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cemetery', 'date'], 'required'],
            [['date', 'start', 'end', 'updated_at', 'created_at'], 'safe'],
            [['cemetery'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cemetery' => Yii::t('app', 'Cemetery'),
            'date' => Yii::t('app', 'Date'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
