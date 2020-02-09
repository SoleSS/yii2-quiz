<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quiz_test}}`.
 */
class m200102_094000_create_quiz_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('quiz_test', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Наименование'),
            'description' => $this->text()->comment('Описание'),
            'questions_list' => $this->json()->comment('Список вопросов'),
            'solve_time' => $this->integer()->defaultValue(0)->comment('Время для завершения теста (секунд)'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('quiz_test');
    }
}
