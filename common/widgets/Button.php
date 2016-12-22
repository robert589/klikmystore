<?php 

namespace common\widgets;

use Yii;

class Button extends \yii\bootstrap\Widget
{
    
    const BLUE_COLOR = "button-blue";
    
    const ORANGE_COLOR = "button-orange";
    
    const GRAY_COLOR  = "button-gray";
    
    const NONE_COLOR = "button-none";
    
    const RED_COLOR = "button-red";
    
    public $id;
    
    public $text;
    
    public $color;
    
    public $widgetClass = "button";
    
    public $newClass = '';
    
    public $icon;
    
    public function init()
    {
        if($this->color === NULL) {
            $this->color = self::BLUE_COLOR;
        }
        parent::init();
    }
    
    public function run() {
        $class = $this->widgetClass . ' ' . $this->color . ' ' . $this->newClass;
        $iconClass = '';
        if($this->icon !== null) {
            $iconClass = "glyphicon glyphicon-" . $this->icon;
        }
        return $this->render('button', ['id' => $this->id, 'iconClass' => $iconClass,
                                        'text' => $this->text, 'class' => $class]);
    }
}
