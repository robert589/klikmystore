<?php

use yii\db\Migration;

class m170109_074754_drop_all_location_tables extends Migration
{
    public function up()
    {
        $this->execute("DROP TABLE village;DROP TABLE district;DROP TABLE regency; DROP TABLE province;");
    }

    public function down()
    {
        echo "m170109_074754_drop_all_location_tables cannot be reverted.\n";

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
