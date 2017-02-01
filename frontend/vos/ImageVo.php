<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * ImageVo vo
 *
 */
class ImageVo implements RVo
{
    public static function createBuilder() { return new ImageVoBuilder();} 
    //attributes

    private $user;

    private $path;

    private $image;

    private $createdAt;

    private $updatedAt;

    public function __construct(ImageVoBuilder $builder) { 
        $this->user = $builder->getUser(); 
        $this->path = $builder->getPath(); 
        $this->image = $builder->getImage(); 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
    }

    //getters

    public function getUser() { 
        return $this->user; 
    }

    public function getPath() { 
        return $this->path; 
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
}