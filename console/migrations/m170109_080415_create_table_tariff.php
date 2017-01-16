<?php

use yii\db\Migration;

class m170109_080415_create_table_tariff extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE tariff("
                . "id int not null primary key auto_increment,"
                . "destination_id int not null,"
                . "regular_tariff float not null,"
                . "regular_etd varchar(20) not null,"
                . "created_at int not null,"
                . "updated_at int not null,"
                . "courier_code varchar(10) not null, "
                . "foreign key(courier_code) references courier(code),"
                . "foreign key(marketplace_code) references marketplace(code),"
                . "foreign key(destination_id) references district(id)"
                . ");");
    }

    public function down()
    {
        echo "m170109_080415_create_table_tariff cannot be reverted.\n";

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
