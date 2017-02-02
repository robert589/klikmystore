<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddResellerForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-reseller-form', ['id' => $this->id]);
    }
}
