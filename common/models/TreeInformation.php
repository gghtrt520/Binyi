<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%tree_information}}".
 *
 * @property int $id
 * @property string $tree_name 树木名称
 * @property string $tree_number 树木编号
 * @property string $diameter 树木胸径
 * @property string $crown 树木冠幅
 * @property string $height 树木高度
 * @property string $health 树木健康状态
 * @property string $tree_video 上传视频
 * @property string $latitude 纬度
 * @property string $longitude 经度
 * @property string $nation 国家
 * @property string $province 省
 * @property string $city 市
 * @property string $district 区
 * @property string $street 街道
 * @property int $tree_category_id 树种分类
 * @property int $property_unit_id 产权单位
 * @property int $construction_unit_id 施工单位
 * @property int $conservation_unit_id 养护单位
 * @property string $other 其它信息
 * @property int $user_id 用户ID
 * @property string $created_at 创建时间
 */
class TreeInformation extends \yii\db\ActiveRecord
{
    public $tree_image;
    
    public static function tableName()
    {
        return '{{%tree_information}}';
    }

    
    public function rules()
    {
        return [
            [['tree_name', 'tree_number', 'diameter', 'crown', 'height', 'health', 'latitude', 'longitude', 'nation', 'province', 'city', 'tree_category_id', 'property_unit_id', 'construction_unit_id', 'conservation_unit_id', 'user_id'], 'required'],
            [['tree_category_id', 'property_unit_id', 'construction_unit_id', 'conservation_unit_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['tree_name', 'tree_number'], 'string', 'max' => 50],
            [['diameter', 'crown', 'height'],'number'],
            [['health'], 'string', 'max' => 20],
            [['tree_video', 'other'], 'string', 'max' => 255],
            [['latitude', 'longitude', 'nation', 'province', 'city', 'district', 'street'], 'string', 'max' => 30],
            [['tree_image'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 9],
            [['tree_video'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp4', 'maxFiles' => 1],
        ];
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => '序号',
            'tree_name' => '树木名称',
            'tree_number' => '树木编号',
            'diameter' => '胸径',
            'crown' => '冠幅',
            'height' => '高度',
            'health' => '健康状态',
            'tree_video' => '树木视频',
            'latitude' =>'纬度',
            'longitude' => '经度',
            'nation' => '国家',
            'province' =>  '省',
            'city' => '市',
            'district' => '区',
            'street' => '街道',
            'tree_category_id' => '树种分类',
            'property_unit_id' => '产权单位',
            'construction_unit_id' => '施工单位',
            'conservation_unit_id' => '养护单位',
            'other' => '其它信息',
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => '创建时间',
            'tree_image' => '树木图片',
        ];
    }



    public function search($params, $user_id)
    {
        $query = self::find()->joinWith(['treeCategory','treeImage','constructionUnit','conservationUnit','propertyUnit']);
        //$query->andFilterWhere(['=','user_id',$user_id]);
        $user_assign  = UserAssign::findOne(['user_id'=>$user_id]);
        if ($user_assign->rule == 0) {
            return [];
        }
        if ($user_assign->rule == 2) {
            $query->where(['=','district',$user_assign->rule_data]);
        }
        if ($user_assign->rule == 3) {
            $query->where(['=','conservation_unit_id',$user_assign->rule_data]);
        }
        if ($user_assign->rule == 4) {
            $query->where(['=','construction_unit_id',$user_assign->rule_data]);
        }
        if ($user_assign->rule == 5) {
            $model  = new PropertyUnit();
            $model->getSon($user_assign->rule_data);
            $result = array_merge([$user_assign->rule_data], $model->data);
            $query->where(['property_unit_id'=>$result]);
        }
        $query->andFilterWhere(['=','tree_category_id',Yii::$app->request->post('tree_category_id')]);
        $query->andFilterWhere([
            'or',
            ['like','tree_name',Yii::$app->request->post('keyword')],
            ['like','tree_number',Yii::$app->request->post('keyword')],
            ['like','tree_category.name',Yii::$app->request->post('keyword')],
            ['like','property_unit.name',Yii::$app->request->post('keyword')],
            ['like','construction_unit.name',Yii::$app->request->post('keyword')],
            ['like','conservation_unit.name',Yii::$app->request->post('keyword')],
        ]);
        $location = Yii::$app->request->post('location');
        $value    = Yii::$app->request->post('value');
        if ($location) {
            $query->andFilterWhere(['like',$location,$value]);
        }
        return $query->asArray()->all();
    }


    public function webSearch($params)
    {
        $query = self::find()->joinWith(['treeCategory','constructionUnit','conservationUnit','propertyUnit']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
        ]);
        $this->load($params);
        if (!$this -> validate()) {
            return $dataProvider;
        }
        return $dataProvider;
    }







    public function getTreeCategory()
    {
        return $this->hasOne(TreeCategory::className(), ['id'=>'tree_category_id']);
    }

    

    public function getConstructionUnit()
    {
        return $this->hasOne(ConstructionUnit::className(), ['id'=>'construction_unit_id']);
    }

    public function getConservationUnit()
    {
        return $this->hasOne(ConservationUnit::className(), ['id'=>'conservation_unit_id']);
    }

    public function getPropertyUnit()
    {
        return $this->hasOne(PropertyUnit::className(), ['id'=>'property_unit_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }

    public function getTreeImage()
    {
        return $this->hasOne(TreeImage::className(), ['tree_information_id'=>'id']);
    }

    public function getTreeImageAll()
    {
        return $this->hasMany(TreeImage::className(), ['tree_information_id'=>'id']);
    }

    public function getTreeImageArray()
    {
        $tree_image = $this->getTreeImage();
    }
}
