<?php
namespace frontend\models;

use common\components\RModel;
use common\validators\IsAdminValidator;
/**
 * CreateRoleForm model
 *
 */
class CreateRoleForm extends RModel
{

    //attributes
    public $title;

    public $description;

    public $user_id;
    
    public function rules() {
        return [
            ['title', 'string'],
            ['title', 'required'],
            
            ['description', 'string'],
            
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', IsAdminValidator::className()]
        ];
    }
    
    public function create() {
        if(!$this->validate()) {
            return false;
        }
        
        $auth = \Yii::$app->authManager;
        $role = $auth->createRole($this->title);
        $role->description = $this->description;
        return $auth->add($role);  
    }

}