<?php
    use frontend\widgets\CreateRoleForm;
    use common\widgets\Button;
?>

<div class="ac-role view" id="<?= $id ?>">
    <div class="view-header">
        Role
    </div>
    
    <div class="ac-role-header">
        Tambah Role
    </div>
    
    <?=    CreateRoleForm::widget(['id' => $id . '-create']) ?>
</div>