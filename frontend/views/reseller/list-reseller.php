<?php
    use common\widgets\Button;
    use yii\grid\GridView;
?>
<div id="<?= $id ?>" class="res-list view">
    <div class="view-header">
        Daftar Reseller
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Reseller', 'newClass' => 'view-header-btn']) ?>
    </div>

    <?=  GridView::widget(
            ['dataProvider' => $provider,
             'columns' => [
                'id',
                'name',
                'address',
                'email',
                'telephone'
            ]
        ]) ?>

</div>