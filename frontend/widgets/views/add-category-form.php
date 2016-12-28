<?php
    use common\widgets\Form;
    use frontend\widgets\DynamicWholesaleField;
    use common\widgets\InputField;
    use common\widgets\Button;
    
    $this->title = "Tambah Kategori";
?>

<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/product/process-add-category', 
        'widget_class' => 'form' , 'enable_button' => false
        ]) ?>   
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

    <div class="form-field">
        <div class="form-field-left">
            Deskripsi
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-description-field', 
                    'type' => InputField::TEXT, 'name' => 'desc', 
                    'value' => null ]) ?>
        </div>
    </div>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
