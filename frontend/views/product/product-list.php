<?php
    use yii\grid\GridView;
    use common\widgets\Button;
    
?>
<div id="<?= $id ?>" class="product-list view">
    <div class="view-header">
        Daftar Produk
        
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Produk', 'newClass' => 'view-header-btn']) ?>
    </div>

    <?=  GridView::widget(
            ['dataProvider' => $provider,
            'columns' => [
                'id',
                'name',
                'quantity',
            ]
        ]) ?>

</div>