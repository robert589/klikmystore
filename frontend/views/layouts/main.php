<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widgets\MasterSidebar;
use frontend\widgets\Sidebar;
use common\libraries\UserLibrary;
use frontend\widgets\TeacherSidebar;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?php if(!Yii::$app->user->isGuest) { ?>
    <header class="header clearfix">
        <div class="logo-section">
            <img class="login-logo" src="<?= \Yii::$app->request->baseUrl . "/images/logo.jpeg" ?>" >
        </div>
        <div class="top-right-section">
            <a class="fullview menu-link app-hamburger"></a>
            <div class="top-profile-section">
                <div class="top-profile-name">Hi, <?= \Yii::$app->user->identity->first_name ?> 
                </div>
                <div class="profile-dropdown">
                    <a href="#" class="account">
                        <img src=<?= Yii::$app->request->baseUrl  . "/images/profile-pic'.jpg" ?> class="profile-circle"/>
                    </a>
                    <div class="submenu" style="display: none;">
                        <ul class="root">
                            <li> 
                                <?= Html::a('Logout',
                                    ['site/logout'],
                                    ['data-method'=>'post']); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </header>

        <div class="main-section clearfix">
            <div class="left-section left-side" id="sidebar">
                <div class="date-time-section clearfix">
                    <?php
                      date_default_timezone_set("Asia/Kolkata");
                      echo date("h:ia");
                      ?>
                      <span><?php echo date("M d");?><br><?php echo date("Y");?>
                      </span>
                </div>
                <div class="menu-section clearfix">
                    <?= Sidebar::widget(['id' => 'cssmenu', 
                            'items' => [
                                ['label' => 'Dashboard',
                                  'href' => Yii::$app->request->baseUrl . '/dashboard/index'
                                ],
                                ['label' => 'Produk',
                                 'href' => '#', 
                                 'items' => [
                                     ['label' => 'Produk', 'href' => Yii::$app->request->baseUrl . "/product/list"],
                                     ['label' => 'Kategori' , 'href' => Yii::$app->request->baseUrl . "/product/category-list"],
                                     
                                   ],
                                ],
                                [   'label' => 'Order',
                                    'href' => '#',
                                    'items' => [
                                        ['label' => 'Daftar Order', 'href' => Yii::$app->request->baseUrl . "/order/list"],
                                        ['label' => 'Tambah Order', 'href' => Yii::$app->request->baseUrl . "/order/create"],
                                        ['label' => 'Marketplace', 'href' => Yii::$app->request->baseUrl . '/order/marketplace-list'],
                                        ['label' => 'Courier', 'href' => Yii::$app->request->baseUrl . '/order/courier-list']

                                    ]
                                ],
                                [   'label' => 'Inventory',
                                    'href' => '#',
                                    'items' => [
                                        ['label' => 'Restock barang', 'href' => Yii::$app->request->baseUrl . "/inventory/restock-list"],
                                        ['label' => 'Supplier', 'href' => Yii::$app->request->baseUrl . "/supplier/list"],
                                        ['label' => 'Penyesuaian Stok', 'href' => Yii::$app->request->baseUrl . "/inventory/adjustment-list"],
             
                                    ]
                                ],
                                [   
                                    'label' => 'Laporan',
                                    'href' => '#',
                                    'items' => [
                                        ['label' => 'Laporan Umum', 'href' => Yii::$app->request->baseUrl . "/report/index"]
                                    ]
                                ],    
                                [   
                                    'label' => 'Pengaturan',
                                    'href' => '#',
                                    'items' => [
                                    ]
                                ],    
                                [   
                                    'label' => 'Pengguna',
                                    'href' => '#',
                                    'items' => [
                                        ['label' => 'Access Control', 'href' => Yii::$app->request->baseUrl . '/ac/index'],
                                        ['label' => 'Karyawan', 'href' => Yii::$app->request->baseUrl . "/employee/list"],
                                        ['label' => 'Reseller', 'href' => Yii::$app->request->baseUrl . "/reseller/list"]
                                    ]
                                ],
                                [
                                    'label' => 'Berita',
                                    'href' => '#',
                                    'items' => [
                                        ['label' => 'Buat Berita', 'href' => Yii::$app->request->baseUrl . '/news/create']
                                    ]
                                ]
                                
                            ]
                        ]) ?>
                </div>
           </div>
            <div class="right-section clearfix">
                <?= $content ?>
            </div>
        </div>
    <?php } else { ?>
        <?= $content ?>
    <?php } ?>
<?php $this->endBody() ?>
<script>
require(["project/init"], function() {
});
</script>
<input id="base-url" type="hidden" value="<?= Yii::$app->request->baseUrl ?>">
</body>
</html>
<?php $this->endPage() ?>
