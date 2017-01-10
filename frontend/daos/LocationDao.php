<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
use frontend\vos\CityVoBuilder;
use frontend\vos\DistrictVoBuilder;
/**
 * LocationDao class
 */
class LocationDao implements Dao
{   
    const SEARCH_CITY = "SELECT regency.name, regency.id 
            from regency
            where regency.name LIKE :query
            LIMIT 6";
            
    const SEARCH_CITY_BY_COURIER = "SELECT DISTINCT regency.name, regency.id 
            from regency, tariff,district
            where regency.name LIKE :query and district.regency_id = regency.id
            	and tariff.destination_id = district.id and tariff.courier_code = :courier_code
            LIMIT 6";
    
    const SEARCH_DISTRICT_FOR_TARIFF = "SELECT DISTINCT district.name, district.id 
            from tariff,district
            where district.regency_id = :regency_id
            	and tariff.destination_id = district.id and tariff.courier_code = :courier_code
                and district.name LIKE :query
            LIMIT 6";
    
    const SEARCH_DISTRICT = "select district.name, district.id from district, regency"
            . " where district.regency_id = regency.id and regency.id = :city_id and "
            . " district.name LIKE :query limit 4";
    
    public function searchDistrictForTariff($q, $regencyId, $courierCode) {
        $query = "%$q%";
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_DISTRICT_FOR_TARIFF)
            ->bindParam(':query', $query)
            ->bindParam(':courier_code', $courierCode)
            ->bindParam(':regency_id', $regencyId)
            ->queryAll();
        
        
        //\Yii::$app->end(var_dump($results));
        $vos = [];
        foreach($results as $result) {
            $builder = new DistrictVoBuilder();
            
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }
    
    public function searchCityByCourier($q, $courierCode) {
        $query = "%$q%";
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_CITY_BY_COURIER)
            ->bindParam(':query', $query)
            ->bindParam(':courier_code', $courierCode)
            ->queryAll();
        
        $vos = [];
        foreach($results as $result) {
            $builder = new CityVoBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }
    
    public function searchCity($q) {
        $query = "%$q%";
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_CITY)
            ->bindParam(':query', $query)
            ->queryAll();
        
        //\Yii::$app->end(var_dump($results));
        $vos = [];
        foreach($results as $result) {
            $builder = new CityVoBuilder();
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }
    
    public function searchDistrict($q, $cityId) {
        $query = "%$q%";
        $results =  \Yii::$app->db
            ->createCommand(self::SEARCH_DISTRICT)
            ->bindParam(':query', $query)
            ->bindParam(':city_id', $cityId)
            ->queryAll();
        
        //\Yii::$app->end(var_dump($results));
        $vos = [];
        foreach($results as $result) {
            $builder = new DistrictVoBuilder();
            
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        return $vos;
    }
}

