<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\CreateMarketplaceForm;
use frontend\models\CreateCourierForm;
/**
 * Order controller
 */
class OrderController extends Controller
{
    private $orderService;
    
    public function actionCreate() {
        
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
}

