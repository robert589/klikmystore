<?php

use yii\db\Migration;

class m161231_150211_insert_product_quantity_to_product_inventory extends Migration
{
    public function up()
    {
        $this->execute("INSERT INTO product_inventory(product_id, quantity,created_at, updated_at)"
                . " SELECT id, quantity, created_at, updated_at from product");
    }

    public function down()
    {
        echo "m161231_150211_insert_product_quantity_to_product_inventory cannot be reverted.\n";

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
