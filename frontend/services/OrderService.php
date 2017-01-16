<?php
namespace frontend\services;

use yii\data\ArrayDataProvider;
use frontend\daos\ProductDao;
use common\components\RService;
use frontend\daos\OrderDao;
use frontend\daos\TariffDao;
/**
 * OrderService service
 *
 */
class OrderService extends RService
{
    private $productDao;
    
    private $orderDao;
    
    private $tariffDao;
    
    //attributes
    public $user_id;
    
    public $product_id;
    
    public $quantity;
    
    public $courier_code;
    
    public $district_id;
    
    const GET_PRODUCT_INFO_WITH_QUANTITY_CHECK = "product_info_with_quantity_check";
    
    const GET_TARIFF = "gettariff";

    private $productInfo;
    
    public function init() {
        $this->tariffDao = new TariffDao();
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
            ['quantity', 'isAvailable', 'on' => self::GET_PRODUCT_INFO_WITH_QUANTITY_CHECK],
            ['district_id', 'integer'],
            ['district_id', 'required', 'on' => self::GET_TARIFF],
            ['courier_code', 'string'],
            ['courier_code', 'required', 'on' => self::GET_TARIFF],
        ];
    }
    
    public function isAvailable() {
        $curQuantity = $this->productInfo->getQuantity();
        if($curQuantity < $this->quantity) {
            $this->addError("quantity", "Product is out of stock");
        }
    }
    
    public function getTariff() {
        $this->setScenario(self::GET_TARIFF);
        if(!$this->validate()) {
            return false;
        }
        return $this->tariffDao->getTariff($this->district_id, $this->courier_code);
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
    
    public function checkQuantity() {
        $this->scenario = self::GET_PRODUCT_INFO_WITH_QUANTITY_CHECK;
        $this->productInfo = $this->productDao->getProductInfo($this->product_id);
        return $this->validate();
    }
        
    public function getOrderList() {
        $vos =  $this->orderDao->orderList();
        $models = [];
        foreach($vos as $vo) {
            $model = [];
            $model['order_id'] = $vo->getId();
            $model['total_harga'] = $vo->getTotalPrice();
            $model['nama_pengirim'] = $vo->getSender()->getName();
            $model['nama_pembeli'] = $vo->getReceiver()->getName();
            $model['total_kuantitas'] = $vo->getTotalQuantity();
            $model['status'] = $vo->getStatusText();
            $model['status_id'] = $vo->getStatus();
            $models[] = $model;
        }
        
        $provider = new ArrayDataProvider([
            'allModels' => $models,
            'sort' => [
                'attributes' => ['total_harga', 'status', 'order_id'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        
        return $provider;
    }
}