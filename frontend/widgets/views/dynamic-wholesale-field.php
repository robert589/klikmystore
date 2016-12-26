<?php
    use common\widgets\DynamicField;
    use frontend\widgets\WholesaleField;
?>

<?php DynamicField::begin(['id' => $id, 'name' => $name]) ?>
    <?= WholesaleField::widget(['id' => $id . '-item', 'newClass' => 'dynamic-field-item']) ?>
<?php DynamicField::end() ?>