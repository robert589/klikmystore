<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * UserVo vo
 *
 */
class UserVo implements RVo
{
    public static function createBuilder() { return new UserVoBuilder();} 
    //attributes

    private $id;

    private $firstName;

    private $lastName;

    private $address;

    private $telephone;

    public function __construct(UserVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->firstName = $builder->getFirstName(); 
        $this->lastName = $builder->getLastName(); 
        $this->address = $builder->getAddress(); 
        $this->telephone = $builder->getTelephone(); 
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getFirstName() { 
        return $this->firstName; 
    }

    public function getLastName() { 
        return $this->lastName; 
    }

    public function getAddress() { 
        return $this->address; 
    }

    public function getTelephone() { 
        return $this->telephone; 
    }
    
    public function getName() {
        return $this->firstName . ' ' . $this->lastName; 
    }
}