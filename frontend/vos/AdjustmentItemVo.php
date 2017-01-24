<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * AdjustmentItemVo vo
 *
 */
class AdjustmentItemVo implements RVo
{
    public static function createBuilder() { return new AdjustmentItemVoBuilder();} 
    //attributes

    private $id;

    private $adjustmentId;

    private $product;

    private $adjust;

    private $createdAt;

    private $updatedAt;

    public function __construct(AdjustmentItemVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->adjustmentId = $builder->getAdjustmentId(); 
        $this->product = $builder->getProduct(); 
        $this->adjust = $builder->getAdjust(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getAdjustmentId() { 
        return $this->adjustmentId; 
    }

    public function getProduct() { 
        return $this->product; 
    }

    public function getAdjust() { 
        return $this->adjust; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }
}