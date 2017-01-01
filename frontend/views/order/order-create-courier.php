<?php
    use frontend\widgets\CreateCourierForm;
?>

<div id="<?= $id ?>" class="order-cc view">
    <div class="view-header">
        Buat Kurir
    </div>
    <?= CreateCourierForm::widget(['id' => $id . 'form']) ?>
</div>