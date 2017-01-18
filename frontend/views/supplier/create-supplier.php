<?php

use frontend\widgets\CreateSupplierForm;

?>


<div id="<?= $id ?>" class="create-supplier view">
    <div class="view-header">
        Create Supplier
    </div>
    <?= CreateSupplierForm::widget(['id' => $id . '-form']) ?>
</div>