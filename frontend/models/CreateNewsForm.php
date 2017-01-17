<?php
namespace frontend\models;

use common\components\RModel;
use common\models\News;
/**
 * CreateNewsForm model
 *
 */
class CreateNewsForm extends RModel
{

    //attributes
    public $user_id;

    public $news;
    
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            
            ['news', 'string'],
            ['news', 'required']
        ];
    }
    
    public function create() {
        if(!$this->validate() ) {
            return false;
        }
        $news = new News();
        $news->user_id = $this->user_id;
        $news->news = $this->news;
        return $news->save();
    }

}