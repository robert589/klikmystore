<?php
namespace frontend\models;

use common\components\RModel;
use common\models\Supplier;
/**
 * CreateSupplierForm model
 *
 */
class CreateSupplierForm extends RModel
{

    //attributes
    public $user_id;
    public $company_name;
    
    public function rules() {
        return [
            ['company_name', 'string'],
            ['user_id', 'integer'],
            
            ['user_id', 'required'],
            ['company_name', 'required']

        ];      
    }
    
    public function create() {
        if(!$this->validate()) {
            return false;
        }
        
        $supplier = new Supplier();
        $supplier->id = $this->user_id;
        $supplier->company_name = $this->company_name;
        
        return $supplier->save() ? $supplier : null;
    }

}