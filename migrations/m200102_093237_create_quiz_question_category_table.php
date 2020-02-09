<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quiz_question_category}}`.
 */
class m200102_093237_create_quiz_question_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('quiz_question_category', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Название')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('quiz_question_category');
    }
}
