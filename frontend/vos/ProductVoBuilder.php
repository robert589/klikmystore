<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * ProductVo builder
 *
 */
class ProductVoBuilder extends RVoBuilder
{
    function build() { return new ProductVo($this);  }
    //attributes

    public $id;

    public $name;

    public $sku;

    public $weight;

    public $link;

    public $price1;

    public $price2;

    public $price3;

    public $price4;

    public $createdAt;

    public $updatedAt;

    public $quantity;

    public $minQuantity;

    public $category;

    public $image;

    public $wholesale;

    public function rules() { 
        return [
           ['id','string'],
           ['name','string'],
           ['sku','string'],
           ['weight','string'],
           ['link','string'],
           ['price1','string'],
           ['price2','string'],
           ['price3','string'],
           ['price4','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
           ['quantity','string'],
           ['minQuantity','string'],
           ['category','string'],
           ['image','string'],
           ['wholesale','string'],
        ];
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

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setName($name) { 
        $this->name = $name; 
    }

    public function setSku($sku) { 
        $this->sku = $sku; 
    }

    public function setWeight($weight) { 
        $this->weight = $weight; 
    }

    public function setLink($link) { 
        $this->link = $link; 
    }

    public function setPrice1($price1) { 
        $this->price1 = $price1; 
    }

    public function setPrice2($price2) { 
        $this->price2 = $price2; 
    }

    public function setPrice3($price3) { 
        $this->price3 = $price3; 
    }

    public function setPrice4($price4) { 
        $this->price4 = $price4; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }

    public function setQuantity($quantity) { 
        $this->quantity = $quantity; 
    }

    public function setMinQuantity($minQuantity) { 
        $this->minQuantity = $minQuantity; 
    }

    public function setCategory($category) { 
        $this->category = $category; 
    }

    public function setImage($image) { 
        $this->image = $image; 
    }

    public function setWholesale($wholesale) { 
        $this->wholesale = $wholesale; 
    }
}