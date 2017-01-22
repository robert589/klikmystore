<?php

namespace frontend\widgets;

use yii\base\Widget;

class ProductAdjustmentFieldItem extends Widget {
    
    public $id;
    
    public $vo;
    
    public $value = 0;
    
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('product-adjustment-field-item', 
                ['id' => $this->id, 'value' => $this->value, 'vo' => $this->vo]);
    }
}
