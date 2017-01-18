<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * SupplierVo vo
 *
 */
class SupplierVo implements RVo
{
    public static function createBuilder() { return new SupplierVoBuilder();} 
    //attributes

    private $user;

    private $phone;

    private $address;

    private $companyName;

    public function __construct(SupplierVoBuilder $builder) { 
        $this->user = $builder->getUser(); 
        $this->phone = $builder->getPhone(); 
        $this->address = $builder->getAddress(); 
        $this->companyName = $builder->getCompanyName(); 
    }

    //getters

    public function getUser() { 
        return $this->user; 
    }

    public function getPhone() { 
        return $this->phone; 
    }

    public function getAddress() { 
        return $this->address; 
    }

    public function getCompanyName() { 
        return $this->companyName; 
    }
}