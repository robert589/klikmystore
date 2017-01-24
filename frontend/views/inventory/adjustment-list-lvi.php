<?php
    use yii\grid\GridView;
?>

<div id="<?= $id ?>" class="adj-list-lvi">
    
    <div class="adj-list-lvi-id">
        Id: <?= $vo->getId() ?>
    </div>
    <div class="adj-list-lvi-remark">
        Remark: <?= $vo->getRemark() ?>
    </div>
    
    <?=    GridView::widget([
        'dataProvider' => $adjustments,
        'summary' => '',
        'columns' => [
            'product_id',
            'product_name',
            'adjustment'
        ]
    ]) ?>
</div>