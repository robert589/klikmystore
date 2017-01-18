<?php

namespace frontend\widgets;

use yii\base\Widget;

class RestockForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('restock-form', ['id' => $this->id]);
    }
}
