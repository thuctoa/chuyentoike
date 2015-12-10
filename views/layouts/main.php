<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrap">
        
        <?php
            NavBar::begin([
                'brandLabel' => Html::img('/img/logo-nav.png'),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top menu ',
                ],
                
            ]);
            $valsreach="";
            if(isset($_GET['BookSearch'])){
                $valsreach=$_GET['BookSearch']['title'];
            }
            echo '<form class="navbar-form navbar-left" role="search"  action="/" method="get" >
                    <div class="input-group stylish-input-group" id="timkiem">
                        <input 
                            type="text"
                            class="form-control" 
                            placeholder="Tìm kiếm bài viết ..."
                            name="BookSearch[title]"
                            value="'.$valsreach.'"
                        >
                        <span class="input-group-addon"">
                            <button type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>  
                        </span>
                    </div>
                </form>';
            $items = [
                   // ['label' => Yii::t('app','Trang chủ'), 'url' => ['/site/index']],
                    //['label' => Yii::t('app','Giới thiệu'), 'url' => ['/site/about']],
                    //['label' => Yii::t('app','Liên hệ'), 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => Yii::t('app','Đăng nhập'), 'url' => ['/site/login']] :
                        ['label' => Yii::t('app','Đăng xuất').' (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ];
            if ( Yii::$app->user->can('permission_monitor') ){
                $items[] = ['label' => Yii::t('app','Viết bài mới'), 'url' => ['/book/create']];
            }
            if ( Yii::$app->user->can('permission_admin') ){
                $items[] = ['label' => Yii::t('app','Phân quyền'), 'url' => ['/admin/assignment']];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $items,
            ]);
            
            
            NavBar::end();
        ?>
        <div class="content" id="content">
            <?php 
                echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]); 
            ?>
            <?= $content ?>
        </div>
        
    </div>
    <footer class="footer">
        <div class="container">
            <span id="chuyentoike">
                &copy; Chuyện tôi kể <?= date('Y') ?>
            </span>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
