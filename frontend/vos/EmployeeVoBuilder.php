<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * EmployeeVo builder
 *
 */
class EmployeeVoBuilder extends RVoBuilder
{
    function build() { return new EmployeeVo($this);  }
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