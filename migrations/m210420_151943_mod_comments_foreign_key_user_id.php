<?php

use yii\db\Migration;

/**
 * Class m210420_151943_mod_comments_foreign_key_user_id
 */
class m210420_151943_mod_comments_foreign_key_user_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // creates index for column `User_id`
        $this->createIndex(
            'comments_User_id_idx',
            '{{%comments}}',
            'User_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'comments_User_id_fkey',
            '{{%comments}}',
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
            'comments_User_id_fkey',
            '{{%comments}}'
        );

        // drops index for column `author`
        $this->dropIndex(
            'comments_User_id_idx',
            '{{%comments}}'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210420_151943_mod_comments_foreign_key_user_id cannot be reverted.\n";

        return false;
    }
    */
}
