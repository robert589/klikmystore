<?php
namespace common\components;

use yii\base\Model;

abstract class RVoBuilder extends Model{
    
    public function loadData($data, $pre = "") {
        $newData = [];
        if($pre !== "") {
            foreach($data as $index => $datum) {
                if(strpos($index, $pre) !== false) {
                    $newData[$index] = $datum;
                }
            }
            $data = $newData;
        }

        if(isset($data)) {
            $this->setAttributes($data);
        }
        return true;
    }
    
    abstract function build();
    
}               