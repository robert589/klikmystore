<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * OrderProductVo builder
 *
 */
class OrderProductVoBuilder extends RVoBuilder
{
    function build() { return new OrderProductVo($this);  }
    //attributes

    public $orderId;

    public $productId;

    public $price;

    public $weight;

    public $quantity;

    public $createdAt;

    public $updatedAt;

    public function rules() { 
        return [
           ['orderId','string'],
           ['productId','string'],
           ['price','string'],
           ['weight','string'],
           ['quantity','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
        ];
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

    //setters

    public function setOrderId($orderId) { 
        $this->orderId = $orderId; 
    }

    public function setProductId($productId) { 
        $this->productId = $productId; 
    }

    public function setPrice($price) { 
        $this->price = $price; 
    }

    public function setWeight($weight) { 
        $this->weight = $weight; 
    }

    public function setQuantity($quantity) { 
        $this->quantity = $quantity; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }
}