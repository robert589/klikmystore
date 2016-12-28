<?php
    use common\widgets\Form;
    use frontend\widgets\DynamicWholesaleField;
    use common\widgets\InputField;
    use common\widgets\Button;
?>

<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/product/process-add', 
        'widget_class' => 'form' , 'enable_button' => false
        ]) ?>   
    <div class="form-label">
        Gambar Produk
    </div>

    <div class="form-field">
        <div class="form-field-left">
            Gambar
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-picture-field', 
                    'type' => InputField::FIlE, 'name' => 'picture', 
                'value' => null ]) ?>
        </div>
    </div>

    <div class="form-label">
        Produk Detail
    </div>
    
    <div class="form-field">
        <div class="form-field-left">
            Nama Produk
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-name-field', 
                    'type' => InputField::TEXT, 'name' => 'name', 
                    'value' => null ]) ?>
        </div>
    </div>


    <div class="form-field">
        <div class="form-field-left">
            SKU
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-sku-field', 
                    'type' => InputField::TEXT, 'name' => 'sku', 
                    'value' => null ]) ?>
        </div>
    </div>


    <div class="form-field">
        <div class="form-field-left">
            Berat
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-weight-field', 
                    'type' => InputField::NUMBER, 'name' => 'weight', 
                    'value' => null ]) ?>
        </div>
    </div>

    
    <div class="form-field">
        <div class="form-field-left">
            Link
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-link-field', 
                    'type' => InputField::TEXT, 'name' => 'link', 
                    'value' => null ]) ?>
        </div>
    </div>
    
    
    <div class="form-field">
        <div class="form-field-left">
            Kategori
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-category-field', 
                    'type' => InputField::TEXT, 'name' => 'category', 
                    'value' => null ]) ?>
        </div>
    </div>


    <div class="form-label">
        Kuantitas Produk
    </div>
    
    <div class="form-field">
        <div class="form-field-left">
            Kuantitas
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-quantity-field', 
                    'type' => InputField::NUMBER, 'name' => 'quantity', 
                    'value' => null ]) ?>
        </div>
    </div>

    <div class="form-field">
        <div class="form-field-left">
            Minimal Kuantitas
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-min-quantity-field', 
                    'type' => InputField::NUMBER, 'name' => 'min_quantity', 
                    'value' => null ]) ?>
        </div>
    </div>

    <div class="form-label">
        Harga Produk
    </div>


    <div class="form-field">
        <div class="form-field-left">
            Harga 1
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-price1-field', 
                    'type' => InputField::NUMBER, 'name' => 'price1', 
                    'value' => null ]) ?>
        </div>
    </div>

    <div class="form-field">
        <div class="form-field-left">
            Harga 2
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-price2-field', 
                    'type' => InputField::NUMBER, 'name' => 'price2', 
                    'value' => null ]) ?>
        </div>
    </div>
    
    <div class="form-field">
        <div class="form-field-left">
            Harga 3
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-price3-field', 
                    'type' => InputField::NUMBER, 'name' => 'price3', 
                    'value' => null ]) ?>
        </div>
    </div>

    <div class="form-field">
        <div class="form-field-left">
            Harga 4
        </div>
        <div class="form-field-right">
            <?= InputField::widget(['id' => $id . '-price4-field', 
                    'type' => InputField::NUMBER, 'name' => 'price4', 
                    'value' => null ]) ?>
        </div>
    </div>

    <div class="form-label">
        Harga Grosir
    </div>

    <div class="form-field">
        <?= DynamicWholesaleField::widget(['id' => $id. '-dynamic-wholesale', 'name' => 'wholesale']) ?>
    </div>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
