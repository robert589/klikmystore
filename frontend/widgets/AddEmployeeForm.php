<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddEmployeeForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-employee-form', ['id' => $this->id]);
    }
}
