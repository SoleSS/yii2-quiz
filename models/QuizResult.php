<?php

namespace soless\quiz\models;

use Yii;

/**
 * This is the model class for table "quiz_result".
 *
 * @property int $user_id id Пользователя
 * @property int $quiz_test_id id Теста
 * @property string|null $result_data Результаты
 * @property float $result Результат
 * @property string $created_at Дата создания
 * @property string $updated_at Дата обновления
 *
 * @property QuizTest $quizTest
 * @property User $user
 */
class QuizResult extends base\QuizResult
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                // New record
                $this->created_at = date('Y-m-d H:i:s');
                $this->updated_at = date('Y-m-d H:i:s');
            } else {
                // Updating record
                $this->updated_at = date('Y-m-d H:i:s');
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizTest()
    {
        return $this->hasOne(QuizTest::className(), ['id' => 'quiz_test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
