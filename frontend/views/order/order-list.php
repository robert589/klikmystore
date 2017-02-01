<?php
    use common\models\Order;
    use common\widgets\DropdownField;
    use yii\bootstrap\Dropdown;
    use yii\grid\GridView;
    use common\widgets\Button;
?>
<div id="ol" class="order-list row main-area">
    <div class="col-md-9 col-sm-9 content-box">
        <div class="full-width-section clearfix">
            <div class="view-header">
                Daftar Order
                <?= Button::widget(['id' => 'ol'. '-add', 'text' => 'Tambah Order', 'newClass' => 'view-header-btn']) ?>
            </div>
            <?=  GridView::widget(
                    ['dataProvider' => $provider,
                    'columns' => [
                        'order_id',
                        'total_harga',
                        'nama_pengirim',
                        'nama_pembeli',
                        'total_kuantitas',
                        'status',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{act},{tolak}',
                            'buttons' => [
                                'act' => function($url, $model, $key) {
                                    $items = Order::getOrderStatus();
                                    unset($items[$model['status_id']]);
                                    $items['print'] = 'Print';
                                    return DropdownField::widget(['id' => 'df-' . $model['order_id'], 
                                        'newClass' => 'order-list-action',
                                        'placeholder' => 'Pilih Aksi',
                                        'items' => $items,
                                        'options' => [
                                            'data-order-id' => $model['order_id']
                                        ]
                                    ]);
                                    
                                }
                            ]
                        ]
                    ],
                            
                ]) ?>

        </div>
    </div>
</div>


