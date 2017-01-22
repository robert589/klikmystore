<?php

use yii\db\Migration;

class m170119_101438_create_table_retur extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE retur("
                . "id int not null primary key auto_increment,"
                . "order_id int not null,"
                . "product_id int not null,"
                . "remark text null,"
                . "quantity int not null,"
                . "foreign key(order_id,product_id) references orders_product(order_id,product_id) "
                . ");");
    }

    public function down()
    {
        echo "m170119_101438_create_table_retur cannot be reverted.\n";

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
