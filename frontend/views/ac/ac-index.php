<?php
    use frontend\widgets\AssignRoleToEmployeeForm;
    use common\widgets\Button;
?>

<div class="ac-index view" id="<?= $id ?>">
    <div class="view-header">
        Daftar Akses Control
    </div>
    <div class="ac-index-header">
        <?=  Button::widget(['id' => $id . '-role', 'text' => 'Tambah Role']) ?>
        <?=  Button::widget(['id' => $id . '-permission', 'text' => 'Tambah Permission', 'color' => Button::RED_COLOR]) ?>
    </div>
    
    <div class="ac-index-header">
        Assign Role  ke Karyawan
    </div>
    
    <?=    AssignRoleToEmployeeForm::widget(['id' => $id . '-arte']) ?>
</div>