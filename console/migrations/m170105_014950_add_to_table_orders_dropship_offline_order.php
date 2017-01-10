<?php

use yii\db\Migration;

class m170105_014950_add_to_table_orders_dropship_offline_order extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE orders add offline_order boolean not null, add dropship boolean not null");
    }

    public function down()
    {
        echo "m170105_014950_add_to_table_orders_dropship_offline_order cannot be reverted.\n";

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
