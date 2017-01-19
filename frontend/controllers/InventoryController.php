<?php
namespace frontend\controllers;

use Yii;
use frontend\models\RestockForm;
use yii\web\Controller;
use frontend\widgets\OrderReturField;
use frontend\services\InventoryService;
/**
 * Inventory controller
 */
class InventoryController extends Controller
{
    
    private $inventoryService;
    
    public function init() {
        $this->inventoryService = new InventoryService();
        $this->inventoryService->user_id = Yii::$app->user->getId();
    }
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
    
    public function actionRetur() {
        return $this->render('retur', ['id' => 'ire']);
    }
    
    public function actionPRetur() {
        
    }
    
    public function actionGetOrderReturField() {
        $data = [];
        $this->inventoryService->loadData($_POST);
        $vos = $this->inventoryService->getOrderWithRetur();
        if(!$vos) {
            $data['status'] = 0;
            $data['errors'] = $this->inventoryService->hasErrors() ? $this->inventoryService->getErrors() : null;
            return json_encode($data);
        }
        
        $data['status'] = 1;
        $data['views'] = OrderReturField::widget(['id' => 'orf', 'vos' => $vos, 'name' => 'returs']);
        return json_encode($data);
    }
    public function actionAdjust() {
        
    }
}

