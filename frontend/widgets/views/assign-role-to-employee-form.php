<?php
    use common\widgets\Form;
    use common\widgets\Button;
    use common\widgets\InputField;
    use common\widgets\SearchField;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/ac/assign-role-to-emp', 
        'widget_class' => 'form arolete-form' , 'enable_button' => false
        ]) ?>
        
    <?= SearchField::widget(['id' => $id . '-emp', 
                            'name' => 'employee_id', 
                            'url' => \Yii::$app->request->baseUrl . '/employee/search',
                            "placeholder" => 'Cari Karyawan']) ?>
    
    <?= SearchField::widget(['id' => $id . '-role', 
                            'name' => 'role',
                            'url' => \Yii::$app->request->baseUrl . '/ac/search-role',
                            "placeholder" => "Cari Role"]) ?>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>