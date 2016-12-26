<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
/**
 * Product controller
 */
class ProductController extends Controller
{
    public function actionAdd() {
        return $this->render('add-product', ['id' => 'ap']);
    }
    
}

