<?php

namespace soless\quiz\models;

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
 * @property-read string $typeTxt Текстовое представление типа
 *
 * @property QuizQuestionCategory $questionCategory
 * @property-read array $answearsAsArray Массив вариантов ответа
 */
class QuizQuestion extends base\QuizQuestion
{
    const TYPE_UNDEFINED = 0;
    const TYPE_TEXT = 1;
    const TYPE_RADIOS = 2;
    const TYPE_CHECKBOXES = 3;

    const STATUS_WRONG = 0;
    const STATUS_RIGHT = 1;

    const DEFAULT_VALUE = 50;

    const TYPE_TXT = [
        self::TYPE_UNDEFINED        => 'Не определен',
        self::TYPE_TEXT             => 'Текстовый ответ',
        self::TYPE_RADIOS           => 'Выбор 1го варианта из списка',
        self::TYPE_CHECKBOXES       => 'Выбор 1го или нескольких вариантов из списка',
    ];

    public function getTypeTxt() {
        return static::TYPE_TXT[$this->type] ?? static::TYPE_TEXT[static::TYPE_UNDEFINED];
    }

    public function getAnswearsAsArray() {
        $result = [];
        if (!empty($this->answears)) foreach ($this->answears as $index => $item) {
            $result[$index] = $item['title'];
        }

        return $result;
    }
    public static function asArray() {
        return \yii\helpers\ArrayHelper::map(static::find()->select(['id', 'title'])->asArray()->all(), 'id', 'title');
    }
}
