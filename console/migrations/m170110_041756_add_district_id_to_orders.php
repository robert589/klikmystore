<?php

use yii\db\Migration;

class m170110_041756_add_district_id_to_orders extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE orders add district_id int not null, add foreign key(district_id) references district(id)");
    }

    public function down()
    {
        echo "m170110_041756_add_district_id_to_orders cannot be reverted.\n";

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
