<?php
namespace frontend\models;

use common\models\Product;
use common\models\OrdersProduct;
use common\components\RModel;
use common\models\ProductInventory;
use common\models\Order;
use frontend\daos\TariffDao;
/**
 * CreateOrderForm model
 *
 */
class CreateOrderForm extends RModel
{

    //attributes
    public $sender_id;

    public $receiver_id;

    public $marketplace_code;

    public $courier_code;

    public $job_code;

    public $pickup;

    public $user_id;

    public $print_label;

    public $print_invoice;

    public $paper_type;

    public $status;
    
    public $offline_order;
    
    public $dropship;
    
    public $products;
    
    public $district_id;
    
    private $tariffDao;
    public function init() {
        $this->tariffDao = new TariffDao();
    }
    public function rules() {
        return [
            ["sender_id", "integer"],
            ["sender_id", "required"],
            
            ["receiver_id", "integer"],
            ["receiver_id", "required"],
            
            ["marketplace_code", "string"],
            ["marketplace_code", "required"],
            
            ["district_id", "integer"],
            ["district_id", "required"],
            
            ["courier_code", "string"],
            ["courier_code", "required"],
            
            ["job_code", "string"],
            ["job_code", "required"],
            
            ["pickup", "string"],
            ["pickup", "required"],
            
            ['products', 'required'],
            ['products', 'checkProduct'],
            
            ["user_id", "integer"],
            ["user_id", "required"],
            
            ["print_label", "boolean"],
            ["print_label", "required"],
            
            ["print_invoice", "boolean"],
            ["print_invoice", "required"],
            
            ['paper_type', 'string'],
            ['paper_type', 'required'],
            
            ['status', 'integer'],
            ['status', 'required'],
            
            ['dropship', 'boolean'],
            ['dropship', 'required'],
            
            ['offline_order', 'boolean'],
            ['offline_order', 'required']
        ];   
    }
    
    public function checkProduct() {
        foreach($this->products as $product) {
            if(!isset($product['id']) || !$this->checkQuantity($product['id'], $product['quantity'])) {
                return $this->addError("products", "Out of stock or invalid");
            }
        }
    }
    
    public function create() {
        $model = new Order();
        $model->sender_id = $this->sender_id;
        $model->receiver_id = $this->receiver_id;
        $model->marketplace_code = $this->marketplace_code;
        $model->courier_code = $this->courier_code;
        $model->job_code = $this->job_code;
        $model->pickup = $this->pickup;
        $model->user_id = $this->user_id;
        $model->print_label = $this->print_label;
        $model->print_invoice = $this->print_invoice;
        $model->paper_type = $this->paper_type;
        $model->status = Order::PENDING_STATUS;
        $model->dropship = $this->dropship;
        $model->district_id = $this->district_id;
        $model->tariff = $this->tariffDao->getTariff($this->district_id, $this->courier_code);
        $model->offline_order = $this->offline_order;
        
        if(!$model->save()) {
            return false;
        }
        
        foreach($this->products as $product) {
            $modelProduct = new OrdersProduct();
            $productDetail = $this->getProductDetail($product['id']);
            $modelProduct->product_id = $product['id'];
            $modelProduct->quantity = $product['quantity'];
            $modelProduct->order_id = $model->id;
            $modelProduct->price = $productDetail['price_1'];
            $modelProduct->weight = $productDetail['weight'];
            if(!$modelProduct->save()) {
                return false;
            }
            
        }
        
        return true;
    }
    
    private function getProductDetail($id) {
        return Product::find()->where(['id' => $id])->one();
    }
    
    private function checkQuantity($id, $quantity) {
        $curQuantity = ProductInventory::find()->where(['product_id' => $id])->one()['quantity'];
        return !($curQuantity < $quantity);
         

    }

}