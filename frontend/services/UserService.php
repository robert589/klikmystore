<?php
namespace frontend\services;

use frontend\daos\UserDao;
use common\components\RService;
/**
 * UserService service
 *
 */
class UserService extends RService
{

    //attributes
    public $user_id;
    
    private $userDao;
    
    public function init() {
        $this->userDao = new UserDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
        ];
    }
    
    public function searchUser($query) {
        return $this->userDao->searchUser($query);
    }
}