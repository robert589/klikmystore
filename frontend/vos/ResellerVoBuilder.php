<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * ResellerVo builder
 *
 */
class ResellerVoBuilder extends RVoBuilder
{
    function build() { return new ResellerVo($this);  }
    //attributes

    public $user;

    public function rules() { 
        return [
           ['user','string'],
        ];
    }

    //getters

    public function getUser() { 
        return $this->user; 
    }

    //setters

    public function setUser($user) { 
        $this->user = $user; 
    }
}