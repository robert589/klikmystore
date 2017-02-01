<?php
namespace frontend\models;

use common\models\ProductInventory;
use common\components\RModel;
use common\models\Order;
use frontend\daos\OrderDao;
/**
 * AcceptOrderForm model
 *
 */
class AcceptOrderForm extends RModel
{

    //attributes
    public $order_id;

    public $user_id;
    
    private $order;
    
    private $orderDao;
    
    public function init() {
        $this->orderDao = new OrderDao();
    }
    
    public function rules() {
        return [
            ['order_id', 'integer'],
            ['order_id', 'required'],
            ['order_id', 'checkOrderAvailability'],
            
            ['user_id', 'integer'],
            ['user_id', 'required']
        ];
    }
    
    public function checkOrderAvailability() {
       if(!$this->order) {
            return $this->addError("order_id", "Order not found");
       }
    }
    
    public function accept() {
        $this->order = Order::find()->where(['id' => $this->order_id])->one();
        if(!$this->validate()) {
            return false;
        }
        $this->order->status = Order::PROCESSED_STATUS;
        if(!$this->order->update()) {
            return false;
        } 
        
        return $this->subsInventory();
        
        
    }
    
    private function subsInventory() {
        $vo = $this->orderDao->getOrderInfo($this->order_id);
        foreach($vo->getProducts() as $product) {
            $inventory = ProductInventory::find()->where(['product_id' => $product->getProductId()])->one();
            $inventory->quantity = intval($inventory->quantity) - intval($product->getQuantity());
            if($inventory->quantity < 0 ) {
                return false;
            }
            if(!$inventory->update()) {
                return false;
            }
        }
        
        return true;
        
    }
    
    

}