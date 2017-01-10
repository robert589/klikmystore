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
        return '{{%order}}';
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


}
