<?php
    use yii\grid\GridView;
    use common\widgets\Button;
    use yii\widgets\ListView;
    
?>
<div id="<?= $id ?>" class="product-list view">
    <div class="view-header">
        Daftar Produk
        
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Produk', 'newClass' => 'view-header-btn']) ?>
    </div>
    
    
    <?= ListView::widget([
            'dataProvider' => $provider,
            'itemOptions' => ['class' => 'list-item'],
            'layout' => "{pager}\n{items}\n{summary}",
            'itemView' => function ($vo, $key, $index, $widget) {
              
                return $this->render('product-list-lvi',
                        ['vo' => $vo, 'id' => 'plvi-' . $vo->getId()]);
            },
            'viewParams'=>['id'=> $id],
        ]); ?>
</div>