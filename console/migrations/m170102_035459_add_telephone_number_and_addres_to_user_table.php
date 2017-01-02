<?php

use yii\db\Migration;

class m170102_035459_add_telephone_number_and_addres_to_user_table extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE user add telephone varchar(100) null, add address varchar(255) null;");
        
    }

    public function down()
    {
        echo "m170102_035459_add_telephone_number_and_addres_to_user_table cannot be reverted.\n";

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
