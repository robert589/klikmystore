<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * AdjustmentVo builder
 *
 */
class AdjustmentVoBuilder extends RVoBuilder
{
    function build() { return new AdjustmentVo($this);  }
    //attributes

    public $id;

    public $remark;

    public $user;

    public $createdAt;

    public $updatedAt;

    public $adjustments;

    public function rules() { 
        return [
           ['id','string'],
           ['remark','string'],
           ['user','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
           ['adjustments','string'],
        ];
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

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setRemark($remark) { 
        $this->remark = $remark; 
    }

    public function setUser($user) { 
        $this->user = $user; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }

    public function setAdjustments($adjustments) { 
        $this->adjustments = $adjustments; 
    }
}