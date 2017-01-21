<?php

use yii\db\Migration;

class m170120_082650_add_created_updated_at_to_retur extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE retur add created_at int not null, add updated_at int not null");
    }

    public function down()
    {
        echo "m170120_082650_add_created_updated_at_to_retur cannot be reverted.\n";

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
