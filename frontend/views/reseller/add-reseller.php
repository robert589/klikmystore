<?php
    use frontend\widgets\AddResellerForm;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="add-res view">
    <div class="view-header">
        Add Reseller
    </div>
    <?=  AddResellerForm::widget(['id' => $id . '-form']) ?>
</div>