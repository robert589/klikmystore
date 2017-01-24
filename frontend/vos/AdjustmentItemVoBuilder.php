<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * AdjustmentItemVo builder
 *
 */
class AdjustmentItemVoBuilder extends RVoBuilder
{
    function build() { return new AdjustmentItemVo($this);  }
    //attributes

    public $id;

    public $adjustmentId;

    public $product;

    public $adjust;

    public $createdAt;

    public $updatedAt;

    public function rules() { 
        return [
           ['id','string'],
           ['adjustmentId','string'],
           ['product','string'],
           ['adjust','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
        ];
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

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setAdjustmentId($adjustmentId) { 
        $this->adjustmentId = $adjustmentId; 
    }

    public function setProduct($product) { 
        $this->product = $product; 
    }

    public function setAdjust($adjust) { 
        $this->adjust = $adjust; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }
}