<?php
namespace frontend\controllers;

use Yii;
use frontend\models\RestockForm;
use yii\web\Controller;
/**
 * Inventory controller
 */
class InventoryController extends Controller
{
    public function actionRestock() {
        return $this->render('restock', ['id' => 'ir']);
    }
    
    public function actionPRestock() {
        $restockForm = new RestockForm();
        $restockForm->user_id = \Yii::$app->user->getId();
        $restockForm->loadData($_POST);
        $data['status'] = $restockForm->restock() ? 1 : 0;
        $data['errors'] = $restockForm->hasErrors() ? $restockForm->getErrors() : null;
        return json_encode($data);
    }
}

