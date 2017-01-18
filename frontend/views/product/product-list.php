<?php
    use yii\grid\GridView;;
?>
<div id="<?= $id ?>" class="product-list view">
    <div class="view-header">
        Daftar Produk
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