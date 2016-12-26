<?php

namespace frontend\widgets;

use yii\base\Widget;

class DynamicWholesaleField extends Widget {
    
    public $id;
    
    public $name;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('dynamic-wholesale-field', ['id' => $this->id, 'name' => $this->name]);
    }
}
