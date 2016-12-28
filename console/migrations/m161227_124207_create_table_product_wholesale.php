<?php

use yii\db\Migration;

class m161227_124207_create_table_product_wholesale extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE product_wholesale("
                . "id int not null primary key,"
                . "product_id int not null,"
                . "min int not null,"
                . "max int not null,"
                . "rate float not null,"
                . "created_at int not null,"
                . "updated_at int not null,"
                . "foreign key(product_id) references product(id));");
    }

    public function down()
    {
        echo "m161227_124207_create_table_product_wholesale cannot be reverted.\n";

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
