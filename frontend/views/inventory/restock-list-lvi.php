<?php
    use yii\grid\GridView;
?>

<div id="<?= $id ?>" class="restock-list-lvi">
    
    
    <div class="restock-list-lvi-name">
        Supplier Name: <?= $vo->getSupplier()->getName() ?>
    </div>
    
    <?=    GridView::widget([
        'dataProvider' => $products,
        'summary' => '',
        'columns' => [
            'product_id',
            'product_name',
            'quantity'
        ]
    ]) ?>
</div>