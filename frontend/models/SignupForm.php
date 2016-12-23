<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\UserEmailAuthentication;
use common\libraries\UserLibrary;
/**
 * Signup form
 */
class SignupForm extends Model
{
    
    public $first_name;
    
    public $last_name;
    
    public $email;
    
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['first_name', 'string'],
            ['first_name', 'trim'],
            ['first_name', 'required'],
            
            ['last_name', 'string'],
            ['last_name', 'trim'],
            

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\UserEmailAuthentication', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() 
    {
        if (!$this->validate()) {
            return false;
        }
        
        $user = new User();
        $user->username = $this->generateUsername();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->generateAuthKey();

        if(!$user->save()) {
            return false;
        }
        
        $userEmailAuth = new UserEmailAuthentication();
        $userEmailAuth->setPassword($this->password);
        $userEmailAuth->user_id = $user->id;
        $userEmailAuth->email = $this->email;
        $userEmailAuth->generatePasswordResetToken();
        if(!$userEmailAuth->save()) {
            return false;
        }
        return $user;
    }
    
    
    public function generateUsername(){
        return UserLibrary::generateUsername($this->first_name, $this->last_name);

    }
}
