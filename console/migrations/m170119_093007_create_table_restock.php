<?php

use yii\db\Migration;

class m170119_093007_create_table_restock extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE restock("
                . "id int not null auto_increment primary key,"
                . "supplier_id int not null,"
                . "foreign key(supplier_id) references supplier(id))");
    }

    public function down()
    {
        echo "m170119_093007_create_table_restock cannot be reverted.\n";

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
