<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * DistrictVo vo
 *
 */
class DistrictVo implements RVo
{
    public static function createBuilder() { return new DistrictVoBuilder();} 
    //attributes

    private $name;

    private $id;

    public function __construct(DistrictVoBuilder $builder) { 
        $this->name = $builder->getName(); 
        $this->id = $builder->getId(); 
    }

    //getters

    public function getName() { 
        return $this->name; 
    }

    public function getId() { 
        return $this->id; 
    }
}