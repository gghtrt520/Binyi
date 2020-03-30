<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property string $name 贡品名称
 * @property int $price 价格
 * @property int $num 数量
 * @property string $style 贡品样式
 * @property string $norms 贡品规格
 * @property string|null $updated_at 更新时间
 * @property string|null $created_at 创建时间
 */
class Product extends Base
{


    public function beforeValidate()
    {
        $root_path = Yii::getAlias('@backend/web');
        $upload    = new Upload();
        $path      = $upload->uploadFile($this,$root_path,'style');
        if($this->isNewRecord){
            if($path){
                $this->style = Yii::$app->request->hostInfo.Yii::$app->homeUrl.$path;
            }else{
                $this->addError('style', Yii::t('app', '必须上传一个图片'));
            }
        }else{
            if($path){
                $this->style = Yii::$app->request->hostInfo.Yii::$app->homeUrl.$path;
            }else{
                $this->style = $this->getOldAttribute('style');
            }
        }
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['price', 'num'], 'integer'],
            ['price', 'default', 'value' =>0],
            [['updated_at', 'created_at'], 'safe'],
            [['name'], 'string', 'max' => 30],
            [['style'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Product Name'),
            'price' => Yii::t('app', 'Price'),
            'num' => Yii::t('app', 'Num'),
            'style' => Yii::t('app', 'Style'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
