<?php

namespace frontend\widgets;

use yii\base\Widget;

class PrintOrderModal extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('print-order-modal', ['id' => $this->id]);
    }
}
