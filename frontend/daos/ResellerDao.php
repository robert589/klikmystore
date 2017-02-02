<?php
namespace frontend\daos;

use Yii;
use frontend\vos\ResellerVo;
use frontend\vos\UserVo;
use common\components\Dao;
/**
 * ResellerDao class
 */
class ResellerDao implements Dao
{
    const GET_ALL_RESELLERS = "SELECT user.*, user_email_authentication.email
                            FROM reseller,user, user_email_authentication
                            where reseller.id = user.id and user_email_authentication.user_id = user.id";
    
    
    public function getAllResellers() {
        $results =  \Yii::$app->db
            ->createCommand(self::GET_ALL_RESELLERS)
            ->queryAll();
        $vos = [];
        
        foreach($results as $result) {
            $builder = ResellerVo::createBuilder();
            $userBuilder = UserVo::createBuilder();
            $userBuilder->loadData($result);
            $builder->setUser($userBuilder->build());
            $vos[] = $builder->build();
        }
        return $vos;
    
    }

}

