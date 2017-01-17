<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m170116_132911_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("CREATE TABLE news("
                . "id int not null primary key auto_increment,"
                . "user_id int not null,"
                . "news text not null,"
                . "created_at int not null,"
                . "updated_at int not null)");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news');
    }
}
