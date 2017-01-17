<?php

namespace frontend\widgets;

use yii\base\Widget;

class CreateNewsForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('create-news-form', ['id' => $this->id]);
    }
}
