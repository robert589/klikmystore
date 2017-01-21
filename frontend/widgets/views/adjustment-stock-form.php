<?php
    use common\widgets\Form;
    use yii\redactor\widgets\Redactor;
    use common\widgets\Button;
    use common\widgets\InputField;
    use common\widgets\TextAreaField;
    use common\widgets\RedactorField;
    use frontend\widgets\ProductAdjustmentField;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/inventory/p-adjust', 
        'widget_class' => 'astock-form' , 'enable_button' => false
        ]) ?>
        
    <?= TextAreaField::widget(['id' => $id . '-remark',  'rows' => 3,
                    'name' => 'remark', 'placeholder' => 'Keterangan kenapa disesuaikan..']) ?> 
    
    <div class="restock-form-header">
        Daftar Produk yang disesuaikan
    </div>
    
    <?= ProductAdjustmentField::widget(['id' => $id . 'adjustment']) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' ,   
        'text' => 'Kirim', 'newClass' => 'form-submit']) ?> 
<?php Form::end() ?>