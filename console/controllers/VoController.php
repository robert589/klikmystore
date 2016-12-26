<?php

namespace console\controllers;
use Yii;
use yii\console\Controller;
class ActiveController extends Controller {
    
    public $name;
    
    public $attrs;
    
    public function options($id) {
        return ['name', 'attrs'];
    }
    
    public function optionAliases() {
        return ['n' => 'name'];
    }
    
    public function actionCreate()
    {
        $dirPath = "frontend/models/" . $this->name . ".php" ;
        $attributes = explode(",", $this->attrs);
        
        $text = $this->getHeaderText($this->name);
        $text .= $this->generateAttrs($attributes);
        $text .= $this->getFooterText();
        if (file_put_contents($dirPath, $text) !== false) {
        } else {
            echo "Cannot create file";
        }
    }
    
    private function generateAttrs($attrs) {
        $text = "//attributes";
        foreach($attrs as $attr) {
            $text .= "public $" . $attr  . ';'
                    . ''
                    . ''; 
        }
            
        return $text;
        
    }
    
    private function getHeaderText($name) {
        return 
"<?php
namespace frontend\models;

use yii\db\ActiveRecord;
/**
 * $name model
 *
 */
class $name extends RModel
{

";
    }
    
    
    private function getFooterText() {
        return "}";
    }
    private function convertToDb($name) {
        $matcher = [];
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $name, $matches);
        $ret = $matches[0];
        foreach (   $ret as &$match) {
          $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}