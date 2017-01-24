<?php
namespace frontend\services;

use common\components\RService;
use frontend\daos\OrderDao;
use frontend\daos\ProductDao;
use frontend\daos\RestockDao;
/**
 * InventoryService service
 *
 */
class InventoryService extends RService
{
    
    const GET_ORDER_WITH_RETURN = "getorderwithretur";
    
    const GET_PRODUCT_INFO = "getproductinfo";
    
    //attributes
    public $user_id;

    public $order_id;
    
    public $product_id;
    
    private $inventoryDao;
    
    private $orderDao;
    
    private $restockDao;
    
    private $productDao;
    
    public function init() {
        $this->orderDao = new OrderDao;
        $this->productDao = new ProductDao;
        $this->restockDao = new RestockDao;
        
    }
    
    public function rules() {
        return [
            ['user_id' , 'integer'],
            ['user_id', 'required'],
            
            ['order_id', 'integer'],
            ['order_id', 'required', 'on' => self::GET_ORDER_WITH_RETURN],
                
            ['product_id', 'integer'],
            ['product_id', 'required', 'on' => self::GET_PRODUCT_INFO]
        ];
    }
    
    public function getOrderWithRetur() {
        $this->setScenario(self::GET_ORDER_WITH_RETURN);
        if(!$this->validate()) {
            return false;
        }
        
        return $this->orderDao->getOrderProductsWithRetur($this->order_id);
    }
    
    public function getProductInfo() {
        $this->setScenario(self::GET_PRODUCT_INFO);
        if(!$this->validate()) {
            return false;
        }
        
        return $this->productDao->getProductInfo($this->product_id);
    }
    
    public function getRestockList() {
        $vos = $this->restockDao->restockList();
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $vos,
            'pagination' => [
                'pageSize' => 5,
            ],
            
        ]);
        
        return $dataProvider;
    }

}