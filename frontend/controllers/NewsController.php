<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\CreateNewsForm;
/**
 * News controller
 */
class NewsController extends Controller
{
    
    public function actionCreate() {
        return $this->render('create-news', ['id' => 'nc']);
    }
    
    public function actionProcessCreate() {
        $model = new CreateNewsForm();
        $model->loadData($_POST);
        $model->user_id = \Yii::$app->user->getId();
        $data = array();
        $data['status'] = $model->create() ? 1 : 0;
        $data['errors'] = $model->hasErrors() ? $model->getErrors() : null;
        return json_encode($data);
    }
}

