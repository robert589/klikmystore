<?php

use yii\db\Migration;

class m161227_114729_create_table_product_category extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE product_category("
                . "product_id int not null,"
                . "category_id int not null,"
                . "created_at int not null,"
                . "updated_at int not null,"
                . "primary key(product_id, category_id),"
                . "foreign key(product_id) references product(id),"
                . "foreign key(category_id) references category(id));");

    }

    public function down()
    {
        echo "m161227_114729_create_table_product_category cannot be reverted.\n";

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
