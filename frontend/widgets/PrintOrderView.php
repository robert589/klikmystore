<?php

namespace frontend\widgets;

use yii\base\Widget;

class PrintOrderView extends Widget {
    
    public $id;
    
    public $vo;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('print-order-view', 
                ['id' => $this->id, 'vo' => $this->vo]);
    }
}
