<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * MarketplaceVo vo
 *
 */
class MarketplaceVo implements RVo
{
    public static function createBuilder() { return new MarketplaceVoBuilder();} 
    //attributes

    private $code;

    private $name;

    private $createdAt;

    private $updatedAt;

    public function __construct(MarketplaceVoBuilder $builder) { 
        $this->code = $builder->getCode(); 
        $this->name = $builder->getName(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
    }

    //getters

    public function getCode() { 
        return $this->code; 
    }

    public function getName() { 
        return $this->name; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }
}