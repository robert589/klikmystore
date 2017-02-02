<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\CreateRoleForm;
/**
 * Ac controller
 */
class AcController extends Controller
{
    private $service;
    
    public function actionIndex() {
        return $this->render('ac-index', ['id' => 'aci']);
    }
    
    public function actionRole() {
        return $this->render('ac-role', ['id' => 'acr']);
    }
    
    public function actionPermission() {
        return $this->render('ac-permission', ['id' => 'acp']);
    }
    
    public function actionAddRole() {
        $model = new CreateRoleForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->create() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionSearchRole() {
        
    }
}

