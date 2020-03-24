<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Room;

/**
 * RoomSearch represents the model behind the search form of `common\models\Room`.
 */
class RoomSearch extends Room
{
    const UNCHECK = 0;
    const ISCHECK = 1;
    
    static public $check = [
        self::UNCHECK => '未审核',
        self::ISCHECK  => '审核',
    ];

    public function rules()
    {
        return [
            [['id', 'age', 'rule','is_show'], 'integer'],
            [['avatar_url', 'surname', 'name', 'gender', 'birthdate', 'death', 'native', 'religion', 'relation', 'updated_at', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = Room::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id'        => $this->id,
            'birthdate' => $this->birthdate,
            'death'     => $this->death,
            'age'       => $this->age,
            'rule'      => $this->rule,
            'is_show'   => $this->is_show
        ]);

        $query->andFilterWhere(['like', 'avatar_url', $this->avatar_url])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'native', $this->native])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'relation', $this->relation]);

        return $dataProvider;
    }
}
