<?php

namespace frontend\widgets;

use yii\base\Widget;

class ProductOrderField extends Widget {
    
    public $id;
    
    public $name;
    
    public $checkRange = true;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('product-order-field', 
                    ['id' => $this->id, 'name' => $this->name, 'checkRange' => $this->checkRange]);
    }
}
