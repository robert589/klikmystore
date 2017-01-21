<?php

use yii\db\Migration;

class m170120_081930_add_effect_to_retur_order extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE retur add effect int not null default 0");

    }

    public function down()
    {
        echo "m170120_081930_add_effect_to_retur_order cannot be reverted.\n";

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
