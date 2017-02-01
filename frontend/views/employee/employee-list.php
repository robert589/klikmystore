<?php
    use common\widgets\Button;
    use yii\grid\GridView;
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
                'address',
                'email',
                'telephone'
            ]
        ]) ?>

</div>