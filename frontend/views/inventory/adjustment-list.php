<?php
    use frontend\widgets\RestockForm;
    use common\widgets\Button;
    use yii\data\ArrayDataProvider;
    use yii\widgets\ListView;
?>
<div id="<?= $id ?>" class="adj-list view">
    <div class="view-header">
        Adjustment History
        
        <?= Button::widget(['id' => $id . '-add', 'text' => 'Tambah Adjustment', 'newClass' => 'view-header-btn']) ?>
    </div>
    
    <?= ListView::widget([
            'dataProvider' => $provider,
            'layout' => "{pager}\n{items}\n{summary}",
            'itemView' => function ($vo, $key, $index, $widget) {
                $models = [];
                foreach($vo->getAdjustments() as $adjustment) {
                    $model['product_id'] = $adjustment->getProduct()->getId();
                    $model['product_name'] = $adjustment->getProduct()->getName();
                    $model['adjustment'] = $adjustment->getAdjust();
                    $models[] = $model;
                }
                
                $provider = new ArrayDataProvider([
                    'allModels' => $models,
                    'pagination' => [
                        'pageSize' => count($models)
                    ]
                ]);
                return $this->render('adjustment-list-lvi',
                        ['vo' => $vo, 'id' => 'adjllvi-' . $vo->getId(), 'adjustments' => $provider]);
            },
            'viewParams'=>['id'=> $id],
        ]); ?>

</div>