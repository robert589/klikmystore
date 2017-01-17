<?php
namespace frontend\services;

use frontend\daos\NewsDao;
use common\components\RService;
/**
 * DashboardService service
 *
 */
class DashboardService extends RService
{

    //attributes
    public $user_id;
    
    private $newsDao;
    
    public function init() {
        $this->newsDao = new NewsDao();
    }
    public function rules() {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required']
        ];
    }
    
    public function getNews() {
        if(!$this->validate()) {
            return false;
        }
        
        return $this->newsDao->getNewsList();
    }
}