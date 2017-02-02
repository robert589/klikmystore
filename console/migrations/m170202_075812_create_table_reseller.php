<?php

use yii\db\Migration;

class m170202_075812_create_table_reseller extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE reseller(
            id int not null primary key,
            foreign key(id) references user(id))");

    }

    public function down()
    {
        echo "m170202_075812_create_table_reseller cannot be reverted.\n";

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
