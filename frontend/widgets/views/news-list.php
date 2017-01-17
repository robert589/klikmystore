<?php
    use frontend\widgets\NewsItem;
?>

<div id="<?= $id ?>" class="news-list">
    <?php foreach($vos as $vo) { ?>
        <?= NewsItem::widget(['id' => $id . '-' . $vo->getId(), 'vo' => $vo]) ?>
    <?php } ?>
</div>