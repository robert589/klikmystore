<?php
    use common\widgets\Modal;

?>
<?php Modal::begin([
    'id' => $id,
    'title' => 'Print Order',
    'newClass' => 'po-modal'
]) ?>
    <div class="po-modal-loading">
        Loading..
    </div>
    <div class="po-modal-view">
        
    </div>
<?php Modal::end() ?>
