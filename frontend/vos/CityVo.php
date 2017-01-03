<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * CityVo vo
 *
 */
class CityVo implements RVo
{
    public static function createBuilder() { return new CityVoBuilder();} 
    //attributes

    private $name;

    private $id;

    public function __construct(CityVoBuilder $builder) { 
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