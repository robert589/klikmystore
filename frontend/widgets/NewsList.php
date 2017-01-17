<?php

namespace frontend\widgets;

use yii\base\Widget;

class NewsList extends Widget {
    
    public $id;
    
    public $vos;
    
    public function init() {
        if(!$this->vos) {
            $this->vos = [];
        }
    }
    
    public function run() {
        return $this->render('news-list', ['id' => $this->id, 'vos' => $this->vos]);
    }
}
