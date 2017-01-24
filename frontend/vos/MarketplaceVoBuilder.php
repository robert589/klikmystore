<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * MarketplaceVo builder
 *
 */
class MarketplaceVoBuilder extends RVoBuilder
{
    function build() { return new MarketplaceVo($this);  }
    //attributes

    public $code;

    public $name;

    public $createdAt;

    public $updatedAt;

    public function rules() { 
        return [
           ['code','string'],
           ['name','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
        ];
    }

    //getters

    public function getCode() { 
        return $this->code; 
    }

    public function getName() { 
        return $this->name; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    //setters

    public function setCode($code) { 
        $this->code = $code; 
    }

    public function setName($name) { 
        $this->name = $name; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }
}