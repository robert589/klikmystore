<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\services\SupplierService;
use frontend\models\CreateSupplierForm;
/**
 * Supplier controller
 */
class SupplierController extends Controller
{
    private $supplierService;
    
    public function init() {
        $this->supplierService = new SupplierService();
    }
    public function actionCreate() {
        
        return $this->render('create-supplier', ['id' => 'sc']);
    }
    
    public function actionList() {
        $provider = $this->supplierService->getSuppliers();
        return $this->render('list-supplier', ['id' => 'sl', 'provider' => $provider]);
    }
    
    public function actionProcessCreate() {
        $data = array();
        //user model
        $userModel = new \frontend\models\SignupForm;
        $userModel->loadData($_POST);
        $userModel->password = "password";
        $user = $userModel->signup();
        if(!$user) {
            $data['status'] = 0;
            $data['errors'] = $userModel->hasErrors() ? $userModel->getErrors() : null;
            return json_encode($data);
        }
        //supplier model
        $supplierModel = new CreateSupplierForm;
        $supplierModel->user_id = $user->id;
        $supplierModel->loadData($_POST);
        $supplier = $supplierModel->create();
        $data['status'] = $supplier ? 1 : 0;
        $data['errors'] = $supplierModel->hasErrors() ? $supplierModel->getErrors() : null;
        return json_encode($data);
    }
}

