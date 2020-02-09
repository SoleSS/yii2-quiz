<?php

namespace soless\quiz\models\base;

use Yii;

/**
 * This is the model class for table "quiz_question".
 *
 * @property int $id
 * @property string $title Заголовок
 * @property string|null $full_question Полный текст вопроса
 * @property int|null $question_category_id id Категории
 * @property int $type Тип вопроса
 * @property string|null $answears Варианты ответа с параметрами
 * @property int $value Баллы
 *
 * @property QuizQuestionCategory $questionCategory
 */
class QuizQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'type'], 'required'],
            [['full_question'], 'string'],
            [['question_category_id', 'type', 'value'], 'integer'],
            [['answears'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['question_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuizQuestionCategory::className(), 'targetAttribute' => ['question_category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'full_question' => 'Полный текст вопроса',
            'question_category_id' => 'id Категории',
            'type' => 'Тип вопроса',
            'answears' => 'Варианты ответа с параметрами',
            'value' => 'Баллы',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionCategory()
    {
        return $this->hasOne(QuizQuestionCategory::className(), ['id' => 'question_category_id']);
    }
}
