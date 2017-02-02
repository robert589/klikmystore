<?php
namespace frontend\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use frontend\models\AddResellerForm;
use yii\web\Controller;
use frontend\services\ResellerService;
/**
 * Reseller controller
 */
class ResellerController extends Controller
{
    private $service;
    
    public function init() {
        $this->service = new ResellerService();
        $this->service->user_id = Yii::$app->user->getId();
    }
    
    public function actionAdd() {
        return $this->render('add-reseller', ['id' => 'rar']);
    }

    public function actionPAdd() {
        $model = new AddResellerForm();
        $model->user_id = \Yii::$app->user->getId();
        $model->loadData($_POST);
        $data['status'] = $model->add() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
    
    public function actionList() {
        $provider = $this->service->getResellerList();
        if(!$provider) {
            return $this->redirect(['site/error']);
        }
        return $this->render('list-reseller', ['id' => 'rlr', 'provider' => $provider]);
    }

}

