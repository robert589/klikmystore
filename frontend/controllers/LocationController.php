<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\widgets\SearchFieldDropdownItem;
use frontend\services\LocationService;
/**
 * Location controller
 */
class LocationController extends Controller
{
    private $locationService;
    
    public function init() {
        $this->locationService = new LocationService();
    }
    
    
    public function actionSearchCity() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->locationService->searchCity($query);
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getId(), 'itemId' => $vo->getId(), 'text' => ucfirst($vo->getName())]);
        }
        $data['views'] = $views;
        return json_encode($data);
        
    }
    
    
    
    public function actionSearchDistrict() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $cityId = filter_var($_GET['city_id']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->locationService->searchDistrict($query, $cityId);
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . '-' . $vo->getId(), 'itemId' => $vo->getId(), 'text' => ucfirst($vo->getName())]);
        }
        $data['views'] = $views;
        return json_encode($data);
        
    }
}

