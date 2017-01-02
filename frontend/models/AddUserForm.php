<?php
namespace frontend\models;

use common\libraries\UserLibrary;
use common\models\User;
use common\components\RModel;
/**
 * AddUserForm model
 *
 */
class AddUserForm extends RModel
{
    
    public $user_id;
    //attributes
    public $first_name;

    public $last_name;

    public $telephone;

    public $address;
    
    
    public function rules() {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'isAdmin'],
            
            ['first_name', 'required'],
            ['first_name', 'string'],
            
            ['last_name', 'string'],
            ['telephone', 'string'],
            ['address', 'string']
        ];
    }
    
    public function isAdmin() {
        $valid = UserLibrary::isAdmin($this->user_id);
        if(!$valid) {
            return $this->addError("user_id", "You are not authorized");
        }
    }
    public function add() {
        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->telephone = $this->telephone;
        $user->address = $this->address;
        $user->username = $this->generateUsername();    
        $user->generateAuthKey();
        return $user->save();
    }

    public function generateUsername(){
        return UserLibrary::generateUsername($this->first_name, $this->last_name);

    }

    
}