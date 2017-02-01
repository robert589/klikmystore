<?php
namespace frontend\controllers;

use frontend\services\EmployeeService;
use Yii;
use frontend\models\AddEmployeeForm;
use yii\web\Controller;
/**
 * Employee controller
 */
class EmployeeController extends Controller
{
    
    private $service;
    
    public function init() {
        $this->service = new EmployeeService();
        $this->service->user_id = Yii::$app->user->getId();
    }
    
    public function actionAdd() {
        return $this->render('add-employee', ['id' => 'eae']);
    }

    public function actionPAdd() {
        $model = new AddEmployeeForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->add() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionList() {
        $provider = $this->service->getEmployeeList();
        if(!$provider) {
            return $this->redirect(['site/error']);
        }
        return $this->render('employee-list', ['id' => 'ele', 'provider' => $provider]);
    }
}

