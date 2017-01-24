<?php
    use yii\grid\GridView;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="courier-list view">
    <div class="view-header">
        Daftar Courier
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Courier', 'newClass' => 'view-header-btn']) ?>
    </div>

    <?=  GridView::widget(
            ['dataProvider' => $provider,
            'columns' => [
                'code',
                'name',
            ]
        ]) ?>

</div>