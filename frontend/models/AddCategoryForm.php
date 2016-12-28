<?php
namespace frontend\models;

use common\components\RModel;
use common\models\Category;
/**
 * AddCategoryForm model
 *
 */
class AddCategoryForm extends RModel
{

    //attributes
    public $name;

    public $desc;
    
    public function rules() {
        return [
            ['name' , 'string'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => '\common\models\Category', 'message' => 'The name has already been taken.'],
            
            ['desc', 'string']
            
            
        ];
    }
    
    public function add() {
        if(!$this->validate()) {
            return false;
        }
        
        $model = new Category();
        $model->name = $this->name;
        $model->description = $this->desc;
        return $model->save();
    }
}