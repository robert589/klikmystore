<?php
    use common\widgets\Form;
    use common\widgets\SearchField;
    use frontend\widgets\DynamicWholesaleField;
    use common\widgets\InputField;
    use common\widgets\Button;
?>

<?php Form::begin(
        ['id' => $id, 
         'method' => 'post', 
         'url' => \Yii::$app->request->baseUrl 
                    . '/product/process-add', 
        'widget_class' => 'form ap-form' , 'enable_button' => false
        ]) ?>   
    <div class="form-subform">
        
        <div class="form-label">
            Gambar Produk
        </div>
        <div class="form-field">
            <div class="form-field-left">
                Gambar
            </div>
            <div class="form-field-right">
                <?= InputField::widget(['id' => $id . '-image-field', 
                        'type' => InputField::FIlE, 'name' => 'image', 
                    'value' => null ]) ?>
            </div>
            <?= InputField::widget(['id' => $id . '-image-id-field', 
                    'type' => InputField::HIDDEN, 'name' => 'image_id', 
                'value' => null ]) ?>
            
        </div>
        
        <image class="ap-form-preview app-hide" src=""/>
            

        <div class="form-field">
            <div class="form-field-left">
                Kategori
            </div>
            <div class="form-field-right">
                <?= SearchField::widget(['id' => $id . '-category-field', 
                         'url' => Yii::$app->request->baseUrl . '/product/search-category',
                         'name' => 'category' ]) ?>
            </div>
        </div>
        
    </div>

    <div class="form-subform">
        
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
                Minimal Kuantitas
            </div>
            <div class="form-field-right">
                <?= InputField::widget(['id' => $id . '-min-quantity-field', 
                        'type' => InputField::NUMBER, 'name' => 'min_quantity', 
                        'value' => null ]) ?>
            </div>
        </div>
    </div>

    
    <div class="form-subform">
        <div class="form-label">
            Harga Grosir
        </div>

        <div class="form-field">
            <?= DynamicWholesaleField::widget(['id' => $id. '-dynamic-wholesale', 'name' => 'wholesale']) ?>
        </div>
        
        
        <div class="form-label">
            Harga Produk
        </div>

        <div class="form-flex">
            <div class="form-field form-flex-item">
                <div class="form-field-left">
                    Harga 1
                </div>
                <div class="form-field-right">
                    <?= InputField::widget(['id' => $id . '-price1-field', 
                            'type' => InputField::NUMBER, 'name' => 'price_1', 
                            'value' => null ]) ?>
                </div>
            </div>

            <div class="form-field form-flex-item">
                <div class="form-field-left">
                    Harga 2
                </div>
                <div class="form-field-right">
                    <?= InputField::widget(['id' => $id . '-price2-field', 
                            'type' => InputField::NUMBER, 'name' => 'price_2', 
                            'value' => null ]) ?>
                </div>
            </div>
        </div>
        
        <div class="form-flex">
            <div class="form-field form-flex-item">
                <div class="form-field-left">
                    Harga 3
                </div>
                <div class="form-field-right">
                    <?= InputField::widget(['id' => $id . '-price3-field', 
                            'type' => InputField::NUMBER, 'name' => 'price_3', 
                            'value' => null ]) ?>
                </div>
            </div>

            <div class="form-field form-flex-item">
                <div class="form-field-left">
                    Harga 4
                </div>
                <div class="form-field-right">
                    <?= InputField::widget(['id' => $id . '-price4-field', 
                            'type' => InputField::NUMBER, 'name' => 'price_4', 
                            'value' => null ]) ?>
                </div>
            </div>    
        </div>
        
    </div>

    <?= Button::widget(['id' => $id . '-submit-btn' , 
        'text' => 'Add', 'newClass' => 'form-submit']) ?>
<?php Form::end() ?>
