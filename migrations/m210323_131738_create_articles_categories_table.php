<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%articles_categories}}`.
 */
class m210323_131738_create_articles_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%articles_categories}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull()->unique(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%articles_categories}}');
    }
}
