<?php

namespace frontend\widgets;

use yii\base\Widget;

class AssignRoleToEmployeeForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('assign-role-to-employee-form', ['id' => $this->id]);
    }
}
