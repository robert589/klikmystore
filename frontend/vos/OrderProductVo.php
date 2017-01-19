<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * OrderProductVo vo
 *
 */
class OrderProductVo implements RVo
{
    public static function createBuilder() { return new OrderProductVoBuilder();} 
    //attributes

    private $orderId;
    
    private $product;
    
    /**
     * DEPRECATED : Change with $product
     * @var type 
     */
    private $productId;

    private $price;

    private $weight;

    private $quantity;

    private $createdAt;

    private $updatedAt;

    public function __construct(OrderProductVoBuilder $builder) { 
        $this->orderId = $builder->getOrderId(); 
        $this->productId = $builder->getProductId(); 
        $this->price = $builder->getPrice(); 
        $this->weight = $builder->getWeight(); 
        $this->quantity = $builder->getQuantity(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->product = $builder->getProduct();
        $this->updatedAt = $builder->getUpdatedAt(); 
    }

    //getters

    public function getOrderId() { 
        return $this->orderId; 
    }

    public function getProductId() { 
        return $this->productId; 
    }

    public function getPrice() { 
        return $this->price; 
    }

    public function getWeight() { 
        return $this->weight; 
    }

    public function getQuantity() { 
        return $this->quantity; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }
    
    public function getProduct() {
        return $this->product;
    }
    
}