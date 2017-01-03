<?php
namespace frontend\controllers;

use frontend\models\AddUserForm;
use Yii;
use common\widgets\SearchFieldDropdownItem;
use frontend\services\UserService;
use yii\web\Controller;
/**
 * User controller
 */
class UserController extends Controller
{
    
    private $userService;
    
    public function init() {
        $this->userService = new UserService();
        $this->userService->user_id = \Yii::$app->user->getId();
    }
    
    public function actionPAddUser() {
        $model = new AddUserForm();
        $model->loadData($_POST);
        $model->user_id = \Yii::$app->user->getId();
        $data['status'] = $model->add() ? 1 : 0 ;
        if(!$model->hasErrors()) {
            $data['errors'] = $model->getErrors();
        }
        
        return json_encode($data);
    }
    
    public function actionSearchUser() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $data['status'] = 1;
        $data['views'] = "";
        $vos = $this->userService->searchUser($query);
        foreach($vos as $vo) {
            $data['views'] .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getId(), 
                                                'itemId' => $vo->getId(), 'text' => $vo->getName() ]);
        }
        
        return json_encode($data);
    }
}

