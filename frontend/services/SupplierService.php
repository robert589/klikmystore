<?php
namespace frontend\services;

use common\components\RService;
use frontend\daos\SupplierDao;
/**
 * SupplierService service
 *
 */
class SupplierService extends RService
{

    //attributes
    public $user_id;
    
    private $supplierDao;
    
    public function init() {
        $this->supplierDao = new SupplierDao;
    }
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required']
        ];
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