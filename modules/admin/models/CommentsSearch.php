<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\comments\Comments;

/**
 * CommentsSearch represents the model behind the search form of `app\models\comments\Comments`.
 */
class CommentsSearch extends Comments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_id', 'news_id', 'user_id', 'category_id', 'is_good', 'raiting'], 'integer'],
            [['comm_text', 'date', 'user_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Comments::find();

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
            'comment_id' => $this->comment_id,
            'news_id' => $this->news_id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'is_good' => $this->is_good,
            'raiting' => $this->raiting,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'comm_text', $this->comm_text])
            ->andFilterWhere(['like', 'user_name', $this->user_name]);

        return $dataProvider;
    }
}
