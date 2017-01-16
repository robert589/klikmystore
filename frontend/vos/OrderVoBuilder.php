<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * OrderVo builder
 *
 */
class OrderVoBuilder extends RVoBuilder
{
    function build() { return new OrderVo($this);  }
    //attributes

    public $id;

    public $sender;

    public $receiver;

    public $marketplace;

    public $courier;

    public $jobCode;

    public $pickup;

    public $userId;

    public $printLabel;

    public $printInvoice;

    public $paperType;

    public $createdAt;

    public $updatedAt;

    public $status;

    public $offlineOrder;

    public $dropship;

    public $districtId;

    public $tariff;

    public $products;

    public function rules() { 
        return [
           ['id','string'],
           ['sender','string'],
           ['receiver','string'],
           ['marketplace','string'],
           ['courier','string'],
           ['jobCode','string'],
           ['pickup','string'],
           ['userId','string'],
           ['printLabel','string'],
           ['printInvoice','string'],
           ['paperType','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
           ['status','string'],
           ['offlineOrder','string'],
           ['dropship','string'],
           ['districtId','string'],
           ['tariff','string'],
           ['products','string'],
        ];
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

    //setters

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setSender($sender) { 
        $this->sender = $sender; 
    }

    public function setReceiver($receiver) { 
        $this->receiver = $receiver; 
    }

    public function setMarketplace($marketplace) { 
        $this->marketplace = $marketplace; 
    }

    public function setCourier($courier) { 
        $this->courier = $courier; 
    }

    public function setJobCode($jobCode) { 
        $this->jobCode = $jobCode; 
    }

    public function setPickup($pickup) { 
        $this->pickup = $pickup; 
    }

    public function setUserId($userId) { 
        $this->userId = $userId; 
    }

    public function setPrintLabel($printLabel) { 
        $this->printLabel = $printLabel; 
    }

    public function setPrintInvoice($printInvoice) { 
        $this->printInvoice = $printInvoice; 
    }

    public function setPaperType($paperType) { 
        $this->paperType = $paperType; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }

    public function setStatus($status) { 
        $this->status = $status; 
    }

    public function setOfflineOrder($offlineOrder) { 
        $this->offlineOrder = $offlineOrder; 
    }

    public function setDropship($dropship) { 
        $this->dropship = $dropship; 
    }

    public function setDistrictId($districtId) { 
        $this->districtId = $districtId; 
    }

    public function setTariff($tariff) { 
        $this->tariff = $tariff; 
    }

    public function setProducts($products) { 
        $this->products = $products; 
    }
}