<?php

use yii\db\Migration;

class m170201_072405_create_table_employee extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE employee(
            id int not null primary key,
            foreign key(id) references user(id))");
    }

    public function down()
    {
        echo "m170201_072405_create_table_employee cannot be reverted.\n";

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
