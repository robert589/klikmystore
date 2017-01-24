<?php
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
                            'template' => '{terima},{tolak}',
                            'buttons' => [
                                'terima' => function($url, $model, $key) {
                                    if($model['status_id'] == common\models\Order::PENDING_STATUS) {
                                        return Button::widget(['id' => 'olacc' . $model['order_id'], 
                                                            'text' => 'Terima', 'newClass' => 'order-list-acc',
                                                            'options' => [
                                                                'data-order-id' => $model['order_id']
                                                            ]
                                                        ]); 
                                    }
                                },
                                'tolak' => function($url,$model, $key) {
                                    if($model['status_id'] == common\models\Order::PENDING_STATUS) {
                                        return Button::widget(['id' => 'olrej' . $model['order_id'], 
                                                            'text' => 'Tolak', 'newClass' => 'order-list-rej',
                                                            'color' => Button::RED_COLOR, 
                                                            'options' => [
                                                                'data-order-id' => $model['order_id']
                                                            ]]); 
                                    }
                                }
                            ]
                        ]
                    ],
                            
                ]) ?>

        </div>
    </div>
</div>


