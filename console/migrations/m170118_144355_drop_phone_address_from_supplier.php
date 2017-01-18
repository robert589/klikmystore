<?php

use yii\db\Migration;

class m170118_144355_drop_phone_address_from_supplier extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE supplier drop column phone, drop column address;");
    }

    public function down()
    {
        echo "m170118_144355_drop_phone_address_from_supplier cannot be reverted.\n";

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
