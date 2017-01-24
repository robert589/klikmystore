<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use frontend\vos\RestockVo;
use frontend\vos\RestockProductVo;
use frontend\vos\ProductVo;
use frontend\vos\UserVo;
/**
 * RestockDao class
 */
class RestockDao implements Dao
{
    const RESTOCK_LIST = "SELECT restock.id, "
            . "                 supplier.id as supplier_id,"
            . "                 supplier.first_name as supplier_first_name,"
            . "                 supplier.last_name as supplier_last_name"
            . "     from restock, user supplier "
            . "     where restock.supplier_id = supplier.id ";
    
    const RESTOCK_PRODUCT_BY_RESTOCK_ID = "
                SELECT product_inventory.quantity as product_quantity, 
                     restock_product.quantity,
                     restock_product.id,
                     restock_product.created_at,
                     restock_product.updated_at,
                     product.id as product_id,
                     product.weight as product_weight,
                     product.name as product_name
               FROM restock_product, product, product_inventory 
               where restock_product.product_id = product.id and 
                     product.id = product_inventory.product_id and
                     restock_product.restock_id = :restock_id ";
    
    
    public function restockList() {
        $results =  \Yii::$app->db
            ->createCommand(self::RESTOCK_LIST)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = RestockVo::createBuilder();
            $builder->loadData($result);
            
            $supBuilder = UserVo::createBuilder();
            $supBuilder->loadData($result, "supplier");
            $builder->setSupplier($supBuilder->build());
            $builder->setRestockProducts(
                    $this->getRestockProductByRestockId($builder->getId()));
            $vos[] = $builder->build();
            
        }
        
        return $vos;
        
    }
    
    public function getRestockProductByRestockId($restockId) {
        $results =  \Yii::$app->db
            ->createCommand(self::RESTOCK_PRODUCT_BY_RESTOCK_ID)
            ->bindParam(':restock_id', $restockId)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            $builder = RestockProductVo::createBuilder();
            
            $productBuilder = ProductVo::createBuilder();
            $productBuilder->loadData($result, "product");
            $builder->setProduct($productBuilder->build());
            $builder->loadData($result);
            
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
}

