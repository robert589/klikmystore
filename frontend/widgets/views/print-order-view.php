<?php

?>

<div id="<?= $id ?>" class="print-ov">
    <div class="print-ov-field">
        Order Id: <?= $vo->getId() ?>
    </div>
    
    <div class="print-ov-field">
        Penerima : <?= $vo->getReceiver()->getName() ?> ( <?= $vo->getReceiver()->getTelephone() ?> )
    </div>
    
    <div class="print-ov-field">
        <?= $vo->getReceiver()->getAddress() ?>
    </div>
    
    <div class="print-ov-field">
        Pengirim : <?= $vo->getSender()->getName() ?> ( <?= $vo->getSender()->getTelephone() ?> )
    </div>
    
    <div class="print-ov-label">
        Daftar Order
    </div>
    
    <?php 
    if($vo->getProducts()) {
        foreach($vo->getProducts() as $orderProduct) { ?>
            <div class="print-ov-field">
                <?= $orderProduct->getProduct()->getName() ?> - <?= $orderProduct->getQuantity() ?> 
                <?= $orderProduct->getProduct()->getBarcode() ?>
            </div>
        <?php } 
    }
    ?>
</div>