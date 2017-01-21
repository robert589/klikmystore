<?php

namespace frontend\widgets;

use yii\base\Widget;

class ProductAdjustmentField extends Widget {
    
    public $id;
    
    public $name;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('product-adjustment-field', ['id' => $this->id, 'name' => $this->name]);
    }
}
