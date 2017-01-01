<?php

namespace frontend\widgets;

use yii\base\Widget;

class CreateMarketplaceForm extends Widget {
    
    public $id;
    
    public function init() {
        
    }
    
    public function run() {
        return $this->render('create-marketplace-form', ['id' => $this->id]);
    }
}
