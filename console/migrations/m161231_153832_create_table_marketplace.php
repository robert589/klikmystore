<?php

use yii\db\Migration;

class m161231_153832_create_table_marketplace extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE marketplace("
                . "code varchar(10) not null,"
                . "name varchar(100) not null,"
                . "created_at int not null,"
                . "updated_at int not null)");
    }

    public function down()
    {
        echo "m161231_153832_create_table_marketplace cannot be reverted.\n";

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
