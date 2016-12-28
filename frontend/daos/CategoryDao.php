<?php
namespace frontend\daos;

use Yii;
use frontend\vos\CategoryVoBuilder;
use common\components\Dao;
/**
 * CategoryDao class
 */
class CategoryDao implements Dao
{
    const CATEGORY_LIST = "SELECT category.id, category.name, category.description 
                            from category";
    
    public function getCategory() {
        $results =  \Yii::$app->db
            ->createCommand(self::CATEGORY_LIST)
            ->queryAll();
        $vos = [];
        foreach($results as $result) {
            $builder = new CategoryVoBuilder;
            $builder->loadData($result);
            $vos[] = $builder->build();
        }
        
        return $vos;

    }
}

