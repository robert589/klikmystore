<?php

use yii\db\Migration;

class m170110_091535_add_auto_increment_to_orders_id extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE orders modify column id int not null auto_increment");
    }

    public function down()
    {
        echo "m170110_091535_add_auto_increment_to_orders_id cannot be reverted.\n";

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
