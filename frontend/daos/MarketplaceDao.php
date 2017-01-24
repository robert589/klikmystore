<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use frontend\vos\MarketplaceVo;
/**
 * MarketplaceDao class
 */
class MarketplaceDao implements Dao
{
    const MARKETPLACE_LIST = "SELECT marketplace.code, "
            . "                      marketplace.name, "
            . "                      marketplace.created_at, "
            . "                      marketplace.updated_at"
                    . "         from marketplace ";
    
    
    public function getMarketplaceList() {
        $results =  \Yii::$app->db
            ->createCommand(self::MARKETPLACE_LIST)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            
            $builder = MarketplaceVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }
}

