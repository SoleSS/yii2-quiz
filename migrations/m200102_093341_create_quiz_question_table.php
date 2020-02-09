<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quiz_question}}`.
 */
class m200102_093341_create_quiz_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('quiz_question', [
            'id' => $this->primaryKey(),
            'title' => $this->string('255')->comment('Заголовок')->notNull(),
            'full_question' => $this->text()->comment('Полный текст вопроса'),
            'question_category_id' => $this->integer()->comment('id Категории'),
            'type' => $this->integer(2)->defaultValue(0)->notNull()->comment('Тип вопроса'),
            'answers' => $this->json()->comment('Варианты ответа с параметрами'),
            'value' => $this->integer(3)->notNull()->defaultValue(50)->comment('Баллы')
        ]);

        $this->createIndex('idx-quiz_question-question_category_id', 'quiz_question', 'question_category_id');
        $this->addForeignKey('fk-quiz_question-question_category_id', 'quiz_question', 'question_category_id', 'quiz_question_category', 'id', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-quiz_question-question_category_id', 'quiz_question');

        $this->dropTable('quiz_question');
    }
}
