<?php
    use common\widgets\Button;
?>

<div id="<?= $id ?>" class="pof-item" data-quantity="<?= $quantity ?>">
    <div class="pof-item-id"><?= $vo->getId() ?></div>
    <div class="pof-item-name">
        <?= $vo->getName() ?>
    </div>
    <div class="pof-item-qty">
        <div class="pof-item-qty-view">
            <?= "Qty: " . $quantity ?>
            <?= Button::widget(['id' => $id . '-edit-qty', 'text' => '<span class="glyphicon glyphicon-pencil"></span>',
                                'color' => Button::NONE_COLOR]) ?>
        </div>
        <div class="pof-item-qty-edit">
            
        </div>
    </div>
</div>