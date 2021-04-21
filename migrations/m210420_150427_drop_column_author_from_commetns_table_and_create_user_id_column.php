<?php

use yii\db\Migration;

/**
 * Class m210420_150427_drop_column_author_from_commetns_table_and_create_user_id_column
 */
class m210420_150427_drop_column_author_from_commetns_table_and_create_user_id_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('comments', 'author');
        $this->addColumn('comments', 'User_id', $this->integer()->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('comments', 'author', $this->string()->notNull());
        $this->dropColumn('comments', 'User_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210420_150427_drop_column_author_from_commetns_table_and_create_user_id_column cannot be reverted.\n";

        return false;
    }
    */
}
