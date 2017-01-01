<?php
namespace frontend\models;

use common\components\RModel;
use common\models\Marketplace;
/**
 * CreateMarketplaceForm model
 *
 */
class CreateMarketplaceForm extends RModel
{

    //attributes
    public $user_id;

    public $code;

    public $name;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['code', 'string'],
            ['code', 'required'],
            
            ['name', 'string'],
            ['name', 'required']
        ];
    }
    
    public function create() {
        if(!$this->validate()) {
            return false;
        }
        
        $model = new Marketplace();
        $model->code = $this->code;
        $model->name = $this->name;
        return $model->save();
    }
}