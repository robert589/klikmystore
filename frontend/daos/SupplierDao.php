<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use frontend\vos\SupplierVo;
use frontend\vos\UserVo;
use common\models\User;
/**
 * SupplierDao class
 */
class SupplierDao implements Dao
{
    const GET_SUPPLIERS = "SELECT user.first_name as user_first_name, "
            . "                 user.last_name as user_last_name,"
            . "                   user.telephone as user_telephone, "
            . "                   user.id as user_id,"
            . "                     user.address as user_address,"
            . "                 supplier.company_name,"
            . "                 user_email_authentication.email as user_email"
            . "            from user, supplier, user_email_authentication"
            . "             where user.id = supplier.id "
            . "         and user_email_authentication.user_id = user.id "
            . "         and user.status = :status";
    
    public function getSuppliers() {
        $status = User::STATUS_ACTIVE;
        $results =  \Yii::$app->db
            ->createCommand(self::GET_SUPPLIERS)
            ->bindParam(':status', $status  )
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $userBuilder = new \frontend\vos\UserVoBuilder;
            $userBuilder->loadData($result, "user");
            
            $supplierBuilder = SupplierVo::createBuilder();
            $supplierBuilder->loadData($result);
            $supplierBuilder->setUser(($userBuilder->build()));
            $vos[] = $supplierBuilder->build();
        }
        
        return $vos;
    }
}

