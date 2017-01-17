<?php
namespace frontend\vos;

use common\libraries\TimeLibrary;
use yii\db\ActiveRecord;
use common\components\RVo;
/**
 * NewsVo vo
 *
 */
class NewsVo implements RVo
{
    public static function createBuilder() { return new NewsVoBuilder();} 
    //attributes

    private $createdAt;

    private $updatedAt;

    private $id;

    private $name;

    private $news;

    public function __construct(NewsVoBuilder $builder) { 
        $this->createdAt = $builder->getCreatedAt(); 
        $this->updatedAt = $builder->getUpdatedAt(); 
        $this->id = $builder->getId(); 
        $this->name = $builder->getName(); 
        $this->news = $builder->getNews(); 
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
    
    public function getTime() {
        return TimeLibrary::getTimeText($this->createdAt);
    }
}