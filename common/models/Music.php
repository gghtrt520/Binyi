<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%music}}".
 *
 * @property int $id
 * @property string $name
 * @property string $video_url
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class Music extends \common\models\Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%music}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'video_url'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['name'], 'string', 'max' => 30],
            [['video_url'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Music Name'),
            'video_url' => Yii::t('app', 'Video Url'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}