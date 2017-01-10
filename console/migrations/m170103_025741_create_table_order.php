<?php

use yii\db\Migration;

class m170103_025741_create_table_order extends Migration
{
    public function up()
    {
        $this->execute("CREATE TABLE orders("
                . "id int not null primary key,"
                . "sender_id int not null,"
                . "receiver_id int not null,"
                . "marketplace_code varchar(100) not null,"
                . "courier_code varchar(100) not null,"
                . "job_code varchar(100) not null,"
                . "pickup int not null,"
                . "user_id int not null,"
                . "print_label boolean not null default 0,"
                . "print_invoice boolean not null default 0,"
                . "paper_type varchar(50) not null,"
                . "created_at int not null,"
                . "updated_at int not null,"
                . "status int not null,"
                . "foreign key(sender_id) references user(id),"
                . "foreign key(receiver_id) references user(id),"
                . "foreign key(marketplace_code) references marketplace(code),"
                . "foreign key(courier_code) references courier(code),"
                . "foreign key(user_id) references user(id)"
                . ");");
    }

    public function down()
    {
        echo "m170103_025741_create_table_order cannot be reverted.\n";

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
