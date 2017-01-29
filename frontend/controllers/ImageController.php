<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\UploadImageForm;
/**
 * Image controller
 */
class ImageController extends Controller
{
    
    public function actionUpload() {
        $data = array();
        if(!Yii::$app->user->isGuest && isset($_FILES['files'])) {
           $model = new UploadImageForm();
           $model->image = $_FILES['files'];
           $model->user_id = Yii::$app->user->getId();
           $image = $model->save();
           if($image) {
                $data['status'] = 1;
                $data['image_id'] = $image->id;
                $data['image_path'] = Yii::$app->request->baseUrl . '/' . $image->path;
                return json_encode($data);   
           } else {
               $data['status'] = 0;
               $data['errors'] = $model->getErrors();
           }
        } else {
            $data['status'] = 0;
            $data['errors'] = "data is not available";
        }
        return json_encode($data);
    }
}

