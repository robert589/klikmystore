<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * RestockVo builder
 *
 */
class RestockVoBuilder extends RVoBuilder
{
    function build() { return new RestockVo($this);  }
    //attributes

    public $id;

    public $supplier;

    public $restockProducts;

    public function rules() { 
        return [
           ['id','string'],
           ['supplier','string'],
           ['restockProducts','string'],
        ];
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getSupplier() { 
        return $this->supplier; 
    }

    public function getRestockProducts() { 
        return $this->restockProducts; 
    }

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setSupplier($supplier) { 
        $this->supplier = $supplier; 
    }

    public function setRestockProducts($restockProducts) { 
        $this->restockProducts = $restockProducts; 
    }
}