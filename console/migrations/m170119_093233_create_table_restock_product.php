<?php

use yii\db\Migration;

class m170119_093233_create_table_restock_product extends Migration
{
    public function up()
    {
            $this->execute("CREATE TABLE restock_product("
                . "id int not null primary key auto_increment,"
                . "restock_id int not null,"
                . "product_id int not null,"
                . "quantity int not null,"
                . "foreign key(product_id) references product(id),"
                . "foreign key(restock_id) references restock(id))");
    }

    public function down()
    {
        echo "m170119_093233_create_table_restock_product cannot be reverted.\n";

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
