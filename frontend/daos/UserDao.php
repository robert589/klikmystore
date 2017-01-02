<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use frontend\vos\UserVoBuilder;
/**
 * UserDao class
 */
class UserDao implements Dao
{
    const SEARCH_USER = "select user.id, user.first_name, user.last_name 
            from user
             where user.first_name LIKE :query or user.last_name LIKE :query or
                 concat(user.first_name, ' ', user.last_name) LIKE :query ";

    public function searchUser($query) {
        $query = "%$query%";
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_USER)
            ->bindParam(':query', $query)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = new UserVoBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }
}

