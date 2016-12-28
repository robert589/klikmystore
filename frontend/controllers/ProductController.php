<?php
namespace frontend\controllers;

use Yii;
use frontend\models\AddCategoryForm;
use yii\web\Controller;
/**
 * Product controller
 */
class ProductController extends Controller
{
    private $productService;
    
    public function init() {
        $this->productService = new \frontend\services\ProductService();
        $this->productService->user_id = \Yii::$app->user->getId();
        
        if(!$this->productService->checkEligibility()) {
            return $this->redirect('../site/error?name=' . "Not Authorized  ");
        }
    }
    public function actionAdd() {
        return $this->render('add-product', ['id' => 'ap']);
    }
    
    public function actionProcessAddCategory() {
        $model = new AddCategoryForm();
        $model->loadData($_POST);
        $data = array();
        if($model->add()) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
            if($model->hasErrors()) {
                $data['errors'] = $model->getErrors();
            }
        }
        
        return json_encode($data);
    }
    
    
    public function actionCategoryList() {
        $provider = $this->productService->getCategory();
        return $this->render('category-list', ['provider' => $provider, 'id' => 'pcl']);
        
    }
    
    public function actionAddCategory() {
        return $this->render('add-category', ['id' => 'pac']);
    }
}

