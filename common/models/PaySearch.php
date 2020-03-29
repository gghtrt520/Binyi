<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pay;

/**
 * PaySearch represents the model behind the search form of `common\models\Pay`.
 */
class PaySearch extends Pay
{
    public $username;
    public function rules()
    {
        return [
            [['id', 'type', 'pay_num', 'user_id', 'type_id','is_success'], 'integer'],
            [['updated_at', 'created_at','username'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pay::find()->joinWith('user');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_success'=>$this->is_success,
            'pay.type' => $this->type,
            'pay_num' => $this->pay_num,
            'type_id' => $this->type_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like','user.nick_name',$this->username]);

        return $dataProvider;
    }
}
