<?php
namespace frontend\controllers;

use Yii;
use common\widgets\SearchFieldDropdownItem;
use frontend\models\AddCategoryForm;
use frontend\models\AddProductForm;
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
    
    public function actionProcessAdd() {
        $model = new AddProductForm();
        $model->loadData($_POST);
        $model->user_id = \Yii::$app->user->getId();
        $valid = $model->add();
        $data['status'] = ($valid) ? 1 : 0;
        if($model->hasErrors()) {
            $data['errors'] = $model->getErrors();
        }
        
        return json_encode($data);
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
    
    public function actionList() {
        
        $provider = $this->productService->getProducts();
        return $this->render('product-list', ['provider' => $provider, 'id' => 'pl']);
    }
    
    public function actionAddCategory() {
        return $this->render('add-category', ['id' => 'pac']);
    }
    
    public function actionSearchCategory() {
        $query = filter_var($_GET['q']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->productService->searchCategory($query);
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => 'sfcat-' . $vo->getId(), 'itemId' => $vo->getId(), 'text' => ucfirst($vo->getName())]);
        }
        $data['views'] = $views;
        return json_encode($data);
    }
    
    public function actionSearchProduct() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->productService->searchProduct($query);
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getId(), 'itemId' => $vo->getId(), 'text' => ucfirst($vo->getName())]);
        }
        $data['views'] = $views;
        return json_encode($data);
        
    }
}

