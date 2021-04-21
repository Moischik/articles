<?php

use yii\db\Migration;

/**
 * Class m210409_195253_mod_articles_mod_author_User_id
 */
class m210409_195253_mod_articles_mod_author_User_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            '{{%fk-articles-author}}',
            '{{%articles}}'
        );

        // drops index for column `author`
        $this->dropIndex(
            '{{%idx-articles-author}}',
            '{{%articles}}'
        );

        $this->renameColumn('{{%articles}}','author','User_id');


        // creates index for column `User_id`
        $this->createIndex(
            'articles_User_id_idx',
            '{{%articles}}',
            'User_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'articles_User_id_fkey',
            '{{%articles}}',
            'User_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'articles_User_id_fkey',
            '{{%articles}}'
        );

        // drops index for column `author`
        $this->dropIndex(
            'articles_User_id_idx',
            '{{%articles}}'
        );

        $this->renameColumn('{{%articles}}','User_id','author');

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
    }
}
