<?php

namespace soless\quiz\models;

use Yii;

/**
 * This is the model class for table "quiz_question_category".
 *
 * @property int $id
 * @property string $title Название
 *
 * @property QuizQuestion[] $quizQuestions
 */
class QuizQuestionCategory extends base\QuizQuestionCategory
{
    public static function asArray() {
        return \yii\helpers\ArrayHelper::map(static::find()->select(['id', 'title'])->asArray()->all(), 'id', 'title');
    }
}
