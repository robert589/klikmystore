<?php
    use frontend\widgets\CreateOrderForm;
?>

<div class="create-order" id="<?= $id ?>">
    <div class="view-header">
        Buat Order
    </div>
    
    <?= CreateOrderForm::widget(['id' => $id . '-form']) ?>
</div>