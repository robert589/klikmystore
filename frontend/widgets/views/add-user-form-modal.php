<?php
    use frontend\widgets\AddUserForm;
    use common\widgets\Modal;
?>

<?php Modal::begin(['id' => $id, 'title' => 'Tambah User']) ?>
    <?= AddUserForm::widget(['id' => $id. '-form']) ?>
    
<?php Modal::end() ?>


