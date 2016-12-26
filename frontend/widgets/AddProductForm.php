<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddProductForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-product-form', ['id' => $this->id]);
    }
}
