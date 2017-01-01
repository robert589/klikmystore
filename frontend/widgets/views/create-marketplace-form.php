<?php
    use common\widgets\Form;
    use common\widgets\InputField;
    use common\widgets\Button;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/order/process-create-marketplace', 
        'widget_class' => 'form' , 'enable_button' => false
        ]) ?>   
    <div class="form-field">
        <div class="form-field-left">
            Code
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-code-field', 
                    'type' => InputField::TEXT, 'name' => 'code', 
                'value' => null ]) ?>
        </div>
    </div>

    <div class="form-field">
        <div class="form-field-left">
            Nama
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-name-field', 
                    'type' => InputField::TEXT, 'name' => 'name', 
                    'value' => null ]) ?>
        </div>
    </div>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
