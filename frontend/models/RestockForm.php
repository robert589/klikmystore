<?php
namespace frontend\models;

use common\components\RModel;
use common\validators\IsAdminValidator;
use frontend\validators\IsSupplierValidator;
use common\models\Restock;
use common\models\RestockProduct;
use common\models\Product;
use common\models\ProductInventory;
use frontend\models\RestockForm;
/**
 * RestockForm model
 *
 */
class RestockForm extends RModel
{

    //attributes
    public $user_id;

    public $supplier_id;

    public $products;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            ['supplier_id', 'integer'],
            ['supplier_id', 'required'],
            ['supplier_id', IsSupplierValidator::className()],
            ['products', 'required'],
            ['products', 'analyzeProducts']
        ];
    }
    
    public function analyzeProducts() {
        if(count($this->products) <= 0 ) {
            $this->addError("products", "We need at least 1 product");
        }
        
        foreach($this->products as $product) {
            if(!isset($product['quantity']) || $product['quantity'] <= 0) {
                $this->addError("products", "Quantity must be larger than 0");
            }
            if(!isset($product['id']) || !$this->isProduct($product['id'])) {
                $this->addError("products", "Product shall not be empty");
            }
        }
    }
    
    private function isProduct($id) {
        return Product::find()->where(['id' => $id])->exists();
    }
    
    public function restock() {
        if(!$this->validate()) {
            return false;
        }
        $restock = new Restock();
        $restock->supplier_id = $this->supplier_id;
        if(!$restock->save()) {
            return false;
        }
        foreach($this->products as $product) {
            $restockProduct = new RestockProduct();
            $restockProduct->restock_id = $restock->id;
            $restockProduct->quantity = $product['quantity'];
            $restockProduct->product_id = $product['id'];
            if(!$restockProduct->save()) {
                return false;
            }
        }
        
        return $this->restockInventory();
    }
    
    public function restockInventory() {
        foreach($this->products as $product) {
            $inventory = $this->findInventory($product['id']);
            $inventory->quantity = intval($inventory->quantity) + intval($product['quantity']);
            if(!$inventory->update()) {
                return false;
            }
        }
        
        return true;
    }
    
    private function findInventory($id) {
        $inventory = ProductInventory::find()->where(['product_id' => $id])->one();
        if(!$inventory) {
            $inventory = new ProductInventory();
            $inventory->product_id = $id;
            $inventory->quantity = 0;
            $inventory->save();
        }
        return $inventory;
    }
}