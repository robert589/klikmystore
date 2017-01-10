<?php

use yii\db\Migration;

class m170110_061421_add_tariff_to_orders extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE orders add tariff float not null");
    }

    public function down()
    {
        echo "m170110_061421_add_tariff_to_orders cannot be reverted.\n";

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
