<?php
    use common\widgets\Form;
    use common\widgets\TextAreaField;
    use common\widgets\InputField;
    use common\widgets\Button;
    
    $this->title = "Tambah Supplier";
?>

<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/supplier/process-create', 
        'widget_class' => 'cs-form' , 'enable_button' => false
        ]) ?>   
    
    <div class="form-field">
        <div class="form-field-left">
            Company Name <span class="required">*</span>
        </div>
        <?= InputField::widget(['id' => $id. '-name', 'name' => 'company_name',
                'placeholder' => 'Company Name']) ?>

    </div>
    
    <div class="form-inline">
        <div class="form-field">
            <div class="form-field-left">
                Supplier First Name <span class="required">*</span>
            </div>
            <?= InputField::widget(['id' => $id. '-supp-first-name', 'name' => 'first_name',
                            'placeholder' => 'Supplier First Name']) ?>
        </div>
        <div class="form-field">
            <div class="form-field-left">
                Supplier Last Name <span class="required">*</span>
            </div>
            <?= InputField::widget(['id' => $id. '-supp-last-name','name' => 'last_name',
                            'placeholder' => 'Supplier Last Name']) ?>
    
        </div>
        
    </div>
    
    <div class="form-field-left">
        Supplier Email <span class="required">*</span>
    </div>
    <?= InputField::widget(['id' => $id. '-supp-email', 'name' => 'email',
                        'placeholder' => 'Supplier Email']) ?>
    
    <div class="form-field">
        <div class="form-field-left">
            Phone
        </div>
        <?= InputField::widget(['id' => $id. '-phone', 'name' => 'phone',
                        'placeholder' => 'Supplier Phone']) ?>
    </div>
    <div class="form-field">
        <div class="form-field-left">
            Address
        </div>
        <?= TextAreaField::widget(['id' => $id. '-address', 'name' => 'address',
                        'placeholder' => 'Write your address here', 'rows' => 3]) ?>
    </div>  
    <div class="form-field">
        <?= Button::widget(['id' => $id . '-submit-btn' ,  
                'text' => 'Add', 'newClass' => 'form-submit']) ?>

    </div>
    
<?php Form::end() ?>
