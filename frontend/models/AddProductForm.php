<?php
namespace frontend\models;

use common\models\ProductInventory;
use common\models\ProductCategory;
use common\models\ProductWholesale;
use common\models\ProductImage;
use common\models\Product;
use common\components\RModel;
use common\libraries\UserLibrary;
/**
 * AddProductForm model
 *
 */
class AddProductForm extends RModel
{

    //attributes
    public $user_id;

    public $name;

    public $sku;

    public $weight;

    public $link;

    public $category;

    public $image_id;

    public $min_quantity;
    
    public $price_1;
    
    public $price_2;
    
    public $price_3;
    
    public $price_4;
    
    public $wholesale;
    
    public function rules() {
        return [
            ['user_id' , 'isAdmin'],
            ['user_id', 'integer'],
            ['user_id' , 'required'],
            
            ['sku', 'string'],
            ['sku', 'required'],
            
            ['name', 'string'],
            ['name', 'required'],
            
            ['link', 'string'],
            ['link', 'required'],
        
            ['weight', 'double'],
            ['weight', 'required'],
            
            ['image_id', 'integer'], 
            ['image_id', 'required'],
            
            ['min_quantity', 'integer'],
            ['min_quantity', 'required'],
            
            ['category', 'integer'],
            ['category', 'required'],
            
            ['price_1', 'double'],
            ['price_1', 'required'],
            
            ['price_2', 'double'],
            ['price_2', 'required'],
            
            ['price_3', 'double'],
            ['price_3', 'required'],
            
            ['price_4', 'double'],
            ['price_4', 'required'],
            
            ['wholesale', 'checkWholesale']
        ];
    }
    
    public function checkWholesale() {
        if(!is_array($this->wholesale)) {
            $this->addError('wholesale', 'Wrong format!!');
        } 
        
        foreach($this->wholesale as $item) {
            if(is_int($item['max']) && 
                is_int($item['min']) &&
                is_numeric($item['float'])) {
                
            } else {
                $this->addError('wholesale', 'Data are not completed!!');
            }
        }
    }
    
    public function isAdmin() {
        $valid = UserLibrary::isAdmin(\Yii::$app->user->getId());
        if(!$valid) {
            $this->addError("user_id", "Not auth");
        }
    }
    
    public function add() {
        if(!$this->validate()) {
            return false;
        }
        
        $model = new Product();
        $model->name = $this->name;
        $model->sku = $this->sku;
        $model->weight = $this->weight;
        $model->link = $this->link;
        $model->price_1 = $this->price_1;
        $model->price_2 = $this->price_2;
        $model->price_3 = $this->price_3;
        $model->price_4 = $this->price_4;
        $model->init_quantity = 0;
        $model->min_quantity = $this->min_quantity;
        if(!$model->save()) {
            return false;
        }
        
        $categoryModel = new ProductCategory();
        $categoryModel->product_id = $model->id;
        $categoryModel->category_id = $this->category;
        if(!$categoryModel->save()) {
            return false;
        }
        
        $imageProduct = new ProductImage();
        $imageProduct->image_id = $this->image_id;
        $imageProduct->product_id = $model->id;
        if(!$imageProduct->save()) {
            return false;
        }
        
        if($this->wholesale !== null && count($this->wholesale) > 0 && $this->wholesale !== "" )  {
            foreach($this->wholesale as $item) {
                $wholesaleModel = new ProductWholesale();
                $wholesaleModel->product_id = $model->id;
                $wholesaleModel->max = $item['max'];
                $wholesaleModel->min = $item['min'];
                $wholesaleModel->rate = $item['rate'];
                if(!$wholesaleModel->save()) {
                    return false;
                }
            }    
        }
        
        return true;
    }
}