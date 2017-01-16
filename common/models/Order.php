<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class Order extends ActiveRecord
{
    
    const PENDING_STATUS = 10;
    
    const PROCESSED_STATUS = 11;
    
    const CANCELLED_STATUS = 0;
    
    const PRINT_THERMAL = "thermal";
    
    const PRINT_NORMAL = "normal";
    public static function tableName()
    {
        return '{{%orders}}';
    }
    
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function getOrderStatus() {
        return [
            self::PENDING_STATUS => "pending",
            self::PROCESSED_STATUS => "processed",
            self::CANCELLED_STATUS => "cancel"
        ];
    }
}
