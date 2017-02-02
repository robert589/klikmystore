<?php
namespace frontend\services;

use frontend\daos\ResellerDao;
use yii\data\ArrayDataProvider;
use common\validators\IsAdminValidator;
use common\components\RService;
/**
 * ResellerService service
 *
 */
class ResellerService extends RService
{

    
    //attributes
    public $user_id;
    
    private $resellerDao;
    
    public function init() {
        $this->resellerDao = new ResellerDao;
    }
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()]
        ];
    }
    
    public function getResellerList() {
        if(!$this->validate()) {
            return false;
        }
        
        $models = [];
        $model = [];
        
        $vos = $this->resellerDao->getAllResellers();
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