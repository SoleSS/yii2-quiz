<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quiz_result}}`.
 */
class m200123_161452_create_quiz_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('quiz_result', [
            'user_id' => $this->integer()->notNull()->comment('id Пользователя'),
            'quiz_test_id' => $this->integer()->notNull()->comment('id Теста'),
            'result_data' => $this->json()->comment('Результаты'),
            'result' => $this->decimal(7,3)->defaultValue(0)->notNull()->comment('Результат'),
            'created_at' => $this->dateTime()->notNull()->defaultValue(new \yii\db\Expression('NOW()'))->comment('Дата создания'),
            'updated_at' => $this->dateTime()->notNull()->defaultValue(new \yii\db\Expression('NOW()'))->comment('Дата обновления'),
            'PRIMARY KEY(user_id, quiz_test_id)'
        ]);

        $this->createIndex('id-quiz_result-user_id', 'quiz_result', 'user_id');
        $this->createIndex('id-quiz_result-quiz_test_id', 'quiz_result', 'quiz_test_id');

        $this->addForeignKey('fk-quiz_result-user_id', 'quiz_result', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk-quiz_result-quiz_test_id', 'quiz_result', 'quiz_test_id', 'quiz_test', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-quiz_result-user_id', 'quiz_result');
        $this->dropForeignKey('fk-quiz_result-quiz_test_id', 'quiz_result');

        $this->dropTable('quiz_result');
    }
}
