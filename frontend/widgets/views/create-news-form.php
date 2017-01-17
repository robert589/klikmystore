<?php
    use common\widgets\Form;
    use yii\redactor\widgets\Redactor;
    use common\widgets\Button;
    use common\widgets\RedactorField;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/news/process-create', 
        'widget_class' => 'form' , 'enable_button' => false
        ]) ?>
        
    <?= RedactorField::widget(['id' => $id . '-input', 'name' => 'news']) ?>


    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>