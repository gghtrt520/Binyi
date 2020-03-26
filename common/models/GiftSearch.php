<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Gift;


class GiftSearch extends Gift
{
    public $room;
    public $product;
    public $user;

    public function rules()
    {
        return [
            [['id', 'room_id', 'product_id', 'user_id'], 'integer'],
            [['updated_at', 'created_at','room','product','user'], 'safe'],
        ];
    }

    
    public function scenarios()
    {
        return Model::scenarios();
    }

    
    public function search($params)
    {
        $query = Gift::find()->joinWith(['user','room','product']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like','room.name',$this->room])
              ->andFilterWhere(['like','product.name',$this->product])
              ->andFilterWhere(['like','user.nick_name',$this->user]);

        $sort = $dataProvider->getSort(); 
        $sort->attributes['room'] = [ 
            'asc' => ['room.name' => SORT_ASC],
            'desc' => ['room.name' => SORT_DESC],
        ];
        $sort->attributes['product'] = [ 
            'asc' => ['product.name' => SORT_ASC],
            'desc' => ['product.name' => SORT_DESC],
        ];
        $sort->attributes['user'] = [ 
            'asc' => ['user.nick_name' => SORT_ASC],
            'desc' => ['user.nick_name' => SORT_DESC],
        ];
        $dataProvider->setSort($sort);

        return $dataProvider;
    }
}
