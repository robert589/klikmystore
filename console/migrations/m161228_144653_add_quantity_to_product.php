<?php

use yii\db\Migration;

class m161228_144653_add_quantity_to_product extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE product add quantity int not null, add min_quantity int not null");
    }

    public function down()
    {
        echo "m161228_144653_add_quantity_to_product cannot be reverted.\n";

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
