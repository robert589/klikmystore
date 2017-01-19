<?php
namespace frontend\services;

use common\components\RService;
use common\validators\IsAdminValidator;
use frontend\daos\SupplierDao;
/**
 * SupplierService service
 *
 */
class SupplierService extends RService
{
    
    const SEARCH = "search";
    
    //attributes
    public $user_id;
    
    private $supplierDao;
    
    public function init() {
        $this->supplierDao = new SupplierDao;
    }
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className(), 'on' => self::SEARCH]
        ];  
    }
    
    public function search($query) {
        $this->setScenario(self::SEARCH);
        if(!$this->validate()) {
            return false;
        }
        
        return $this->supplierDao->searchSupplier($query);
        
    }
    
    public function getSuppliers() {
        $models = [];
        $model = [];
        $vos = $this->supplierDao->getSuppliers();
        
        foreach($vos as $vo) {
            $model['id'] = $vo->getUser()->getId();
            $model['name'] = $vo->getUser()->getName();
            $model['company_name'] = $vo->getCompanyName();
            $model['email'] = $vo->getUser()->getEmail();
            $models[] = $model;
        }
        
        return new \yii\data\ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
    }
}