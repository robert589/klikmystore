<?php
    use frontend\widgets\AdjustmentStockForm;
?>
<div id="<?= $id ?>" class="adj-stock view">
    <div class="view-header">
        Adjustment Stock
    </div>

    <?= AdjustmentStockForm::widget(['id' => $id . '-form']) ?>

</div>  