<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * Tag model
 *
 */
class Reseller extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%reseller}}';
    }

}
