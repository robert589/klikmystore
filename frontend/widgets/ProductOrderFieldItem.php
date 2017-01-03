<?php

namespace frontend\widgets;

use yii\base\Widget;

class ProductOrderFieldItem extends Widget {
    
    public $id;
    
    public $vo;
    
    public $quantity;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('product-order-field-item', ['id' => $this->id, 'vo' => $this->vo, 'quantity' => $this->quantity]);
    }
}
