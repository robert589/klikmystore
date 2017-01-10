<?php
namespace frontend\services;

use frontend\daos\LocationDao;
use common\components\RService;
/**
 * LocationService service
 *
 */
class LocationService extends RService
{

    //attributes
    public $user_id;
    
    private $locationDao;
    
    public function init() {
        $this->locationDao = new LocationDao();
    }
    
    public function searchCity($q) {
        return $this->locationDao->searchCity($q);
    }
    
    public function searchCityByCourier($q, $courierCode) {
        return $this->locationDao->searchCityByCourier($q, $courierCode);
        
    }
    
    public function searchDistrictForTariff($q, $regencyId, $courierCode) {
        return $this->locationDao->searchDistrictForTariff($q, $regencyId, $courierCode);
    }
    
    public function searchDistrict($q, $cityId) {
        return $this->locationDao->searchDistrict($q, $cityId);
    }

}