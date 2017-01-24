<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use frontend\vos\CourierVo;
/**
 * CourierDao class
 */
class CourierDao implements Dao
{
    const COURIER_LIST = "SELECT courier.code, "
            . "                      courier.name, "
            . "                      courier.created_at, "
            . "                      courier.updated_at"
                    . "         from courier ";
    
    
    public function getCourier() {
        $results =  \Yii::$app->db
            ->createCommand(self::COURIER_LIST)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            
            $builder = CourierVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }
}

