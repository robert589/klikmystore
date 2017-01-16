<?php
namespace frontend\models;

use common\components\RModel;
use common\models\Order;
/**
 * RejectOrderForm model
 *
 */
class RejectOrderForm extends RModel
{

    //attributes
    public $order_id;

    public $user_id;
    
    private $order;
    
    public function init() {
        
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
    
    public function reject() {
        $this->order = Order::find()->where(['id' => $this->order_id])->one();
        if(!$this->validate()) {
            return false;
        }
        $this->order->status = Order::CANCELLED_STATUS ;
        if(!$this->order->update()) {
            return FALSE;
        } 
        return true;
        
        
    }
    
}