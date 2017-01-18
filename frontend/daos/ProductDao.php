<?php
namespace frontend\daos;

use Yii;
use frontend\vos\ProductVoBuilder;
use common\components\Dao;
/**
 * ProductDao class
 */
class ProductDao implements Dao
{

    const SEARCH_PRODUCT = "select product.id, product.name
             from product 
             where product.name LIKE :query 
             limit 4";
    
    const PRODUCT_INFO = "select product.id, product.name, "
            . "         product_inventory.quantity, product.price_1, product.weight "
            . " from product, product_inventory"
            . " where product.id = product_inventory.product_id and product.id = :product_id ";
    
    const GET_PRODUCT = "select product.id, product.name, "
            . "                 product_inventory.quantity, product.price_1, product.weight "
                    . " from product, product_inventory"
                    . " where product.id = product_inventory.product_id";
    
    public function searchProduct($query) {
        $query = "%$query%";
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_PRODUCT)
            ->bindParam(':query', $query)
            ->queryAll();
        
        //\Yii::$app->end(var_dump($results));
        $vos = [];
        foreach($results as $result) {
            $builder = new ProductVoBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }    
    
    public function getProductInfo($productId) {
        $result =  \Yii::$app->db
            ->createCommand(self::PRODUCT_INFO)
            ->bindParam(':product_id', $productId)
            ->queryOne();
        
        $builder = new ProductVoBuilder();
        $builder->loadData($result);
        return $builder->build();
    }
    
    public function getProductList() {
        $results =  \Yii::$app->db
            ->createCommand(self::GET_PRODUCT)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
    
            $builder = new ProductVoBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        
        }
        
        return $vos;
    }
}

