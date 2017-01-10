<?php

use yii\db\Migration;

class m170110_030047_add_district_name_to_district_table extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE district add name varchar(100) not null");
    }

    public function down()
    {
        echo "m170110_030047_add_district_name_to_district_table cannot be reverted.\n";

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
