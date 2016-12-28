<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * CategoryVo vo
 *
 */
class CategoryVo implements RVo
{
    public static function createBuilder() { return new CategoryVoBuilder();} 
    //attributes

    private $id;

    private $name;

    private $description;

    public function __construct(CategoryVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->name = $builder->getName(); 
        $this->description = $builder->getDescription(); 
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getName() { 
        return $this->name; 
    }

    public function getDescription() { 
        return $this->description; 
    }
}