<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

class UserSearch extends User
{
    
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'nick_name', 'avatar_url', 'gender', 'auth_key', 'password_hash', 'password_reset_token', 'access_token', 'type', 'email'], 'safe'],
        ];
    }

    
    public function scenarios()
    {
        return Model::scenarios();
    }

    
    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'nick_name', $this->nick_name])
            ->andFilterWhere(['like', 'avatar_url', $this->avatar_url])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'access_token', $this->access_token])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
