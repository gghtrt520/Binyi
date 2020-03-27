<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%appointment_person}}".
 *
 * @property int $id
 * @property int $appointment_id
 * @property string $name
 * @property string $idcard
 * @property int $phone
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class AppointmentPerson extends \common\models\Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%appointment_person}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appointment_id', 'name', 'idcard', 'phone'], 'required'],
            [['appointment_id', 'phone'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['name'], 'string', 'max' => 20],
            [['idcard'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'appointment_id' => Yii::t('app', 'Appointment ID'),
            'name' => Yii::t('app', 'Name'),
            'idcard' => Yii::t('app', 'Idcard'),
            'phone' => Yii::t('app', 'Phone'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
