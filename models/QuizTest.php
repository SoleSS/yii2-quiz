<?php

namespace soless\quiz\models;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "quiz_test".
 *
 * @property int $id
 * @property string $title Наименование
 * @property string|null $description Описание
 * @property string|null $questions_list Список вопросов
 * @property int|null $solve_time Время для завершения теста
 *
 * @property QuizResult[] $quizResults
 * @property User[] $users
 * @property-read array $resultDates
 */
class QuizTest extends base\QuizTest
{
    const QUESTION_STATUS_DISABLED = 0;
    const QUESTION_STATUS_ENABLED = 1;

    const DEFAULT_SOLVE_TIME = 0;

    public function getQuestionsList () {
        $ids = [];
        foreach ($this->questions_list as $item) {
            if ($item['status'] == static::QUESTION_STATUS_ENABLED) {
                $ids[] = $item['question_id'];
            }
        }

        return $ids;
    }

    public function getQuestions () {
        return QuizQuestion::find()
            ->where(['id' => $this->questionsList])
            ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizResults()
    {
        return $this->hasMany(QuizResult::className(), ['quiz_test_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('quiz_result', ['quiz_test_id' => 'id']);
    }


    public static function asArray() {
        return \yii\helpers\ArrayHelper::map(static::find()->select(['id', 'title'])->asArray()->all(), 'id', 'title');
    }

    public function getResultDates() {
        return QuizResult::find()
            ->select(new Expression("DATE(created_at)"))
            ->distinct()
            ->where(['quiz_test_id' => $this->id])
            ->column();
    }
}
