<?php
    use yii\grid\GridView;;
?>
<div id="<?= $id ?>" class="cat-list view">
    <div class="view-header">
        Daftar Kategori
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