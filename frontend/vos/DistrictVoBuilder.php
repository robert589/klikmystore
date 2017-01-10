<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * DistrictVo builder
 *
 */
class DistrictVoBuilder extends RVoBuilder
{
    function build() { return new DistrictVo($this);  }
    //attributes

    public $name;

    public $id;

    public function rules() { 
        return [
           ['name','string'],
           ['id','string'],
        ];
    }

    //getters
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    public function getName() { 
        return $this->name; 
    }

    public function getId() { 
        return $this->id; 
    }

    //setters
    public function setName($name) { 
        $this->name = $name; 
    }

    public function setId($id) { 
        $this->id = $id; 
    }
}