<?php
namespace frontend\services;

use frontend\daos\ProductDao;
use common\components\RService;
use frontend\daos\OrderDao;
/**
 * OrderService service
 *
 */
class OrderService extends RService
{
    private $productDao;
    
    private $orderDao;
    
    //attributes
    public $user_id;
    
    public $product_id;
    
    public $quantity;
    
    const GET_PRODUCT_INFO_WITH_QUANTITY_CHECK = "product_info_with_quantity_check";
    
    private $productInfo;
    
    public function init() {
        $this->productDao = new ProductDao();
        $this->orderDao = new OrderDao();
    }
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['product_id', 'integer'],
            ['product_id', 'required', 'on' => self::GET_PRODUCT_INFO_WITH_QUANTITY_CHECK],
            
            ['quantity', 'integer'],
            ['quantity', 'required', 'on' => self::GET_PRODUCT_INFO_WITH_QUANTITY_CHECK],
            ['quantity', 'isAvailable']
        ];
    }
    
    public function isAvailable() {
        $curQuantity = $this->productInfo->getQuantity();
        if($curQuantity < $this->quantity) {
            $this->addError("product_id", "Product is out of stock");
        }
    }
    
    public function getProductInfoWithQuantityCheck() {
        $this->scenario = self::GET_PRODUCT_INFO_WITH_QUANTITY_CHECK;
        $this->productInfo = $this->productDao->getProductInfo($this->product_id);
        if(!$this->validate()) {
            return false;
        }
        
        return $this->productInfo;
        
    }
    
    public function searchMarketplace($query) {
        return $this->orderDao->searchMarketplace($query);
    }
    
    public function searchCourier($query) {
        return $this->orderDao->searchCourier($query);
    }

}