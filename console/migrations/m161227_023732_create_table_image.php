<?php

use yii\db\Migration;

class m161227_023732_create_table_image extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE image("
                . "id int not null primary key,"
                . "user_id int not null,"
                . "path varchar(100) not null, "
                . "created_at int not null,"
                . "updated_at int not null,"
                . "foreign key(id) references user(id));");
    }

    public function down()
    {
        echo "m161227_023732_create_table_image cannot be reverted.\n";

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
