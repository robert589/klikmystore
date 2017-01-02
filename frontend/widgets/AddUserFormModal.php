<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddUserFormModal extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-user-form-modal', ['id' => $this->id]);
    }
}
