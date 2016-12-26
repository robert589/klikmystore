<?php
    use frontend\widgets\AddProductForm;
    $this->title = "Add Product";
?>

<div id="<?= $id ?>" class="add-product view">
    <div class="view-header">
        Add Product
    </div>
    <?=    AddProductForm::widget(['id' => $id . 'form']) ?>
</div>