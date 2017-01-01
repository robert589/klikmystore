<?php
    use InputFie
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/product/process-create-order', 
        'widget_class' => 'form co-form' , 'enable_button' => false
        ]) ?>   
    
    <div class="co-form-left">
        
    </div>

    <div class="co-form-right">
        <div class="co-form-sender">
            
        </div>
    </div>
    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
