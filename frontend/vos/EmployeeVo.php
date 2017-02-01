<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * EmployeeVo vo
 *
 */
class EmployeeVo implements RVo
{
    public static function createBuilder() { return new EmployeeVoBuilder();} 
    //attributes

    private $user;

    public function __construct(EmployeeVoBuilder $builder) { 
        $this->user = $builder->getUser(); 
    }

    //getters

    public function getUser() { 
        return $this->user; 
    }
}