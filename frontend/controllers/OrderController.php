<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\widgets\ProductOrderFieldItem;
use frontend\models\CreateMarketplaceForm;
use frontend\services\OrderService;
use frontend\models\CreateCourierForm;
/**
 * Order controller
 */
class OrderController extends Controller
{
    private $orderService;
    
    public function init() {
        $this->orderService = new OrderService();
        $this->orderService->user_id = \Yii::$app->user->getId();
    }
    
    public function actionCreate() {
        return $this->render('create-order', ['id' => 'oc']);
    }
    
    public function actionProcessCreate() {
        
    }
    
    public function actionList() {
        
    }
    
    public function actionMarketplace() {
        return $this->render('order-marketplace', ['id' => 'om']);
    }
    
    public function actionCreateMarketplace() {
        return $this->render('order-create-marketplace', ['id' => 'ocm']);
    }
    
    public function actionCreateCourier() {
        return $this->render('order-create-courier', ['id' => 'occ']);
    }
    
    
    public function actionProcessCreateMarketplace() {
        $model = new CreateMarketplaceForm;
        $model->loadData($_POST);
        $model->user_id = \Yii::$app->user->getId();
        $data = array();
        $data['status'] = $model->create() ? 1 : 0;
        if($model->hasErrors()) {
            $data['errors'] = $model->getErrors();
        }
        
        return json_encode($data);
    }
    
    public function actionProcessCreateCourier() {
        $model = new CreateCourierForm;
        $model->loadData($_POST);
        $model->user_id = \Yii::$app->user->getId();
        $data = array();
        $data['status'] = $model->create() ? 1 : 0;
        if($model->hasErrors()) {
            $data['errors'] = $model->getErrors();
        }
        
        return json_encode($data);
    }
    
    public function actionAddProductToOrder() {
        $data = [];
        $this->orderService->loadData($_POST);
        $vo = $this->orderService->getProductInfoWithQuantityCheck();
        if($vo) {
            $data['status'] = 1;
            $data['views'] = ProductOrderFieldItem::widget(['id' => "pof-item-" . $vo->getId(), 'vo' => $vo]);
        } else {
            $data['status']  = 0;
            $data['errors'] = $this->orderService->getErrors();
        }
        
        return json_encode($data);
    }
}

