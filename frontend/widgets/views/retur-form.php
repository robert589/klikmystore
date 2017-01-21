<?php
    use common\widgets\Form;
    use common\widgets\Button;
    use common\widgets\SearchField;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/inventory/p-retur', 
        'widget_class' => 'retur-form' , 'enable_button' => false
        ]) ?>
        
    <?= SearchField::widget(['id' => $id . '-order', 
                    'url' => \Yii::$app->request->baseUrl . '/order/search-order-id',
                    'name' => 'order_id', 'placeholder' => 'Cari Order']) ?> 
    
    <div class="retur-form-header">
        Daftar Retur
    </div>
    
    <div class="retur-form-area">

    </div>
    <?= Button::widget(['id' => $id . '-submit-btn' ,   
        'text' => 'Kirim', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>