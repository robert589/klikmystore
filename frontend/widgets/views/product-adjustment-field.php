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
            <div class="pa-field-cell">
                Id
            </div>
            <div class="pa-field-cell">
                Name
            </div>
            <div class="pa-field-cell">
                Quantity
            </div>
            <div class="pa-field-cell">
                Adjustment
            </div>
            <div class="pa-field-cell">
                Stok Akhir
            </div>
        </div>
    </div>
    <div class="pa-field-footer">
        If the adjustment is zero, therefore the product will be skipped 
    </div>
    <div class="field-error app-hide">
        
    </div>
</div>
