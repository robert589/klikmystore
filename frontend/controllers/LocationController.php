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
    
    public function actionSearchDistrictForTariff() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $courierCode = filter_var($_GET['courier_code']);
        $regencyId = filter_var($_GET['city_id']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->locationService->searchDistrictForTariff($query,$regencyId, $courierCode);
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . 'city' . $vo->getId(), 
                                        'itemId' => $vo->getId(), 'text' => ucfirst($vo->getName())]);
        }
        $data['views'] = $views;
        return json_encode($data);
 
    }
    
    public function actionSearchCityByCourier() {
        $query = filter_var($_GET['q']);
        $id = filter_var($_GET['id']);
        $courierCode = filter_var($_GET['courier_code']);
        $data['status'] = 1;
        $views = '';
        $vos = $this->locationService->searchCityByCourier($query, $courierCode);
        foreach($vos as $vo) {
            $views .= SearchFieldDropdownItem::widget(['id' => $id . 'city' . $vo->getId(), 
                                        'itemId' => $vo->getId(), 'text' => ucfirst($vo->getName())]);
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

