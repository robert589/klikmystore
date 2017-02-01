<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * ImageVo builder
 *
 */
class ImageVoBuilder extends RVoBuilder
{
    function build() { return new ImageVo($this);  }
    //attributes

    public $user;

    public $path;

    public $image;

    public $createdAt;

    public $updatedAt;

    public function rules() { 
        return [
           ['user','string'],
           ['path','string'],
           ['image','string'],
           ['createdAt','string'],
           ['updatedAt','string'],
        ];
    }

    //getters

    public function getUser() { 
        return $this->user; 
    }

    public function getPath() { 
        if(!$this->path) {
            return \Yii::$app->request->baseUrl . '/images/no-image.png';
        }
        return \Yii::$app->request->baseUrl . '/' . $this->path; 
    }

    public function getImage() { 
        return $this->image; 
    }

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    //setters

    public function setUser($user) { 
        $this->user = $user; 
    }

    public function setPath($path) { 
        $this->path = $path; 
    }

    public function setImage($image) { 
        $this->image = $image; 
    }

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }
}