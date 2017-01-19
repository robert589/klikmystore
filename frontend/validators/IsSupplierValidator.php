<?php

namespace frontend\validators;
use common\models\Supplier;
use yii\validators\Validator;

class IsSupplierValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if(!Supplier::find()->where(['id' => $model->$attribute])->exists()) {
            $this->addError($model, $attribute, 'It is not a valid supplier');
        }
    }
}