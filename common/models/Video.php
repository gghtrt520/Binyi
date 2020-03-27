<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property int $id
 * @property string $name
 * @property int $room_id
 * @property string $video_path
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class Video extends \common\models\Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'room_id', 'video_path'], 'required'],
            [['room_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['video_path'], 'string', 'max' => 150],
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
            'video_path' => Yii::t('app', 'Video Path'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
