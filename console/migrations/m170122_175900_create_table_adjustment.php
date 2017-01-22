<?php

use yii\db\Migration;

class m170122_175900_create_table_adjustment extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE adjustment("
                . "id int not null primary key auto_increment,"
                . "remark text not null,"
                . "user_id int not null,"
                . "foreign key(user_id) references user(id),"
                . "created_at int not null,"
                . "updated_at int not null)");
    }

    public function down()
    {
        echo "m170122_175900_create_table_adjustment cannot be reverted.\n";

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
