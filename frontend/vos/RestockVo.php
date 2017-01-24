<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * RestockVo vo
 *
 */
class RestockVo implements RVo
{
    public static function createBuilder() { return new RestockVoBuilder();} 
    //attributes

    private $id;

    private $supplier;

    private $restockProducts;

    public function __construct(RestockVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->supplier = $builder->getSupplier(); 
        $this->restockProducts = $builder->getRestockProducts(); 
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
}