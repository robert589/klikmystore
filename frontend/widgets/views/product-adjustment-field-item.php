<?php
    use common\widgets\InputField;
    use common\widgets\Button;
?>
    
<div id="<?= $id ?>" class="paf-item">
    
    <div class="paf-item-id paf-item-cell" id="<?= $id . '-id' ?>"><?= $vo->getId() ?></div>
    <div class="paf-item-name paf-item-cell">
        <?= $vo->getName() ?>
    </div>
    <div class="paf-item-qty paf-item-cell">
        <?= $vo->getQuantity() ?>
    </div>
    <div class="paf-item-adjustment paf-item-cell">
        <?= InputField::widget(['id' => $id . '-adjust', 'type' => InputField::NUMBER,
                        'name' => 'adjust_' . $vo->getId(), 'value' => 0]) ?>
    </div>
    <div class="paf-item-final paf-item-cell">
        <?= $vo->getQuantity() ?>
    </div>
</div>