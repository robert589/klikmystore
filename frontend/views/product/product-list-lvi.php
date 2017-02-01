<?php

?>

<div id="<?= $id ?>" class="product-list-lvi">
    <div class="product-list-lvi-item">
        <?= $vo->getName() ?>
    </div>
    <div class="product-list-lvi-img-wrap" >
    
        <img class="product-list-lvi-img" src="<?= $vo->getImage()->getPath() ?>"/>
    </div>
    <div class="product-list-lvi-quantity">
        Current Quantity : <?= $vo->getQuantity() ?>
    </div>
</div>