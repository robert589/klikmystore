<?php
    use frontend\widgets\CreateMarketplaceForm;
?>

<div id="<?= $id ?>" class="order-cm view">
    <div class="view-header">
        Buat Marketplace
    </div>
    <?=    CreateMarketplaceForm::widget(['id' => $id . 'form']) ?>
</div>