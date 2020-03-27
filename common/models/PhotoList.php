<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%photo_list}}".
 *
 * @property int $id
 * @property int $photo_id 相册ID
 * @property string $photo_url 照片url
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class PhotoList extends \common\models\Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%photo_list}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo_id', 'photo_url'], 'required'],
            [['photo_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['photo_url'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'photo_id' => Yii::t('app', 'Photo ID'),
            'photo_url' => Yii::t('app', 'Photo Url'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
