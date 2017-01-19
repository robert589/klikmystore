<?php

use yii\db\Migration;

class m170119_095504_add_created_at_updated_at_to_restock extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE restock add created_at int not null, add updated_at int not null;");
    }

    public function down()
    {
        echo "m170119_095504_add_created_at_updated_at_to_restock cannot be reverted.\n";

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
