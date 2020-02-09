<?php

namespace soless\quiz\models\base;

use Yii;

/**
 * This is the model class for table "quiz_question_category".
 *
 * @property int $id
 * @property string $title Название
 *
 * @property QuizQuestion[] $quizQuestions
 */
class QuizQuestionCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz_question_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizQuestions()
    {
        return $this->hasMany(QuizQuestion::className(), ['question_category_id' => 'id']);
    }
}
