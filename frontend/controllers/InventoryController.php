<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
/**
 * Inventory controller
 */
class InventoryController extends Controller
{
    public function actionRestock() {
        return $this->render('restock', ['id' => 'ir']);
    }
}

