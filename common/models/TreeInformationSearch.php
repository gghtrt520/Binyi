<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TreeInformation;

class TreeInformationSearch extends TreeInformation
{

    public $tree_category_name;
    public $construction_unit_name;
    public $conservation_unit_name;
    public $property_unit_name;
    public $parent_unit;
    
    public function rules()
    {
        return [
            [['id','user_id'], 'integer'],
            [['tree_number','latitude', 'longitude', 'nation', 'province', 'city', 'district', 'street', 'other',
            'created_at','tree_category_name', 'construction_unit_name', 'conservation_unit_name', 'property_unit_name','parent_unit'], 'safe'],
        ];
    }

    

    public function scenarios()
    {
        return Model::scenarios();
    }

    
    public function webSearch($params)
    {
        $query = TreeInformation::find()->joinWith(['treeCategory','constructionUnit','conservationUnit','propertyUnit']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $user_assign  = UserAssign::findOne(['user_id'=>Yii::$app->user->identity->id]);
        if ($user_assign->rule == 0) {
            $query->andFilterWhere(['=','tree_information.id',0]);
        }
        if ($user_assign->rule == 2) {
            $query->andFilterWhere(['=','district',$user_assign->rule_data]);
        }
        if ($user_assign->rule == 3) {
            $query->andFilterWhere(['=','conservation_unit_id',$user_assign->rule_data]);
        }
        if ($user_assign->rule == 4) {
            $query->andFilterWhere(['=','construction_unit_id',$user_assign->rule_data]);
        }
        if ($user_assign->rule == 5) {
            $query->andFilterWhere(['=','property_unit_id',$user_assign->rule_data]);
        }
        $query->andFilterWhere(['like', 'tree_number', $this->tree_number])
            ->andFilterWhere(['like', 'nation', $this->nation])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'other', $this->other])
            ->andFilterWhere(['like', 'tree_information.created_at', $this->created_at])
            ->andFilterWhere(['like', 'tree_category.name', $this->tree_category_name])
            ->andFilterWhere(['like', 'conservation_unit.name', $this->conservation_unit_name])
            ->andFilterWhere(['like', 'construction_unit.name', $this->construction_unit_name])
            ->andFilterWhere(['like', 'property_unit.name', $this->property_unit_name]);
        if (isset($this->parent_unit) && $this->parent_unit !='') {
            $parent_id = PropertyUnit::find()->where(['like','name',$this->parent_unit])->asArray()->all();
            $parent_id = array_column($parent_id, 'id');
            $query->where(['parent_id'=>$parent_id]);
        }


        return $dataProvider;
    }
}
