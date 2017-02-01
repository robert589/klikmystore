<?php
    use yii\grid\GridView;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="emp-list view">
    <div class="view-header">
        Daftar Karyawan
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Karyawan', 'newClass' => 'view-header-btn']) ?>
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