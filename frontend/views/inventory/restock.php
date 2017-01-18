<?php
    use frontend\widgets\RestockForm;;
?>
<div id="<?= $id ?>" class="restock view">
    <div class="view-header">
        Restock
    </div>

    <?=  RestockForm::widget(['id' => $id . '-form']) ?>

</div>