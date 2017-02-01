<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\widgets\ProductOrderFieldItem;
use frontend\models\CreateMarketplaceForm;
use frontend\services\OrderService;
use frontend\models\CreateCourierForm;
use frontend\models\CreateOrderForm;
use common\widgets\SearchFieldDropdownItem;
use frontend\models\AcceptOrderForm;
use frontend\models\RejectOrderForm;
use frontend\models\ChangeStatusOrderForm;
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
        $model = new CreateOrderForm();
        $model->user_id = Yii::$app->user->getId();
        $model->loadData($_POST);
        $status = $model->create();
        $data = array();
        $data['status'] = $status ? 1 : 0;
        if($model->hasErrors()) {
            $data['errors'] = $model->getErrors();
        }
        
        return json_encode($data);
    }
    
    public function actionList() {
        $provider = $this->orderService->getOrderList();
        
        return $this->render('order-list', ['provider' => $provider]);
    }
    
    public function actionMarketplace() {
        return $this->render('order-marketplace', ['id' => 'om']);
    }
    
    public function actionCreateMarketplace() {
        return $this->render('order-create-marketplace', ['id' => 'ocm']);
    }
    
    public function actionSearchMarketplace() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->orderService->searchMarketplace($query);
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getCode(), 'itemId' => $vo->getCode(), 'text' => ucfirst($vo->getName())]);
        }
        $data['views'] = $views;
        return json_encode($data);
    }
    
    public function actionMarketplaceList() {
        $provider = $this->orderService->getMarketplace();
        return $this->render('marketplace-list', ['id' => 'oml', 'provider' => $provider]);
    }
    
    
    public function actionCourierList() {
        $provider = $this->orderService->getCourier();
        return $this->render('courier-list', ['id' => 'ocl', 'provider' => $provider]);
    }
    
    public function actionCreateCourier() {
        return $this->render('order-create-courier', ['id' => 'occ']);
    }
    
    public function actionSearchCourier() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->orderService->searchCourier($query);
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getCode(), 'itemId' => $vo->getCode(), 'text' => ucfirst($vo->getName())]);
        }
        $data['views'] = $views;
        return json_encode($data);
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
            $data['views'] = ProductOrderFieldItem::widget(['id' => "pof-item-" . $vo->getId(), 
                        'vo' => $vo, 'quantity' => $this->orderService->quantity]);
        } else {
            $data['status']  = 0;
            $data['errors'] = $this->orderService->getErrors();
        }
        
        return json_encode($data);
    }
    
    public function actionCheckQuantity() {
        $data = [];
        $this->orderService->loadData($_POST);
        $data['status'] = ($this->orderService->checkQuantity()) ? 1 : 0;
        if($this->orderService->hasErrors()) {
            $data['errors'] = $this->orderService->getErrors();
        }   
        return json_encode($data);
    }
    
    public function actionGetTariff() {
        $data = [];
        $this->orderService->loadData($_GET);
        $tariff = $this->orderService->getTariff();
        $data['status'] = $tariff ? 1 : 0;
        $data['tariff'] = $tariff;
        if($this->orderService->hasErrors()) {
           $data['errors'] = $this->orderService->getErrors();
        }
        return json_encode($data);

    }

    
    public function actionAccept() {
        $model = new AcceptOrderForm();
    
        $model->loadData($_POST);
        $model->user_id = \Yii::$app->user->getId();
        $data = array();
        $data['status'] = $model->accept() ? 1 : 0;
        if($model->hasErrors()) {
            $data['errors'] = $model->getErrors();
        }
        return json_encode($data);
        
    }
    
    public function actionReject() {
        $model = new RejectOrderForm();
        $model->loadData($_POST);
        $model->user_id = \Yii::$app->user->getId();
        $data = array();
        $data['status'] = $model->reject() ? 1 : 0;
        if($model->hasErrors()) {
            $data['errors'] = $model->getErrors();
        }
        return json_encode($data);
    }
    
    public function actionSearchOrderId() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $data['status'] = 1;
        $views = '';
        $ids = $this->orderService->searchOrderId($query);
        if(!$ids) {
            $data['status'] = 0;
            $data['errors'] = $this->orderService->getErrors() ? $this->orderService->hasErrors() : null;
            return json_encode($data);
        }
        foreach($ids as $idItem) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $idItem, 
                'itemId' => $idItem, 'text' => $idItem]);
        }
        $data['views'] = $views;
        return json_encode($data);
    }
    
    public function actionChangeStatus() {
        $model = new ChangeStatusOrderForm();
        $model->loadData($_POST);
        $model->user_id = \Yii::$app->user->getId();
        $data = array();
        $data['status'] = $model->change() ? 1 : 0;
        if($model->hasErrors()) {
            $data['errors'] = $model->getErrors();
        }
        
        return json_encode($data);
        
    }
    
    public function actionGetOrderReturField() {
        
    }
}

