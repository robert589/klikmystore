<?php

namespace frontend\widgets;

use yii\base\Widget;

class WholesaleField extends Widget {
    
    public $id;
    
    public $newClass;
    public function init() {
        
    }
    
    public function run() {
        return $this->render('wholesale-field', ['id' => $this->id, 'newClass' => $this->newClass]);
    }
}
