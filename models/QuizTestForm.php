<?php

namespace soless\quiz\models;

use Yii;
use yii\base\Model;

/**
 * @property array $answears Массив ответов
 * @property int $testId id теста
 * @property-read QuizTest $test Объект теста
 * @property-read int $totalResultValue
 */
class QuizTestForm extends Model
{
    public $answers;
    public $testId;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['testId', 'integer'],
            ['answers', 'checkIsAnswers'],
            [['testId', ], 'required'],
        ];
    }

    public function getTest () {
        return QuizTest::findOne($this->testId);
    }

    public function getTotalResultValue () {
        $questions = $this->parseAnswers();
        $total = 0;
        foreach ($questions as $question) {
            foreach ($question['answers'] as $answer) {
                $total += $answer['checked'] ? $answer['value'] : 0;
            }
        }

        return $total;
    }

    public function parseAnswers () {
        if (!$this->validate()) return [];

        $questions = [];
        /** @var QuizQuestion $question */
        foreach (QuizQuestion::find()
            ->where(['id' => array_keys($this->answers)])
            ->each() as $question) {
                $questions[$question->id] = $question;
        }

        $results = [];
        /** @var int $questionId */
        /** @var array $answers */
        foreach ($this->answers as $questionId => $answers) {
            if (!isset($questions[$questionId])) continue;

            $question = $questions[$questionId];

            $result = [
                'question_id' => $questionId,
                'title' => $question->title,
                'full_question' => $question->full_question,
                'type' => $question->type,
                'type_txt' => $question->typeTxt,
                'max_value' => $question->value,
                'answers' => [

                ],
            ];

            $wrightAnswersCounter = 0;
            foreach ($question->answears as $index => $item) {
                if ($item['status'] == QuizQuestion::STATUS_RIGHT) $wrightAnswersCounter++;
            }
            foreach ($question->answers as $index => $item) {
                $value = $question->value / 100 * (isset($item['value']) ? (float)$item['value'] : 0);
                if (empty($item['value']) && $item['status'] == QuizQuestion::STATUS_RIGHT) {
                    $value = round($question->value / $wrightAnswersCounter, 2);
                } elseif (empty($item['value']) && $item['status'] == QuizQuestion::STATUS_WRONG) {
                    $value = 0;
                }

                $result['answers'][] = [
                    'id' => $index,
                    'title' => $item['title'],
                    'status' => $item['status'],
                    'value' => $value,
                    'checked' => in_array($index, (array)$answers) && isset($answers[0]),
                ];
            }

            $results[] = $result;
        }

        return $results;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'answers' => 'Варианты ответа',
        ];
    }

    public function checkIsAnswers () {
        if(!is_array($this->answers)){
            $this->addError('answers','Answers is not array!');
        }
    }
}
