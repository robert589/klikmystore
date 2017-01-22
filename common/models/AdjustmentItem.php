<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class AdjustmentItem extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%adjustment_item}}';
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
