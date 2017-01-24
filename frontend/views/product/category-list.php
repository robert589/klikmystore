<?php
    use yii\grid\GridView;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="cat-list view">
    <div class="view-header">
        Daftar Kategori
        
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Kategori', 'newClass' => 'view-header-btn']) ?>

        
    </div>

    <?=  GridView::widget(
            ['dataProvider' => $provider,
            'columns' => [
                'id',
                'name',
                'description',
            ]
        ]) ?>

</div>