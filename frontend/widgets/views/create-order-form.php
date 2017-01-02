<?php
    use common\widgets\InputField;
    use common\widgets\SearchField;
    use common\widgets\Button;  
    use common\widgets\Form;
    use common\widgets\CheckboxField;
    use common\widgets\TabContainer;
    use common\widgets\TabItem;
?>


<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/product/process-create-order', 
        'widget_class' => 'form co-form' , 'enable_button' => false
        ]) ?>   
    
    <div class="co-form-left">
        <div class="co-form-cluster">
            <div class="form-field">
                <div class="form-field-left">
                    Penerima
                    <?= Button::widget(['id' => $id . '-add-user-1', 'widgetClass' => 'button-link',
                                        'color' => Button::NONE_COLOR,
                                        'text' => 'Tambah Pengguna baru']) ?>
                </div>
                <div class="form-field-right">
                    <?= SearchField::widget(['id' => $id . '-receiver-field', 'placeholder' => 'Cari Pengguna',
                                            'url' => \Yii::$app->request->url . '/user/search-user']) ?>
                </div>
            </div>
        </div>
        <div class="co-form-cluster">
            <div class="form-field">
                <div class="form-field-left">
                    Pengirim
                </div>
                <div class="form-field-right">
                    <?= SearchField::widget(['id' => $id . '-sender-field', 'placeholder' => 'Cari Pengguna',
                                'url' => \Yii::$app->request->url . '/user/search-user']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="co-form-right">
        <div class="co-form-sender">
            
        </div>
    </div>
    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
