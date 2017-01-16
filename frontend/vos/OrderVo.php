<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * OrderVo vo
 *
 */
class OrderVo implements RVo
{
    public static function createBuilder() { return new OrderVoBuilder();} 
    //attributes

    private $id;

    private $sender;

    private $receiver;

    private $marketplace;

    private $courier;

    private $jobCode;

    private $pickup;

    private $userId;

    private $printLabel;

    private $printInvoice;

    private $paperType;

    private $createdAt;

    private $updatedAt;

    private $status;

    private $offlineOrder;

    private $dropship;

    private $districtId;

    private $tariff;

    private $products;

    public function __construct(OrderVoBuilder $builder) { 
        $this->id = $builder->getId(); 
        $this->sender = $builder->getSender(); 
        $this->receiver = $builder->getReceiver(); 
        $this->marketplace = $builder->getMarketplace(); 
        $this->courier = $builder->getCourier(); 
        $this->jobCode = $builder->getJobCode(); 
        $this->pickup = $builder->getPickup(); 
        $this->userId = $builder->getUserId(); 
        $this->printLabel = $builder->getPrintLabel(); 
        $this->printInvoice = $builder->getPrintInvoice(); 
        $this->paperType = $builder->getPaperType(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
        $this->status = $builder->getStatus(); 
        $this->offlineOrder = $builder->getOfflineOrder(); 
        $this->dropship = $builder->getDropship(); 
        $this->districtId = $builder->getDistrictId(); 
        $this->tariff = $builder->getTariff(); 
        $this->products = $builder->getProducts(); 
    }

    //getters

    public function getId() { 
        return $this->id; 
    }

    public function getSender() { 
        return $this->sender; 
    }

    public function getReceiver() { 
        return $this->receiver; 
    }

    public function getMarketplace() { 
        return $this->marketplace; 
    }

    public function getCourier() { 
        return $this->courier; 
    }

    public function getJobCode() { 
        return $this->jobCode; 
    }

    public function getPickup() { 
        return $this->pickup; 
    }

    public function getUserId() { 
        return $this->userId; 
    }

    public function getPrintLabel() { 
        return $this->printLabel; 
    }

    public function getPrintInvoice() { 
        return $this->printInvoice; 
    }

    public function getPaperType() { 
        return $this->paperType; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    public function getStatus() { 
        return $this->status; 
    }

    public function getOfflineOrder() { 
        return $this->offlineOrder; 
    }

    public function getDropship() { 
        return $this->dropship; 
    }

    public function getDistrictId() { 
        return $this->districtId; 
    }

    public function getTariff() { 
        return $this->tariff; 
    }

    public function getProducts() { 
        return $this->products; 
    }
    
    public function getTotalPrice() {
        $price = 0;
        foreach($this->products as $product) {
            $price += floatval($product->getPrice());
        }
        
        return $price + $this->getTariff();
    }
    
    public function getTotalQuantity() {
        $quantity = 0;
        
        foreach($this->products as $product) {
            $quantity += intval($product->getQuantity());
        }
        
        return $quantity;
    }
    
    public function getStatusText() {
        return \common\models\Order::getOrderStatus()[intval($this->status)];
    }
}