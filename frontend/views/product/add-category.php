<?php

use frontend\widgets\AddCategoryForm;

?>


<div id="<?= $id ?>" class="add-category view">
    <div class="view-header">
        Add Category
    </div>
    <?= AddCategoryForm::widget(['id' => $id . 'form']) ?>
</div>