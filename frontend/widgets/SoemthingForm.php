<?php

namespace frontend\widgets;

use yii\base\Widget;

class SoemthingForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('soemthing-form', ['id' => $this->id]);
    }
}
