<?php
    use common\widgets\InputField;
     
?>

<div id="<?= $id ?>" class="or-field" data-total="<?= count($vos) ?>" data-name="<?= $name ?>">
    <div class="or-field-area">
        <div class="or-field-header">
            <div class="or-field-item">
                Product name
            </div>
            <div class="or-field-item">
                Retur
            </div>
            <div class="or-field-item">
                Efek ke inventaris
            </div>
            <div class="or-field-item">
                Keterangan
            </div>
        </div>
        <?php foreach($vos as $index => $vo) { ?>
        <div class="or-field-row">
            
            <div class="or-field-item">
                <?= $vo->getProduct()->getId() ?> . <?= $vo->getProduct()->getName() ?>
            </div>
            <div class="or-field-item">
                <?= InputField::widget(['id' => $id . '-retur-' . $index, 'name' => 'retur' . $index,
                    'type' => InputField::NUMBER, 'value' => 0, 'min' => 0, 'max' => $vo->getQuantity()]) ?>
                <span class="or-field-margin">
                    of <?= $vo->getQuantity() ?>                    
                </span>

            </div>
            <div class="or-field-item">
                <?= InputField::widget(['id' => $id . '-effect-' .  $index, 
                    'min' => 0, 'name' => 'effect' . $index,
                    'type' => InputField::NUMBER, 'value' => 0, 'disabled' => true]) ?>

            </div>
            <div class="or-field-item">
                <?= InputField::widget(['id' => $id . '-remark-' . $index,  'name' => 'remark' . $index,
                    'type' => InputField::TEXT, 'disabled' => true]) ?>           
            </div>
            
            <?= InputField::widget(['id' => $id . '-id-' . $index, 'type' => InputField::HIDDEN,
                'name' => 'id' . $index,
                            'value' => $vo->getProduct()->getId()]) ?>
            
            
            
            <?= InputField::widget(['id' => $id . '-quantity-' . $index, 'type' => InputField::HIDDEN,
                'name' => 'quantity' . $index,
                            'value' => $vo->getQuantity()]) ?>
        </div>

        <?php } ?>
    </div>
    <div class="field-error app-hide">
        
    </div>
</div>