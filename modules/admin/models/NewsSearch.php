<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\news\News;

/**
 * NewsSearch represents the model behind the search form of `app\models\news\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id', 'category_id', 'analytics'], 'integer'],
            [['news_name', 'news_text', 'news_photo', 'category', 'publ_date'], 'safe'],
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
        $query = News::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 10
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'news_id' => $this->news_id,
            'category_id' => $this->category_id,
            'publ_date' => $this->publ_date,
            'analytics' => $this->analytics,
        ]);

        $query->andFilterWhere(['like', 'news_name', $this->news_name])
            ->andFilterWhere(['like', 'news_text', $this->news_text])
            ->andFilterWhere(['like', 'news_photo', $this->news_photo])
            ->andFilterWhere(['like', 'category', $this->category]);

        return $dataProvider;
    }
}
