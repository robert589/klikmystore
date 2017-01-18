<?php

use yii\db\Migration;

class m170118_133457_create_table_supplier extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE supplier("
                . "id int not null primary key,"
                . "company_name varchar(200) not null,"
                . "phone varchar(100)  null,"
                . "address varchar(100) null,"
                . "created_at int not null,"
                . "updated_at int not null,"
                . "foreign key(id) references user(id));");
    }

    public function down()
    {
        echo "m170118_133457_create_table_supplier cannot be reverted.\n";

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
