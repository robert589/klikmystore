<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * RestockProductVo vo
 *
 */
class RestockProductVo implements RVo
{
    public static function createBuilder() { return new RestockProductVoBuilder();} 
    //attributes

    private $id;

    private $restockId;

    private $product;

    private $quantity;

    private $createdAt;

    private $updatedAt;

    public function __construct(RestockProductVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->restockId = $builder->getRestockId(); 
        $this->product = $builder->getProduct(); 
        $this->quantity = $builder->getQuantity(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
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
}