<?php
namespace frontend\daos;

use Yii;
use frontend\vos\MarketplaceVoBuilder;
use frontend\vos\CourierVoBuilder;
use common\components\Dao;
use frontend\vos\MarketplaceVo;
use frontend\vos\UserVo;
USE frontend\vos\OrderProductVo;
use frontend\vos\OrderVo;
use frontend\vos\CourierVo;
use frontend\vos\ProductVo;
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
    
    const SEARCH_ORDER_ID = "select orders.id"
            . " from orders"
            . " where orders.id LIKE :query"
            . " limit 4 ";
    
    const ORDER_LIST = "select orders.*, sender.id as sender_id, sender.first_name as sender_first_name,
                         sender.last_name as sender_last_name, receiver.id as receiver_id, 
                         receiver.first_name as receiver_first_name, receiver.last_name as receiver_last_name,
                         marketplace.code as marketplace_code, marketplace.name as marketplace_name,
                         courier.code as courier_code, courier.name as courier_name
                     from orders, marketplace, user sender, user receiver, courier 
                     where orders.marketplace_code = marketplace.code and
                             sender.id = orders.sender_id and
                             receiver.id = orders.receiver_id and
                             orders.courier_code = courier.code ";
    
    const ORDERS_PRODUCT = "select * 
                            from orders_product
                            where orders_product.order_id = :order_id ";
    
    
    /**
     * 
     * Not complete, need to include retur
     */
    const ORDERS_PRODUCT_WITH_RETUR = "select orders_product.*,
                                        product.name as product_name
                                    from orders_product, product
                                    where orders_product.order_id = :order_id

                                        and product.id = orders_product.product_id ";
    
    const ORDER_INFO = "select orders.*, sender.id as sender_id, sender.first_name as sender_first_name,
                         sender.last_name as sender_last_name, receiver.id as receiver_id, 
                         receiver.first_name as receiver_first_name, receiver.last_name as receiver_last_name,
                         marketplace.code as marketplace_code, marketplace.name as marketplace_name,
                         courier.code as courier_code, courier.name as courier_name
                     from orders, marketplace, user sender, user receiver, courier 
                     where orders.marketplace_code = marketplace.code and
                             sender.id = orders.sender_id and
                             receiver.id = orders.receiver_id and
                             orders.courier_code = courier.code and orders.id = :order_id";
    public function getOrderInfo($orderId) {
        $result =  \Yii::$app->db
            ->createCommand(self::ORDER_INFO)
            ->bindParam(':order_id', $orderId)
            ->queryOne();
        
        $builder = OrderVo::createBuilder();

        $marketplaceBuilder = MarketplaceVo::createBuilder();
        $marketplaceBuilder->loadData($result, "marketplace");
        $builder->setMarketplace($marketplaceBuilder->build());

        $courierBuilder = CourierVo::createBuilder();
        $courierBuilder->loadData($result, "courier");
        $builder->setCourier($courierBuilder->build());

        $senderBuilder = UserVo::createBuilder();
        $senderBuilder->loadData($result, "sender");
        $builder->setSender($senderBuilder->build());

        $receiverBuilder = UserVo::createBuilder();
        $receiverBuilder->loadData($result, "receiver");
        $builder->setReceiver($receiverBuilder->build());
       
        $builder->setProducts($this->getOrderProducts($result['id']));
        $builder->loadData($result);

        return $builder->build();
    }
    
    public function orderList() {
        $results =  \Yii::$app->db
            ->createCommand(self::ORDER_LIST)
            ->queryAll();
        
        $vos = [];
        
        foreach($results as $result) {
            $builder = OrderVo::createBuilder();
            
            $marketplaceBuilder = MarketplaceVo::createBuilder();
            $marketplaceBuilder->loadData($result, "marketplace");
            $builder->setMarketplace($marketplaceBuilder->build());
            
            $courierBuilder = CourierVo::createBuilder();
            $courierBuilder->loadData($result, "courier");
            $builder->setCourier($courierBuilder->build());
            
            $senderBuilder = UserVo::createBuilder();
            $senderBuilder->loadData($result, "sender");
            $builder->setSender($senderBuilder->build());
            
            $receiverBuilder = UserVo::createBuilder();
            $receiverBuilder->loadData($result, "receiver");
            $builder->setReceiver($receiverBuilder->build());
            
            $builder->setProducts($this->getOrderProducts($result['id']));
            $builder->loadData($result);
            
            $vos[] = $builder->build();
        }
        return $vos;
    }
    
    public function getOrderProducts($orderId) {
        $results =  \Yii::$app->db
            ->createCommand(self::ORDERS_PRODUCT)
            ->bindParam(':order_id', $orderId)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = OrderProductVo::createBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
    public function getOrderProductsWithRetur($orderId) {
        $results =  \Yii::$app->db
            ->createCommand(self::ORDERS_PRODUCT_WITH_RETUR)
            ->bindParam(':order_id', $orderId)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $productBuilder = ProductVo::createBuilder();
            $productBuilder->loadData($result, "product");
            
            $builder = OrderProductVo::createBuilder();
            $builder->loadData($result);
            $builder->setProduct($productBuilder->build());
            $vos[] = $builder->build();
        }
        
        return $vos;
    }
    
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
    
    public function searchOrderId($q) {
        $query = "%$q%";
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_ORDER_ID)
            ->bindParam(':query', $query)
            ->queryAll();
        
        return array_column($results, "id");
    }
}

