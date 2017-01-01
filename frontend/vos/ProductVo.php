<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * ProductVo vo
 *
 */
class ProductVo implements RVo
{
    public static function createBuilder() { return new ProductVoBuilder();} 
    //attributes

    private $id;

    private $name;

    private $sku;

    private $weight;

    private $link;

    private $price1;

    private $price2;

    private $price3;

    private $price4;

    private $createdAt;

    private $updatedAt;

    private $quantity;

    private $minQuantity;

    private $category;

    private $image;

    private $wholesale;

    public function __construct(ProductVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->name = $builder->getName(); 
        $this->sku = $builder->getSku(); 
        $this->weight = $builder->getWeight(); 
        $this->link = $builder->getLink(); 
        $this->price1 = $builder->getPrice1(); 
        $this->price2 = $builder->getPrice2(); 
        $this->price3 = $builder->getPrice3(); 
        $this->price4 = $builder->getPrice4(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
        $this->quantity = $builder->getQuantity(); 
        $this->minQuantity = $builder->getMinQuantity(); 
        $this->category = $builder->getCategory(); 
        $this->image = $builder->getImage(); 
        $this->wholesale = $builder->getWholesale(); 
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getName() { 
        return $this->name; 
    }

    public function getSku() { 
        return $this->sku; 
    }

    public function getWeight() { 
        return $this->weight; 
    }

    public function getLink() { 
        return $this->link; 
    }

    public function getPrice1() { 
        return $this->price1; 
    }

    public function getPrice2() { 
        return $this->price2; 
    }

    public function getPrice3() { 
        return $this->price3; 
    }

    public function getPrice4() { 
        return $this->price4; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    public function getQuantity() { 
        return $this->quantity; 
    }

    public function getMinQuantity() { 
        return $this->minQuantity; 
    }

    public function getCategory() { 
        return $this->category; 
    }

    public function getImage() { 
        return $this->image; 
    }

    public function getWholesale() { 
        return $this->wholesale; 
    }
}