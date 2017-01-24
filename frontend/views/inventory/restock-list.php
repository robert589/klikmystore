<?php
    use frontend\widgets\RestockForm;
    use common\widgets\Button;
    use yii\data\ArrayDataProvider;
    use yii\widgets\ListView;
?>
<div id="<?= $id ?>" class="restock-list view">
    <div class="view-header">
        Restock History
        
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Restock', 'newClass' => 'view-header-btn']) ?>
    </div>
    
    <?= ListView::widget([
            'dataProvider' => $provider,
            'layout' => "{pager}\n{items}\n{summary}",
            'itemView' => function ($vo, $key, $index, $widget) {
                $models = [];
                foreach($vo->getRestockProducts() as $restockProduct) {
                    $model['product_id'] = $restockProduct->getProduct()->getId();
                    $model['product_name'] = $restockProduct->getProduct()->getName();
                    $model['quantity'] = $restockProduct->getQuantity();
                    $models[] = $model;
                }
                
                $provider = new ArrayDataProvider([
                    'allModels' => $models,
                    'pagination' => [
                        'pageSize' => count($models)
                    ]
                ]);
                return $this->render('restock-list-lvi',
                        ['vo' => $vo, 'id' => 'rsllvi-' . $vo->getId(), 'products' => $provider]);
            },
            'viewParams'=>['id'=> $id],
        ]); ?>

</div>