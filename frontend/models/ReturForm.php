<?php
namespace frontend\models;

use common\models\ProductInventory;
use common\models\Retur;
use common\models\OrdersProduct;
use common\components\RModel;
/**
 * ReturForm model
 *
 */
class ReturForm extends RModel
{

    //attributes
    public $user_id;

    public $order_id;

    public $returs;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['order_id', 'integer'],
            ['order_id', 'required'],
            ['returs', 'analyzeReturs']
        ];
    }
    
    public function analyzeReturs() {
        if(!$this->returs || count($this->returs)  <= 0 ) {
            $this->addError("returs", "returs are required" );
        }
        foreach($this->returs as $retur) {
            if(!isset($retur['id']) || !$retur['id']) {
                $this->addError("returs", "Id is required");
            }
            if(!isset($retur['retur']) || $retur['retur'] <= 0) {
                $this->addError("returs", "retur harus lebih besar dari 0");
            }
            
            if($retur['retur'] >
                    OrdersProduct::find()
                        ->where(['order_id' => $this->order_id, 'product_id' => $retur['id']])
                        ->one()['quantity']
                    ) {
                $this->addError("returs", "retur tidak lebih besar dari kuantitas");

            }
            
            
            if(isset($retur['retur']) && ($retur['effect'] > $retur['retur'])) {
                $this->addError("returs", "barang yang efek ke inventaris harus lebih kecil dari retur");
            }
            
        }
    }
    
    public function create() {
        if(!$this->validate()) {
            return false;
        }
        
        foreach($this->returs as $item) {
            $retur = new Retur();
            $retur->order_id  = $this->order_id;
            $retur->product_id = $item['id'];
            $retur->remark = $item['remark'];
            $retur->quantity = $item['retur'];
            $retur->effect = $item['effect'];
            if(!$retur->save()) {
                return false;
            }
            $this->addToInventory($retur->product_id, $retur->effect);
        }
        
        return true;
    }
    
    public function addToInventory($productId, $effect) {
        $inventory = $this->findInventory($productId);
        $inventory->quantity = intval($inventory->quantity) + intval($effect);
        if(!$inventory->update()) {
            return false;
        }
    }

    
    private function findInventory($id) {
        $inventory = ProductInventory::find()->where(['product_id' => $id])->one();
        if(!$inventory) {
            $inventory = new ProductInventory();
            $inventory->product_id = $id;
            $inventory->quantity = 0;
            $inventory->save();
        }
        return $inventory;
    }
}