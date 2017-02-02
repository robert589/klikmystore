<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * ResellerVo vo
 *
 */
class ResellerVo implements RVo
{
    public static function createBuilder() { return new ResellerVoBuilder();} 
    //attributes

    private $user;

    public function __construct(ResellerVoBuilder $builder) { 
        $this->user = $builder->getUser(); 
    }

    //getters

    public function getUser() { 
        return $this->user; 
    }
}