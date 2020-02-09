<?php

namespace soless\quiz\models\base;

use Yii;

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
 */
class QuizTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz_test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['questions_list'], 'safe'],
            [['solve_time'], 'integer'],
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
            'title' => 'Наименование',
            'description' => 'Описание',
            'questions_list' => 'Список вопросов',
            'solve_time' => 'Время для завершения теста',
        ];
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
}
