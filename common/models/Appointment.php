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
            [['cemetery', 'date','combination_id'], 'required'],
            [['date', 'start', 'end', 'updated_at', 'created_at'], 'safe'],
            [['cemetery','cemetery_num'], 'string', 'max' => 30],
            [['combination_id'], 'integer'],
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
            'cemetery_num' => Yii::t('app', 'Cemetery Num'),
            'date' => Yii::t('app', 'Date'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'combination_id' => Yii::t('app', 'Combination Id'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
