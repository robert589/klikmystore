<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * SupplierVo builder
 *
 */
class SupplierVoBuilder extends RVoBuilder
{
    function build() { return new SupplierVo($this);  }
    //attributes

    public $user;

    public $phone;

    public $address;

    public $companyName;

    public function rules() { 
        return [
           ['user','string'],
           ['phone','string'],
           ['address','string'],
           ['companyName','string'],
        ];
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

    //setters

    public function setUser($user) { 
        $this->user = $user; 
    }

    public function setPhone($phone) { 
        $this->phone = $phone; 
    }

    public function setAddress($address) { 
        $this->address = $address; 
    }

    public function setCompanyName($companyName) { 
        $this->companyName = $companyName; 
    }
}