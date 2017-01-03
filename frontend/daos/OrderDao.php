<?php
namespace frontend\daos;

use Yii;
use frontend\vos\MarketplaceVoBuilder;
use frontend\vos\CourierVoBuilder;
use common\components\Dao;
/**
 * OrderDao class
 */
class OrderDao implements Dao
{
    const SEARCH_MARKETPLACE = "select marketplace.code, marketplace.name
             from marketplace 
             where marketplace.name LIKE :query 
             limit 4";
    
    const SEARCH_COURIER = "select courier.code, courier.name
             from courier 
             where courier.name LIKE :query 
             limit 4";
    
    public function searchMarketplace($query) {
        $query = "%$query%";
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_MARKETPLACE)
            ->bindParam(':query', $query)
            ->queryAll();
        
        //\Yii::$app->end(var_dump($results));
        $vos = [];
        foreach($results as $result) {
            $builder = new MarketplaceVoBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }
    
    public function searchCourier($q) {
        $query = "%$q%";
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_COURIER)
            ->bindParam(':query', $query)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = new CourierVoBuilder();
            
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }
}

