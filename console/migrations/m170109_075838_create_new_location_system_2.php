<?php

use yii\db\Migration;

class m170109_075838_create_new_location_system_2 extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE district("
                . "id int not null primary key auto_increment,"
                . "regency_id int not null,"
                . "created_at int not null,"
                . "updated_at int not null,"
                . "foreign key(regency_id) references regency(id));");
    }

    public function down()
    {
        echo "m170109_075838_create_new_location_system_2 cannot be reverted.\n";

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
