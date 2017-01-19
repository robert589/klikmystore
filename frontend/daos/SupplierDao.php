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
    
    const SEARCH_SUPPLIER = "select user.id as user_id,
                                    user.first_name as user_first_name, 
                                    user.last_name as user_last_name
                            from user, supplier
                            where user.first_name LIKE :query or user.last_name LIKE :query or
                                concat(user.first_name, ' ', user.last_name) LIKE :query and
                                user.id = supplier.id
                                limit 4";
    
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
    
    public function searchSupplier($query) {
        $query = "%$query%";
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_SUPPLIER)
            ->bindParam(':query', $query)
            ->queryAll();
        $vos = [];
        foreach($results as $result) {
            $userBuilder = UserVo::createBuilder();
            $userBuilder->loadData($result, "user");
            $builder = SupplierVo::createBuilder();
            $builder->setUser($userBuilder->build());
            $vos[] = $builder->build();
        }
        return $vos;
    }
}

