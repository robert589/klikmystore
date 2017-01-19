<?php

namespace frontend\widgets;

use yii\base\Widget;

class ReturForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('retur-form', ['id' => $this->id]);
    }
}
