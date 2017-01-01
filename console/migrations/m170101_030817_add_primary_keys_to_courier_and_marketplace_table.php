<?php

use yii\db\Migration;

class m170101_030817_add_primary_keys_to_courier_and_marketplace_table extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE marketplace add primary key(code)");
        
        $this->execute("ALTER TABLE courier add primary key(code)");
    }

    public function down()
    {
        echo "m170101_030817_add_primary_keys_to_courier_and_marketplace_table cannot be reverted.\n";

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
