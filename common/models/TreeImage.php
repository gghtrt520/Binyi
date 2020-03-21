<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tree_image}}".
 *
 * @property int $id 树木信息ID
 * @property string $tree_image 图片地址
 * @property int $tree_information_id
 */
class TreeImage extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%tree_image}}';
    }


    public function rules()
    {
        return [
            [['tree_image', 'tree_information_id'], 'required'],
            [['tree_information_id'], 'integer'],
            [['tree_image'], 'string', 'max' => 255],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree_image' => '树木图片',
            'tree_information_id' => 'Tree Information ID',
        ];
    }
}