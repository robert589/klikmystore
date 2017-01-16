<?php

use yii\db\Migration;

class m161227_023924_create_table_product extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE product("
                . "id int not null primary key auto_increment,"
                . "name varchar(100) not null,"
                . "sku varchar(100) not null,"
                . "weight float not null,"
                . "link varchar(200) not null,"
                . "price_1 float not null,"
                . "price_2 float not null,"
                . "price_3 float not null,"
                . "price_4 float not null,"
                . "created_at int not null,"
                . "updated_at int not null);");
    }

    public function down()
    {
        echo "m161227_023924_create_table_product cannot be reverted.\n";

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
