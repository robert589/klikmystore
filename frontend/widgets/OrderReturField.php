<?php

namespace frontend\widgets;

use yii\base\Widget;

class OrderReturField extends Widget {
    
    public $id;
    
    public $vos;
    
    public $name;
    public function init() {
        
    }
    
    public function run() {
        return $this->render('order-retur-field',
                ['id' => $this->id, 'vos' => $this->vos, 'name' => $this->name]);
    }
}
