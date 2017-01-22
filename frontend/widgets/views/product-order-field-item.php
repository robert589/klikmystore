<?php
    use common\widgets\InputField;
    use common\widgets\Button;
?>
    
<div id="<?= $id ?>" class="pof-item" 
     data-quantity="<?= $quantity ?>" 
     data-price="<?= $vo->getPrice1() ?>"
     data-weight="<?= $vo->getWeight() ?>">
    
    <div class="pof-item-id"><?= $vo->getId() ?></div>
    <div class="pof-item-name">
        <?= $vo->getName() ?>
    </div>
    <div class="pof-item-qty">
        <div class="pof-item-qty-view" id="<?= $id . "-qty-view" ?>">
            <span class="pof-item-qty-value" id="<?= $id . "-qty-value" ?>">
                <?= $quantity ?>
            </span>
            <?= Button::widget(['id' => $id . '-editqty-btn', 'text' => '<span class="glyphicon glyphicon-pencil"></span>',
                                'color' => Button::NONE_COLOR]) ?>
        </div>
        <div class="pof-item-qty-edit app-hide" id="<?= $id . '-qty-edit' ?>">
            <?= InputField::widget(['id' => $id . '-new-qty', 'value' => $quantity, 'type' => InputField::NUMBER]) ?>
        </div>
    </div>
</div>