<?php
    use common\widgets\SearchField;
    use common\widgets\Button;
    use common\widgets\InputField;
?>

<div id="<?= $id ?>" class="pa-field" data-name="<?= $name ?>">
    
    <div class="pa-field-header">
        <?= SearchField::widget(['id' => $id . '-product', 'placeholder' => 'Cari Produk',
                    'url' => \Yii::$app->request->baseUrl . '/product/search-product']) ?>
        <?= Button::widget(['id' => $id . '-add', 'text' => '<span class="glyphicon glyphicon-plus"></span>']) ?>
    </div>
    <div class="pa-field-list">
        <div class="pa-field-table-header">
            <div class="pa-field-item">
                Id
            </div>
            <div class="pa-field-item">
                Name
            </div>
            <div class="po-field-item">
                Quantity
            </div>
        </div>
    </div>
    
    <div class="field-error app-hide">
        
    </div>
</div>
