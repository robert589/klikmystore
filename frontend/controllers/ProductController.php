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
    
    public function actionAddCategory() {
        return $this->render('add-category', ['id' => 'pac']);
    }
}

