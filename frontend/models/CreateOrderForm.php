<?php
namespace frontend\models;

use common\components\RModel;
use common\models\Order;
/**
 * CreateOrderForm model
 *
 */
class CreateOrderForm extends RModel
{

    //attributes
    public $sender_id;

    public $receiver_id;

    public $marketplace_code;

    public $courier_code;

    public $job_code;

    public $pickup;

    public $user_id;

    public $print_label;

    public $print_invoice;

    public $paper_type;

    public $status;
    
    public $offline_order;
    
    public $dropship;
    
    public function rules() {
        return [
            ["sender_id", "integer"],
            ["sender_id", "required"],
            
            ["receiver_id", "integer"],
            ["receiver_id", "required"],
            
            ["marketplace_code", "string"],
            ["marketplace_code", "required"],
            
            ["courier_code", "string"],
            ["courier_code", "required"],
            
            ["job_code", "string"],
            ["job_code", "required"],
            
            ["pickup", "string"],
            ["pickup", "required"],
            
            ["user_id", "integer"],
            ["user_id", "required"],
            
            ["print_label", "boolean"],
            ["print_label", "required"],
            
            ["print_invoice", "boolean"],
            ["print_invoice", "required"],
            
            ['paper_type', 'string'],
            ['paper_type', 'required'],
            
            ['status', 'integer'],
            ['status', 'required'],
            
            ['dropship', 'boolean'],
            ['dropship', 'required'],
            
            ['offline_order', 'boolean'],
            ['offline_order', 'required']
        ];   
    }
    
    public function create() {
        $model = new Order();
        $model->sender_id = $this->sender_id;
        $model->receiver_id = $this->receiver_id;
        $model->marketplace_code = $this->marketplace_code;
        $model->courier_code = $this->courier_code;
        $model->job_code = $this->job_code;
        $model->pickup = $this->pickup;
        $model->user_id = $this->user_id;
        $model->print_label = $this->print_label;
        $model->print_invoice = $this->print_invoice;
        $model->paper_type = $this->paper_type;
        $model->status = $this->status;
        $model->dropship = $this->dropship;
        $model->offline_order = $this->offline_order;
        return $model->save();
    }

}