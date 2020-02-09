<?php

namespace soless\quiz\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\QuizQuestion;

/**
 * QuizQuestionSearch represents the model behind the search form of `\common\models\QuizQuestion`.
 */
class QuizQuestionSearch extends QuizQuestion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'question_category_id', 'value'], 'integer'],
            [['title', 'full_question', ], 'safe'],
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
        $query = QuizQuestion::find();

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
            'question_category_id' => $this->question_category_id,
            'value' => $this->value,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'full_question', $this->full_question]);

        return $dataProvider;
    }
}
