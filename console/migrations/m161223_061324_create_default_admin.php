<?php

use yii\db\Migration;
use frontend\models\SignupForm;

class m161223_061324_create_default_admin extends Migration
{
    public function up()
    {
        $model = new SignupForm();
        $model->first_name = "Admin";
        $model->last_name = "Klikmystore";
        $model->email = "admin.klikmystore@gmail.com";
        $model->password = "password";
        $model->signup();
    }

    public function down()
    {
        echo "m161223_061324_create_default_admin cannot be reverted.\n";

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
