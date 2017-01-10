<?php

use yii\db\Migration;

class m170110_060059_create_table_orders_product extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE orders_product("
                . "order_id int not null,"
                . "product_id int not null,"
                . "price float not null,"
                . "weight float not null,"
                . "quantity int not null,"
                . "created_at int not null,"
                . "updated_at int not null,"
                . "primary key(order_id, product_id),"
                . "foreign key(order_id) references orders(id),"
                . "foreign key(product_id) references product(id))");
    }

    public function down()
    {
        echo "m170110_060059_create_table_orders_product cannot be reverted.\n";

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
