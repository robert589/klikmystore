<?php

namespace frontend\widgets;

use yii\base\Widget;

class CreateRoleForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('create-role-form', ['id' => $this->id]);
    }
}
