<?php
    use frontend\widgets\NewsList;
?>

<div class="dashboard view" id="<?= $id ?>">
    <div class="view-header">
        Daftar Berita
    </div>
    
    <?= NewsList::widget(['id' => $id . '-list', 'vos' => $newsVos]) ?>
    
</div>