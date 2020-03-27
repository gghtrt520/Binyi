<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%photo}}".
 *
 * @property int $id
 * @property string $name
 * @property int $room_id
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class Photo extends \common\models\Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%photo}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'room_id'], 'required'],
            [['room_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['name'], 'string', 'max' => 30],
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
            'room_id' => Yii::t('app', 'Room ID'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
