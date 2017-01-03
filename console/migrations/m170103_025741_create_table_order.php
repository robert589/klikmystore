<?php

use yii\db\Migration;

class m170103_025741_create_table_order extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE order("
                . "id int not null primary key,"
                . ")");
    }

    public function down()
    {
        echo "m170103_025741_create_table_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
