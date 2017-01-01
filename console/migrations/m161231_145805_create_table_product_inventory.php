<?php

use yii\db\Migration;

class m161231_145805_create_table_product_inventory extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE product_inventory("
                . "product_id int not null primary key,"
                . "quantity int not null,"
                . "created_at int not null,"
                . "updated_at int not null)");
    }

    public function down()
    {
        echo "m161231_145805_create_table_product_inventory cannot be reverted.\n";

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
