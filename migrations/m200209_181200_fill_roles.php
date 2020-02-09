<?php
use yii\db\Migration;

/**
 * Handles the creation of table `cms_category`.
 */
class m200209_181200_fill_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = null;
        if ($this->db->driverName === 'mysql') {
            $options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        try {
            $this->batchInsert('auth_item', ['name', 'type', 'created_at', 'updated_at',], [
                ['QuizTestAdmin', 2, time(), time(),],
                ['QuizQuestionAdmin', 2, time(), time(),],
            ]);

            $this->batchInsert('auth_item_child', ['parent', 'child'], [
                ['Administrator', 'QuizTestAdmin'],
                ['Administrator', 'QuizQuestionAdmin'],
            ]);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        try {
            $this->delete('auth_item', ['OR',
                ['name' => 'QuizTestAdmin'],
                ['name' => 'QuizQuestionAdmin'],
            ]);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
