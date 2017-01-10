<?php
    use common\widgets\InputField;
    use common\widgets\SearchField;
    use common\widgets\Button;  
    use common\models\Order;
    use common\widgets\Form;
    use common\widgets\CheckboxField;
    use common\widgets\TabContainer;
    use common\widgets\TabItem;
    use common\widgets\RadioField;
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
            <div class="app-row">
                <?=   CheckboxField::widget(['id' => $id . '-offline-order', 'item' => 'Offline Order']) ?>
                <?=   CheckboxField::widget(['id' => $id . '-dropship', 'item' => 'Dropship']) ?>
            </div>
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
                                'url' => \Yii::$app->request->baseUrl . '/location/search-city', 'disabled' => true]) ?>
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
                    <?= InputField::widget(['id' => $id . '-courier', 'placeholder' => 'Cari Tanggal',
                                'datepicker' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="co-form-right">
        <div class="co-form-row">
            Total Kuantitas: 
            <div class="co-form-value co-form-quantity">
                0
            </div>
        </div>
        <div class="co-form-row">
            Total Berat: 
            <div class="co-form-value co-form-weight">
                0
            </div> gram
        </div>
        <div class="co-form-row">
            Total Harga Barang: Rp.
            <div class="co-form-value co-form-price">
                0.00
            </div>
        </div>
        <div class="co-form-row">
            Ongkir: Rp.
            <div class="co-form-value">
                0.00
            </div>
        </div>
        <div class="co-form-row">
            Total Harga: Rp.
            <div class="co-form-value">
                0.00
            </div>
        </div>
        
        <div class="form-field">
            <div class="form-field-left">
                Print
            </div>
            <div class="form-field-right app-row">
                
                <?= CheckboxField::widget(['id' => $id . '-label', 'item' => 'Print Label']) ?>
                <?= CheckboxField::widget(['id' => $id . '-invoice', 'item' => 'Print Invoice']) ?>
            </div>
        </div>
        
        <div class="form-field">
            <div class="form-field-left">
                Ukuran Kertas
            </div>
            <div class="form-field-right app-row">
                <?= RadioField::widget(['id' => $id . '-paper-size', 
                                    'items' => [Order::PRINT_THERMAL => "Print Thermal", Order::PRINT_NORMAL => "Print Normal"]]) ?>
            </div>
        </div>
    </div>
    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
