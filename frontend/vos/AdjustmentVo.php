<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * AdjustmentVo vo
 *
 */
class AdjustmentVo implements RVo
{
    public static function createBuilder() { return new AdjustmentVoBuilder();} 
    //attributes

    private $id;

    private $remark;

    private $user;

    private $createdAt;

    private $updatedAt;

    private $adjustments;

    public function __construct(AdjustmentVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->remark = $builder->getRemark(); 
        $this->user = $builder->getUser(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
        $this->adjustments = $builder->getAdjustments(); 
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getRemark() { 
        return $this->remark; 
    }

    public function getUser() { 
        return $this->user; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    public function getAdjustments() { 
        return $this->adjustments; 
    }
}