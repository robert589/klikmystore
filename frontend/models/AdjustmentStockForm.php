<?php
namespace frontend\models;

use common\models\ProductInventory;
use common\models\Adjustment;
use common\models\AdjustmentItem;
use common\components\RModel;
use common\validators\IsAdminValidator;
/**
 * AdjustmentStockForm model
 *
 */
class AdjustmentStockForm extends RModel
{

    //attributes
    public $user_id;

    public $adjustments;

    public $remark;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['user_id', IsAdminValidator::className()],
            
            ['adjustments', 'analyzeIt'],
            
            ['remark', 'string'],
            ['remark', 'required']
            
        ];
    }
    
    public function analyzeIt() {
        foreach($this->adjustments as $adjustment) {
            //TODO
        }
    }
    
    public function create() {
        $adjustment = new Adjustment();
        $adjustment->user_id = $this->user_id;
        $adjustment->remark = $this->remark;
        if(!$adjustment->save()) {
            return false;
        }
        
        foreach($this->adjustments as $adjustmentItem) {
            $adjustmentItemModel = new AdjustmentItem();
            $adjustmentItemModel->adjustment_id = $adjustment->id;
            $adjustmentItemModel->product_id = $adjustmentItem['id'];
            $adjustmentItemModel->adjust = $adjustmentItem['adjust'];
            if(!$adjustmentItemModel->save()) {
                return false;
            }
            $this->adjustInventory($adjustmentItem['id'], $adjustmentItem['adjust']);
        }
        
        return true;
    }
    
    private function adjustInventory($productId, $adjust) {
        $inventory = $this->findInventory($productId);
        $inventory->quantity = intval($inventory->quantity) + intval($adjust);
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