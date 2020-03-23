<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FrontendMenu;

/**
 * FrontendMenuSearch represents the model behind the search form of `common\models\FrontendMenu`.
 */
class FrontendMenuSearch extends FrontendMenu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order'], 'integer'],
            [['name', 'route', 'updated_at', 'created_at'], 'safe'],
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
        $query = FrontendMenu::find();

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
            'order' => $this->order,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'route', $this->route]);

        return $dataProvider;
    }
}