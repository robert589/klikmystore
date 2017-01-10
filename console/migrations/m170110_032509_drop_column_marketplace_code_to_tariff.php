<?php

use yii\db\Migration;

class m170110_032509_drop_column_marketplace_code_to_tariff extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE tariff drop column marketplace_code");
    }

    public function down()
    {
        echo "m170110_032509_drop_column_marketplace_code_to_tariff cannot be reverted.\n";

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
