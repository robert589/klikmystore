<?php
    use yii\grid\GridView;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="mp-list view">
    <div class="view-header">
        Daftar Marketplace
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Marketplace', 'newClass' => 'view-header-btn']) ?>
    </div>

    <?=  GridView::widget(
            ['dataProvider' => $provider,
            'columns' => [
                'code',
                'name',
            ]
        ]) ?>

</div>