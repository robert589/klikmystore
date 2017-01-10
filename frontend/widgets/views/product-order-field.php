<?php
    use common\widgets\SearchField;
    use common\widgets\Button;
    use common\widgets\InputField;
?>

<div id="<?= $id ?>" class="po-field" data-name="<?= $name ?>">
    
    <div class="po-field-header">
        <?= SearchField::widget(['id' => $id . '-product', 'placeholder' => 'Cari Produk',
                    'url' => \Yii::$app->request->baseUrl . '/product/search-product']) ?>
        <?= InputField::widget(['id' => $id . '-quantity', 'placeholder' => '0', 'value' => 0, 'type' => InputField::NUMBER]) ?>
        <?= Button::widget(['id' => $id . '-add', 'text' => '<span class="glyphicon glyphicon-plus"></span>']) ?>
    </div>
    <div class="po-field-list">
        <div class="po-field-table-header">
            <div class="po-field-table-id">
                Id
            </div>
            <div class="po-field-table-name">
                Name
            </div>
            <div class="po-field-table-qty">
                Quantity
            </div>
        </div>
    </div>
    
    <div class="field-error app-hide">
        
    </div>
</div>
