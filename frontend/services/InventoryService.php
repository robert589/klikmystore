<?php
namespace frontend\services;

use common\components\RService;
use frontend\daos\OrderDao;
/**
 * InventoryService service
 *
 */
class InventoryService extends RService
{
    
    const GET_ORDER_WITH_RETURN = "getorderwithretur";
    //attributes
    public $user_id;

    public $order_id;
    
    private $inventoryDao;
    
    private $orderDao;
    
    public function init() {
        $this->orderDao = new OrderDao;
    }
    
    public function rules() {
        return [
            ['user_id' , 'integer'],
            ['user_id', 'required'],
            
            ['order_id', 'integer'],
            ['order_id', 'required', 'on' => self::GET_ORDER_WITH_RETURN]
        ];
    }
    
    public function getOrderWithRetur() {
        $this->setScenario(self::GET_ORDER_WITH_RETURN);
        if(!$this->validate()) {
            return false;
        }
        
        return $this->orderDao->getOrderProductsWithRetur($this->order_id);
    }

}