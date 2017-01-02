<?php
    use frontend\widgets\CreateOrderForm;
    use frontend\widgets\AddUserFormModal;
?>

<div class="create-order view" id="<?= $id ?>">
    <div class="view-header">
        Buat Order
    </div>
    
    <?= AddUserFormModal::widget(['id' => $id .'-usermodal']) ?>
    <?= CreateOrderForm::widget(['id' => $id . '-form']) ?>
</div>