<?php
    use yii\grid\GridView;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="list-supplier view">
    <div class="view-header">
        Daftar Supplier
        
    </div>
    <div class="view-header">
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Supplier', 'newClass' => 'supplier-list-add']) ?>
    </div>

    <?=  GridView::widget(
            ['dataProvider' => $provider,
            'columns' => [
                'id',
                'name',
                'company_name',
                'email'
            ]
        ]) ?>

</div>