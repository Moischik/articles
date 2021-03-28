<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%articles}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%articles_categories}}`
 */
class m210328_175227_create_articles_table extends Migration
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

        $this->createTable('{{%articles}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'author' => $this->integer()->notNull(),
            'text' => $this->text()->notNull()->append(`CHARACTER SET utf8mb4_unicode_ci COLLATE utf8mb4_unicode_ci`),
            'categorie_id' => $this->integer()->notNull(),
            'pub_date' => $this->dateTime()->notNull(),
            'views' => $this->integer()->defaultValue(null),
        ], $tableOptions);

        // creates index for column `author`
        $this->createIndex(
            '{{%idx-articles-author}}',
            '{{%articles}}',
            'author'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-articles-author}}',
            '{{%articles}}',
            'author',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `categorie_id`
        $this->createIndex(
            '{{%idx-articles-categorie_id}}',
            '{{%articles}}',
            'categorie_id'
        );

        // add foreign key for table `{{%articles_categories}}`
        $this->addForeignKey(
            '{{%fk-articles-categorie_id}}',
            '{{%articles}}',
            'categorie_id',
            '{{%articles_categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-articles-author}}',
            '{{%articles}}'
        );

        // drops index for column `author`
        $this->dropIndex(
            '{{%idx-articles-author}}',
            '{{%articles}}'
        );

        // drops foreign key for table `{{%articles_categories}}`
        $this->dropForeignKey(
            '{{%fk-articles-categorie_id}}',
            '{{%articles}}'
        );

        // drops index for column `categorie_id`
        $this->dropIndex(
            '{{%idx-articles-categorie_id}}',
            '{{%articles}}'
        );

        $this->dropTable('{{%articles}}');
    }
}
