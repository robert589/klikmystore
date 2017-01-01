<?php

namespace frontend\widgets;

use yii\base\Widget;

class CreateCourierForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('create-courier-form', ['id' => $this->id]);
    }
}
