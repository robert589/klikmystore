<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use frontend\vos\UserVo;
use frontend\vos\EmployeeVo;
/**
 * EmployeeDao class
 */
class EmployeeDao implements Dao
{
    const GET_ALL_EMPLOYEES = "SELECT user.*, user_email_authentication.email
                                FROM employee,user, user_email_authentication
                                where employee.id = user.id and user_email_authentication.user_id = user.id";
    
    
    public function getAllEmployees() {
        $results =  \Yii::$app->db
            ->createCommand(self::GET_ALL_EMPLOYEES)
            ->queryAll();
        $vos = [];
        
        foreach($results as $result) {
            $builder = EmployeeVo::createBuilder();
            $userBuilder = UserVo::createBuilder();
            $userBuilder->loadData($result);
            $builder->setUser($userBuilder->build());
            $vos[] = $builder->build();
        }
        return $vos;
    
    }
}

