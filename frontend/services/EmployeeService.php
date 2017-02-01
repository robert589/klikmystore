<?php
namespace frontend\services;

use yii\data\ArrayDataProvider;
use frontend\daos\EmployeeDao;
use common\components\RService;
use common\validators\IsAdminValidator;
/**
 * EmployeeService service
 *
 */
class EmployeeService extends RService
{

    //attributes
    public $user_id;
    
    private $employeeDao;
    
    public function init() {
        $this->employeeDao = new EmployeeDao;
    }
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()]
        ];
    }
    
    public function getEmployeeList() {
        if(!$this->validate()) {
            return false;
        }
        
        $models = [];
        $model = [];
        
        $vos = $this->employeeDao->getAllEmployees();
        foreach($vos as $vo) {
            $user = $vo->getUser();
            $model['id'] = $user->getId();
            $model['name'] = $user->getName();
            $model['email'] = $user->getEmail();
            $model['telephone'] = $user->getTelephone();
            
            $model['address'] = $user->getAddress();
            $models[] = $model;
        }
        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
    }

}