<?php
    use common\widgets\Form;
    use yii\redactor\widgets\Redactor;
    use common\widgets\Button;
    use common\widgets\InputField;
    use common\widgets\SearchField;
    use common\widgets\RedactorField;
    use frontend\widgets\ProductOrderField;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/inventory/p-restock', 
        'widget_class' => 'restock-form' , 'enable_button' => false
        ]) ?>
        
    <?= SearchField::widget(['id' => $id . '-supplier', 
                    'url' => \Yii::$app->request->baseUrl . '/supplier/search',
                    'name' => 'supplier_id', 'placeholder' => 'Cari Supplier']) ?> 
    
    <div class="restock-form-header">
        Daftar Produk yang dibeli
    </div>
    
    <?= ProductOrderField::widget(['id' => $id . '-po-field', 'name' => 'products', 'checkRange' => false]) ?>


    <?= Button::widget(['id' => $id . '-submit-btn' ,   
        'text' => 'Kirim', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>