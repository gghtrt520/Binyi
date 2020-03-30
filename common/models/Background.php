<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%background}}".
 *
 * @property int $id
 * @property string $background
 * @property int $price
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class Background extends \common\models\Base
{
    
    public function beforeValidate()
    {
        $root_path = Yii::getAlias('@backend/web');
        $upload    = new Upload();
        $path      = $upload->uploadFile($this,$root_path,'background');
        if($this->isNewRecord){
            if($path){
                $this->background = Yii::$app->request->hostInfo.Yii::$app->homeUrl.$path;
            }else{
                $this->addError('background', Yii::t('app', '必须上传一个图片'));
            }
        }else{
            if($path){
                $this->background = Yii::$app->request->hostInfo.Yii::$app->homeUrl.$path;
            }else{
                $this->background = $this->getOldAttribute('background');
            }
        }
        return parent::beforeValidate();
    }


    public static function tableName()
    {
        return '{{%background}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['price'], 'integer'],
            ['price', 'default', 'value' =>0],
            [['updated_at', 'created_at'], 'safe'],
            [['background'], 'string', 'max' => 200],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Background Name'),
            'background' => Yii::t('app', 'Background'),
            'price' => Yii::t('app', 'Price'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }


    public static function getList()
    {
        $data = self::find()->select('id,name')->all();
        $data = \yii\helpers\ArrayHelper::map(array_merge($data), 'id', 'name');
        return $data;
    }
}
