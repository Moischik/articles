<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%articles}}`
 */
class m210328_183341_create_comments_table extends Migration
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

        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'author' => $this->string()->unique()->defaultValue('Guest'),
            'text' => $this->text()->notNull()->append(`CHARACTER SET utf8mb4_unicode_ci COLLATE utf8mb4_unicode_ci`),
            'pub_date' => $this->dateTime()->notNull(),
            'articles_id' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `articles_id`
        $this->createIndex(
            '{{%idx-comments-articles_id}}',
            '{{%comments}}',
            'articles_id'
        );

        // add foreign key for table `{{%articles}}`
        $this->addForeignKey(
            '{{%fk-comments-articles_id}}',
            '{{%comments}}',
            'articles_id',
            '{{%articles}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%articles}}`
        $this->dropForeignKey(
            '{{%fk-comments-articles_id}}',
            '{{%comments}}'
        );

        // drops index for column `articles_id`
        $this->dropIndex(
            '{{%idx-comments-articles_id}}',
            '{{%comments}}'
        );

        $this->dropTable('{{%comments}}');
    }
}
