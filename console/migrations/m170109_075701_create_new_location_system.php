<?php

use yii\db\Migration;

class m170109_075701_create_new_location_system extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE regency("
                . "id int not null primary key auto_increment,"
                . "name varchar(100) not null,"
                . "created_at int not null,"
                . "updated_at int not null);");
    }

    public function down()
    {
        echo "m170109_075701_create_new_location_system cannot be reverted.\n";

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
