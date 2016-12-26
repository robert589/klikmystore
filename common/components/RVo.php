<?php
namespace common\components;

use yii\base\Model;

abstract class RVo {
    
    public function loadData($data, $pre = "") {
        if (is_array($data)) {
            $attributes = array_flip($this->safeAttributes());
            
            foreach ($data as $name => $value) {
                if($pre !== "") {
                    $name = $pre . "_" . $name;
                }
                if (isset($attributes[$name])) {
                    $this->$name = "$value";
                } 
            }
        }
    }
}               