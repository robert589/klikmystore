<?php

use yii\db\Migration;

class m161227_024411_create_table_category extends Migration
{
    public function up()
    {
        $this->execute("create table category("
                        . "id int not null primary key auto_increment,"
                        . "name varchar(100) not null unique,"
                        . "created_at int not null,"
                        . "updated_at int not null,"
                        . "description text null"
                        . ");");
    }

    public function down()
    {
        echo "m161227_024411_create_table_category cannot be reverted.\n";

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
