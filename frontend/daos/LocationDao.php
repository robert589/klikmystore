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
    const SEARCH_CITY = "SELECT concat(regency.name, ', ' , province.name) as name, regency.id from regency, province
            where regency.province_id = province.id and 
                (regency.name LIKE :query 
                    or province.name LIKE :query 
                    or concat(regency.name, ', ' , province.name) LIKE :query)
            LIMIT 6";
    
    const SEARCH_DISTRICT = "select district.name, district.id from district, regency"
            . " where district.regency_id = regency.id and regency.id = :city_id and "
            . " district.name LIKE :query limit 4";
    
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

