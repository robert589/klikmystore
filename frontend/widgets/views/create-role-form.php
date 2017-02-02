<?php
    use common\widgets\Form;
    use common\widgets\Button;
    use common\widgets\InputField;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$aapp->request->baseUrl 
                    . '/ac/add-role', 
        'widget_class' => 'form crole-form' , 'enable_button' => false
        ]) ?>
        
    <?= InputField::widget(['id' => $id . '-title', 'name' => 'title', "placeholder" => 'Nama Role']) ?>
    
    <?= InputField::widget(['id' => $id . '-desc', 'name' => 'description', "placeholder" => "Deskripsi Role"]) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>