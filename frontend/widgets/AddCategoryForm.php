<?php

namespace frontend\widgets;

use yii\base\Widget;

class AddCategoryForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('add-category-form', ['id' => $this->id]);
    }
}
