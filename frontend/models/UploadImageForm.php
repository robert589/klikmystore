<?php
namespace frontend\models;

use common\components\RModel;
use common\models\Image;
/**
 * UploadImageForm model
 *
 */
class UploadImageForm extends RModel
{

    //attributes
    public $image;

    public $user_id;
    
    /*
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['image', 'required'],
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['image', 'file', 'skipOnEmpty' => true, 'extensions'=>'svg, png, jpg, jpeg']
        ];
    }
    
    public function save() {
        if(!$this->validate()) {
            return null;
        }   
        $image = new Image();
        $image->user_id = $this->user_id;
        $basename = $this->image['name'][0];
        $ext = pathinfo($basename, PATHINFO_EXTENSION);
        $fileName = pathinfo($basename, PATHINFO_FILENAME);
        if(!file_exists('images/' . $this->user_id)) {
            mkdir('images/' . $this->user_id, 0755,true );
        }
        $image->path = 'images/' . $this->user_id . '/' . 
                $basename;
        
        $index = 0;
        while(file_exists($image->path)) {
            $index++;
            $image->path = 'images/' . $this->user_id . '/' . 
                    $fileName . "_" . $index . "." . $ext ;
        }
        if(!$image->save()) {
            Yii::$app->end('error');
            return null;
        }
        $success = move_uploaded_file($this->image['tmp_name'][0] ,   $image->path);
        if(!$success) {
            return null;
        }
        return $image;
    }
}