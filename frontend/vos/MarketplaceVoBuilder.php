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

    public function rules() { 
        return [
           ['code','string'],
           ['name','string'],
        ];
    }

    //getters

    public function getCode() { 
        return $this->code; 
    }

    public function getName() { 
        return $this->name; 
    }

    //setters

    public function setCode($code) { 
        $this->code = $code; 
    }

    public function setName($name) { 
        $this->name = $name; 
    }
}