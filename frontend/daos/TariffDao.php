<?php
namespace frontend\daos;

use Yii;
use common\components\Dao;
/**
 * TariffDao class
 */
class TariffDao implements Dao
{
    const GET_TARIFF = "select tariff.regular_tariff "
            . " from tariff"
            . " where tariff.destination_id = :district_id and tariff.courier_code = :courier_code";

    
    public function getTariff($districtId, $courierCode) {
        $result =  \Yii::$app->db
            ->createCommand(self::GET_TARIFF)
            ->bindParam(':district_id', $districtId)
            ->bindParam(':courier_code', $courierCode)
            ->queryOne();
        
        if(!$result) {
            return null;
        }
        return $result['regular_tariff'];

    }
}

