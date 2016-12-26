<?php
    use common\widgets\InputField;
?>

<div id="<?= $id ?>" class="wholesale-field <?= $newClass  ?>" >
    <div class="wholesale-field-field">
        <div class="wholesale-field-field-item">
            <b> Min </b>
            <?=    InputField::widget(['id' => $id . '-min', 'type' => InputField::NUMBER])  ?>
        </div>
        <div class="wholesale-field-field-item">
            <b> Max </b>
            <?=    InputField::widget(['id' => $id . '-max', 'type' => InputField::NUMBER])  ?>
        </div>
        <div class="wholesale-field-field-item">
            <b> Harga </b>
            <?=    InputField::widget(['id' => $id . '-price', 'type' => InputField::NUMBER])  ?>
        </div>
    </div>
    <div class="field-error app-hide">

    </div>
</div>
