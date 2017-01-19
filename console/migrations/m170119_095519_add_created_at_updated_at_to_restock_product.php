<?php

use yii\db\Migration;

class m170119_095519_add_created_at_updated_at_to_restock_product extends Migration
{
    public function up()
    {

        $this->execute("ALTER TABLE restock_product  add created_at int not null, add updated_at int not null;");
    }

    public function down()
    {
        echo "m170119_095519_add_created_at_updated_at_to_restock_product cannot be reverted.\n";

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
