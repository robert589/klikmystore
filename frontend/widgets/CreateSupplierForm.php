<?php

namespace frontend\widgets;

use yii\base\Widget;

class CreateSupplierForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('create-supplier-form', ['id' => $this->id]);
    }
}
