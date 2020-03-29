<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property int $id
 * @property int|null $room_id
 * @property string $content
 * @property int|null $user_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Comment extends \common\models\Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'user_id'], 'integer'],
            [['content'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'room_id' => Yii::t('app', 'Room ID'),
            'content' => Yii::t('app', 'Content'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
