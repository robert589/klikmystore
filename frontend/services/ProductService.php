<?php
namespace frontend\services;

use common\components\RService;
use frontend\daos\CategoryDao;
use frontend\daos\ProductDao;
use common\libraries\UserLibrary;
/**
 * ProductService service
 *
 */
class ProductService extends RService
{

    //attributes
    public $user_id;
    
    private $categoryDao;
    
    private $productDao;
    
    
    public function init() {
        $this->categoryDao = new CategoryDao();
        $this->productDao = new ProductDao();
        
    }
    
    public function rules() {
        return [
            //common
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', 'isAdmin']
        ];
    }
    
    public function isAdmin() {
        $valid = UserLibrary::isAdmin($this->user_id);
        if(!$valid) {
            $this->addError($this->user_id, "You are not an admin");
        }
    }
    
    public function checkEligibility() {
        return $this->validate();
    }
    
    public function getCategory() {
        $vos = $this->categoryDao->getCategory();
        $models = [];
        $model = [];
        foreach($vos as $vo) {
            $model['id'] = $vo->getId();
            $model['name'] = $vo->getName();
            $model['desceiprion'] = $vo->getDescription();
            $models[] = $model;
        }
        
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 10,
            ],
            
        ]);
        
        return $dataProvider;

    }
    
    public  function searchProduct($query) {
        $vos = $this->productDao->searchProduct($query);
        return $vos;
    }
    public function searchCategory($query) {
        $vos = $this->categoryDao->searchCategory($query);
        
        
        return $vos;
    }
}