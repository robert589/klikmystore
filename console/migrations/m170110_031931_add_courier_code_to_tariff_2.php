<?php

use yii\db\Migration;

class m170110_031931_add_courier_code_to_tariff_2 extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE courier drop column courier_code");
        $this->execute("ALTER TABLE tariff add courier_code varchar(10) not null, add foreign key(courier_code) references courier(code);");
    }

    public function down()
    {
        echo "m170110_031931_add_courier_code_to_tariff_2 cannot be reverted.\n";

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
