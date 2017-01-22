<?php

use yii\db\Migration;

class m170122_180257_create_table_adjustment_item extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE adjustment_item("
                . "id int not null primary key auto_increment,"
                . "adjustment_id int not null,"
                . "product_id int not null,"
                . "adjust int not null,"
                . "created_at int not null,"
                . "updated_at int not null,"
                . "foreign key(adjustment_id) references adjustment(id),"
                . "foreign key(product_id) references product(id))");
    }

    public function down()
    {
        echo "m170122_180257_create_table_adjustment_item cannot be reverted.\n";

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
