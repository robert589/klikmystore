<?php
namespace frontend\models;

use common\models\Order;
use frontend\daos\OrderDao;
use common\components\RModel;
use common\models\ProductInventory;
/**
 * ChangeStatusOrderForm model
 *
 */
class ChangeStatusOrderForm extends RModel
{

    //attributes
    public $order_id;

    public $user_id;

    public $new_status;
    
    private $orderDao;
    
    private $oldStatus;
    
    private $order;
    
    public function init() {
        $this->orderDao = new OrderDao();
    }
    
    public function rules() {
        return [
            ['order_id', 'integer'],
            ['order_id', 'required'],
            ['order_id', 'checkOrderAvailability'],
            
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['new_status', 'integer'],
            ['new_status', 'required'],
            ['new_status', 'hasChanged']
        ];
    }
    
    public function hasChanged() {
        if($this->order->status === $this->new_status) {
            $this->addError("new_status", "Status does not change");
        }
    }
    
    public function checkOrderAvailability() {
       if(!$this->order) {
            return $this->addError("order_id", "Order not found");
       }
    }
    
    public function change() {
        $this->order = Order::find()->where(['id' => $this->order_id])->one();
        $this->oldStatus = $this->order->status;
        if(!$this->validate()) {
            return false;
        }
        $this->order->status = $this->new_status;
        if(!$this->order->update()) {
            return false;
        } 
        
        return $this->processInventory();
    }
    
    public function processInventory() {
        $newStatusPool = ($this->new_status == Order::SENT_STATUS 
                    || $this->new_status == Order::PROCESSED_STATUS )  ? 2 : 1;
        
        $oldStatusPool = ($this->oldStatus == Order::SENT_STATUS 
                    || $this->oldStatus == Order::PROCESSED_STATUS )  ? 2 : 1;
        
        if($newStatusPool > $oldStatusPool) {
           return $this->restoreInventory();
        }
        
        if($oldStatusPool > $newStatusPool) {
           return $this->subsInventory();
        }
        
        return true;
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
    
    private function restoreInventory() {
        
        $vo = $this->orderDao->getOrderInfo($this->order_id);
        foreach($vo->getProducts() as $product) {
            $inventory = ProductInventory::find()->where(['product_id' => $product->getProductId()])->one();
            $inventory->quantity = intval($inventory->quantity) + intval($product->getQuantity());
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