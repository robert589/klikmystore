<?php

use yii\db\Migration;

class m161231_150639_change_quantity_name extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE product Change quantity init_quantity int not null;");
    }

    public function down()
    {
        echo "m161231_150639_change_quantity_name cannot be reverted.\n";

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
