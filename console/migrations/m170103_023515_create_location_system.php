<?php

use yii\db\Migration;

class m170103_023515_create_location_system extends Migration
{
    public function up()
    {
        $url = "https://raw.githubusercontent.com/edwardsamuel/Wilayah-Administratif-Indonesia/master/mysql/indonesia.sql";
        $response = file_get_contents($url);
        $this->execute($response);
        
        $this->execute("RENAME TABLE provinces to province");
        $this->execute("RENAME TABLE regencies to regency");
        $this->execute("RENAME TABLE villages to village");
        $this->execute("RENAME TABLE districts to district");
        
    }

    public function down()
    {
        echo "m170103_023515_create_location_system cannot be reverted.\n";

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
