<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * RestockProductVo builder
 *
 */
class RestockProductVoBuilder extends RVoBuilder
{
    function build() { return new RestockProductVo($this);  }
    //attributes

    public $id;

    public $restockId;

    public $product;

    public $quantity;

    public $createdAt;

    public $updatedAt;

    public function rules() { 
        return [
           ['id','string'],
           ['restockId','string'],
           ['product','string'],
           ['quantity','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
        ];
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getRestockId() { 
        return $this->restockId; 
    }

    public function getProduct() { 
        return $this->product; 
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

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setRestockId($restockId) { 
        $this->restockId = $restockId; 
    }

    public function setProduct($product) { 
        $this->product = $product; 
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