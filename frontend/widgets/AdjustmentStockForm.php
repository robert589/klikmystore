<?php

namespace frontend\widgets;

use yii\base\Widget;

class AdjustmentStockForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('adjustment-stock-form', ['id' => $this->id]);
    }
}
