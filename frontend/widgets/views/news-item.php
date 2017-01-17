<?php

?>

<div id="<?= $id ?>" class="news-item">
    <div class="news-item-news">
        <?= $vo->getNews() ?>
    </div>
    <div class="news-item-footer">
        <span class="glyphicon glyphicon-user">
            <?= $vo->getName() ?>
        </span>
        <span class="news-item-time">
            <?= $vo->getTime() ?>
        </span>
    </div>
</div>