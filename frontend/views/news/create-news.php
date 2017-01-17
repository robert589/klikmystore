<?php
    use frontend\widgets\CreateNewsForm;
?>

<div class="create-news view" id="<?= $id ?>">
    <div class="view-header">
        Buat Berita
    </div>
    
    <?=    CreateNewsForm::widget(['id' => $id . '-form']) ?>
    
</div>