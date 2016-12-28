<?php

use yii\db\Migration;

class m161228_091127_add_auto_increment extends Migration
{
    public function up()
    {
        $this->execute("alter table image modify column id int auto_increment");
        $this->execute("alter table product modify column id int auto_increment");
        $this->execute("alter table category modify column id int auto_increment");
        $this->execute("alter table product_wholesale modify column id int auto_increment");
        
    }

    public function down()
    {
        echo "m161228_091127_add_auto_increment cannot be reverted.\n";

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
