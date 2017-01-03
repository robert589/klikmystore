<?php
    use common\widgets\InputField;
    use common\widgets\SearchField;
    use common\widgets\Button;  
    use common\widgets\Form;
    use common\widgets\CheckboxField;
    use common\widgets\TabContainer;
    use common\widgets\TabItem;
    use frontend\widgets\ProductOrderField;
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
                                            'url' => \Yii::$app->request->baseUrl . '/user/search-user']) ?>
                </div>
            </div>
        </div>
        <div class="form-field">
            <div class="form-field-left">
                Pengirim
            </div>
            <div class="form-field-right">
                <?= SearchField::widget(['id' => $id . '-sender-field', 'placeholder' => 'Cari Pengguna',
                            'url' => \Yii::$app->request->baseUrl . '/user/search-user']) ?>
            </div>
        </div>
        <div class="form-field">
            <div class="form-field-left">
                Daftar Produk
            </div>
            <div class="form-field-right">
                <?= ProductOrderField::widget(['id' => $id . '-po-field', 'name' => 'products']) ?>
            </div>
        </div>
    </div>

    <div class="co-form-right">
        <div class="co-form-cluster">
            <div class="form-field">
                <div class="form-field-left">
                    Marketplace
                </div>
                <div class="form-field-right">
                    <?= SearchField::widget(['id' => $id . '-marketplace', 'placeholder' => 'Cari Marketplace',
                                'url' => \Yii::$app->request->baseUrl . '/order/search-marketplace']) ?>
                </div>
            </div>
            <div class="form-field">
                <div class="form-field-left">
                    Courier
                </div>
                <div class="form-field-right">
                    <?= SearchField::widget(['id' => $id . '-courier', 'placeholder' => 'Cari Kurir',
                                'url' => \Yii::$app->request->baseUrl . '/order/search-courier']) ?>
                </div>
            </div>
            
            <div class="form-field">
                <div class="form-field-left">
                    Kota
                </div>
                <div class="form-field-right">
                    <?= SearchField::widget(['id' => $id . '-city', 'placeholder' => 'Cari Kota',
                                'url' => \Yii::$app->request->baseUrl . '/location/search-city']) ?>
                </div>
            </div>
            <div class="form-field">
                <div class="form-field-left">
                    Kecamatan
                </div>
                <div class="form-field-right">
                    <?= SearchField::widget(['id' => $id . '-district', 'placeholder' => 'Cari Kecamatan',
                                'url' => \Yii::$app->request->baseUrl . '/location/search-district', 'disabled' => true]) ?>
                </div>
            </div>
            
            <div class="form-field">
                <div class="form-field-left">
                    Kode Job
                </div>
                <div class="form-field-right">
                    <?= SearchField::widget(['id' => $id . '-courier', 'placeholder' => 'Cari Kurir',
                                'url' => \Yii::$app->request->baseUrl . '/order/search-courier']) ?>
                </div>
            </div>
            
            <div class="form-field">
                <div class="form-field-left">
                    Tanggal Pickup
                </div>
                <div class="form-field-right">
                    <?= InputField::widget(['id' => $id . '-courier', 'placeholder' => 'Cari Kurir',
                                'datepicker' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="co-form-right">

    </div>
    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
