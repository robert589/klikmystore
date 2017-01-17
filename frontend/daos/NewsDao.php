<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use frontend\vos\NewsVo;
/**
 * NewsDao class
 */
class NewsDao implements Dao
{
    
    const GET_NEWS_LIST = "SELECT news.*, "
            . "                 concat(user.first_name, ' ', user.last_name) as name "
            . "             from news, user "
            . "             where news.user_id = user.id"
            . "             order by created_at desc ";
    
    public function getNewsList() {
        $results =  \Yii::$app->db
            ->createCommand(self::GET_NEWS_LIST)
            ->queryAll();
        $vos = [];
        
        foreach($results as $result) {
            $builder = NewsVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;

    }
}

