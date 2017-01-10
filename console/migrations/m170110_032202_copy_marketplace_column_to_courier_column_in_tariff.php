<?php

use yii\db\Migration;

class m170110_032202_copy_marketplace_column_to_courier_column_in_tariff extends Migration
{
    public function up()
    {
        $this->execute("UPDATE tariff 
                        SET courier_code = marketplace_code");
    }

    public function down()
    {
        echo "m170110_032202_copy_marketplace_column_to_courier_column_in_tariff cannot be reverted.\n";

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
