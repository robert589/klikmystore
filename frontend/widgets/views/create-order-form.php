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
                    . '/order/process-create', 
        'widget_class' => 'form co-form' , 'enable_button' => false
        ]) ?>   
    
    <div class="form-subform">
        
        <div class="co-form-cluster">
            <div class="app-row">
                <?=   CheckboxField::widget(['id' => $id . '-offline-order', 'item' => 'Offline Order', 'name' => 'offline_order']) ?>
                <?=   CheckboxField::widget(['id' => $id . '-dropship', 'item' => 'Dropship', 'name' => 'dropship']) ?>
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
                                            'name' => 'receiver_id',
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
                            'name' => 'sender_id',
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

    <div class="form-subform">
        <div class="co-form-cluster">
            <div class="form-field">
                <div class="form-field-left">
                    Marketplace
                </div>
                <div class="form-field-right">
                    <?= SearchField::widget(['id' => $id . '-marketplace', 'placeholder' => 'Cari Marketplace',
                                'name' => 'marketplace_code',
                                'url' => \Yii::$app->request->baseUrl . '/order/search-marketplace']) ?>
                </div>
            </div>
            <div class="form-field">
                <div class="form-field-left">
                    Courier
                </div>
                <div class="form-field-right">
                    <?= SearchField::widget(['id' => $id . '-courier', 'placeholder' => 'Cari Kurir',
                                'name' => 'courier_code',
                                'url' => \Yii::$app->request->baseUrl . '/order/search-courier']) ?>
                </div>
            </div>
            
            <div class="form-field">
                <div class="form-field-left">
                    Kota
                </div>
                <div class="form-field-right">
                    <?= SearchField::widget(['id' => $id . '-city', 'placeholder' => 'Cari Kota',
                                'name' => 'city_id',
                                'url' => \Yii::$app->request->baseUrl . '/location/search-city-by-courier', 'disabled' => true]) ?>
                </div>
            </div>
            <div class="form-field">
                <div class="form-field-left">
                    Kecamatan
                </div>
                <div class="form-field-right">
                    <?= SearchField::widget(['id' => $id . '-district', 'placeholder' => 'Cari Kecamatan', 'name' => 'district_id',
                                'url' => \Yii::$app->request->baseUrl . '/location/search-district-for-tariff', 'disabled' => true]) ?>
                </div>
            </div>
            
            <div class="form-field">
                <div class="form-field-left">
                    Kode Job
                </div>
                <div class="form-field-right">
                    <?= InputField::widget(['id' => $id . '-jobcode', 'placeholder' => 'Cari Kurir',
                                'name' => 'job_code']) ?>
                </div>
            </div>
            
            <div class="form-field">
                <div class="form-field-left">
                    Tanggal Pickup
                </div>
                <div class="form-field-right">
                    <?= InputField::widget(['id' => $id . '-pickup', 'placeholder' => 'Cari Tanggal',
                                'name' => 'pickup',
                                'datepicker' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-subform">
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
            <div class="co-form-value co-form-tariff">
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
                
                <?= CheckboxField::widget(['id' => $id . '-label', 'item' => 'Print Label', 'name' => 'print_label']) ?>
                <?= CheckboxField::widget(['id' => $id . '-print-invoice', 'item' => 'Print Invoice', 'name' => 'print_invoice']) ?>
            </div>
        </div>
        
        <div class="form-field">
            <div class="form-field-left">
                Ukuran Kertas
            </div>
            <div class="form-field-right app-row">
                <?= RadioField::widget(['id' => $id . '-paper-size', 'name' => 'paper_type',
                                    'items' => [Order::PRINT_THERMAL => "Print Thermal", Order::PRINT_NORMAL => "Print Normal"]]) ?>
            </div>
        </div>
    </div>
    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
