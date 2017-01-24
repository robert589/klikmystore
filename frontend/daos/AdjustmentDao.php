<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use frontend\vos\AdjustmentVo;
use frontend\vos\AdjustmentItemVo;
use frontend\vos\UserVo;
use frontend\vos\ProductVo;
/**
 * AdjustmentDao class
 */
class AdjustmentDao implements Dao
{
    const ADJUSTMENT_LIST = "SELECT adjustment.id,"
            . "                     adjustment.remark,"
            . "                     user.id as user_id,"
            . "                     user.first_name as user_first_name,"
            . "                     user.last_name as user_last_name"
            . "              from adjustment, user"
            . "             where adjustment.user_id = user.id";
    
    const ADJUSTMENT_ITEM_BY_ID = "select adjustment_item.id, "
            . "                           adjustment_item.adjustment_id,"
            . "                           adjustment_item.adjust, "
            . "                           product.id as product_id,"
            . "                           product.name as product_name"
            . "                    from adjustment_item, product"
            . "                    where adjustment_item.adjustment_id = :adjustment_id and "
            . "                         adjustment_item.product_id = product.id";
    public function getAdjustmentItemById($adjustmentId) {
        $results =  \Yii::$app->db
            ->createCommand(self::ADJUSTMENT_ITEM_BY_ID)
            ->bindParam(':adjustment_id', $adjustmentId)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            $builder = AdjustmentItemVo::createBuilder();
            
            $productBuilder = ProductVo::createBuilder();
            $productBuilder->loadData($result, "product");
            $builder->setProduct($productBuilder->build());
            $builder->loadData($result);
            
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    public function adjustmentList() {
        $results =  \Yii::$app->db
            ->createCommand(self::ADJUSTMENT_LIST)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = AdjustmentVo::createBuilder();
            $builder->loadData($result);
            
            $userBuilder = UserVo::createBuilder();
            $userBuilder->loadData($result, "user");
            $builder->setUser($userBuilder->build());
            $builder->setAdjustments(
                    $this->getAdjustmentItemById($builder->getId()));
            $vos[] = $builder->build();
            
        }
        
        return $vos;
        
    }
}

