<?php

namespace soless\quiz\models\base;

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
class QuizResult extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz_result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'quiz_test_id'], 'required'],
            [['user_id', 'quiz_test_id'], 'integer'],
            [['result_data', 'created_at', 'updated_at'], 'safe'],
            [['result'], 'number'],
            [['user_id', 'quiz_test_id'], 'unique', 'targetAttribute' => ['user_id', 'quiz_test_id']],
            [['quiz_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuizTest::className(), 'targetAttribute' => ['quiz_test_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'id Пользователя',
            'quiz_test_id' => 'id Теста',
            'result_data' => 'Результаты',
            'result' => 'Результат',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
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
