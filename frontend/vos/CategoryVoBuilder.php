<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * CategoryVo builder
 *
 */
class CategoryVoBuilder extends RVoBuilder
{
    function build() { return new CategoryVo($this);  }
    //attributes

    public $id;

    public $name;

    public $description;

    public function rules() { 
        return [
           ['id','string'],
           ['name','string'],
           ['description','string'],
        ];
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getName() { 
        return $this->name; 
    }

    public function getDescription() { 
        return $this->description; 
    }

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setName($name) { 
        $this->name = $name; 
    }

    public function setDescription($description) { 
        $this->description = $description; 
    }
}