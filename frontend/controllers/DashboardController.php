<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\services\DashboardService;
/**
 * Dashboard controller
 */
class DashboardController extends Controller
{
    
    private $dashboardService;
    
    public function init() {
        $this->dashboardService = new DashboardService();
        $this->dashboardService->user_id = Yii::$app->user->getId();
    }
    public function actionIndex() {
        $vos = $this->dashboardService->getNews();
        return $this->render('dashboard-index', ['newsVos' => $vos, 'id' => 'di' ]);
    }
}

