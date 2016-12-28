<?php

use yii\db\Migration;

class m161228_143708_product_image extends Migration
{
    public function up()
    {
        $this->execute("CREATE table product_image("
                . "image_id int not null,"
                . "product_id int not null,"
                . "created_at int not null,"
                . "updated_at int not null,"
                . "primary key(image_id, product_id),"
                . "foreign key(image_id) references image(id),"
                . "foreign key(product_id) references product(id));");
    }

    public function down()
    {
        echo "m161228_143708_product_image cannot be reverted.\n";

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
