<?php
namespace frontend\vos;

use yii\db\ActiveRecord;
use common\components\RVoBuilder;
/**
 * NewsVo builder
 *
 */
class NewsVoBuilder extends RVoBuilder
{
    function build() { return new NewsVo($this);  }
    //attributes

    public $createdAt;

    public $updatedAt;

    public $id;

    public $name;

    public $news;

    public function rules() { 
        return [
           ['createdAt','string'],
           ['updatedAt','string'],
           ['id','string'],
           ['name','string'],
           ['news','string'],
        ];
    }

    //getters

    public function getCreatedAt() { 
        return $this->createdAt; 
    }

    public function getUpdatedAt() { 
        return $this->updatedAt; 
    }

    public function getId() { 
        return $this->id; 
    }

    public function getName() { 
        return $this->name; 
    }

    public function getNews() { 
        return $this->news; 
    }

    //setters

    public function setCreatedAt($createdAt) { 
        $this->createdAt = $createdAt; 
    }

    public function setUpdatedAt($updatedAt) { 
        $this->updatedAt = $updatedAt; 
    }

    public function setId($id) { 
        $this->id = $id; 
    }

    public function setName($name) { 
        $this->name = $name; 
    }

    public function setNews($news) { 
        $this->news = $news; 
    }
}