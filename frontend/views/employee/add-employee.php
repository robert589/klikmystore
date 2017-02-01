<?php
    use frontend\widgets\AddEmployeeForm;
    use common\widgets\Button;
?>
<div id="<?= $id ?>" class="add-emp view">
    <div class="view-header">
        Add Employee
    </div>
    <?=  AddEmployeeForm::widget(['id' => $id . '-form']) ?>
</div>