<?php
    use frontend\widgets\RestockForm;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="restock view">
    <div class="view-header">
        Restock
        

    </div>
    

    <?=  RestockForm::widget(['id' => $id . '-form']) ?>

</div>