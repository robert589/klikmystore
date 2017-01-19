<?php
    use frontend\widgets\ReturForm;;
?>
<div id="<?= $id ?>" class="retur view">
    <div class="view-header">
        Retur
    </div>

    <?=  ReturForm::widget(['id' => $id . '-form']) ?>

</div>  