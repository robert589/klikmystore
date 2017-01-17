<?php

namespace frontend\widgets;

use yii\base\Widget;

class NewsItem extends Widget {
    
    public $id;
    
    public $vo;
    public function init() {
        
    }
    
    public function run() {
        return $this->render('news-item', ['id' => $this->id, 'vo' => $this->vo]);
    }
}
