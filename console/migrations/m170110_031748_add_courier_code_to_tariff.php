<?php

use yii\db\Migration;

class m170110_031748_add_courier_code_to_tariff extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE courier add courier_code varchar(10) not null, add foreign key(courier_code) references courier(code);");
    }

    public function down()
    {
        echo "m170110_031748_add_courier_code_to_tariff cannot be reverted.\n";

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
