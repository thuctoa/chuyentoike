<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Book;
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
    <meta property="fb:app_id"          content="582889218543377" /> 
    <?php
        if(isset($_GET['baiviet'])){
            $baiviet=  Book::findOne($_GET['baiviet']);
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
        <meta property="og:title"         content="<?=$baiviet['title']?>" />
        <meta property="og:url"           content="<?=$actual_link?>" />
	<meta property="og:type"          content="website" />
	<meta property="og:image"         content="http://www.chuyentoike.com/uploads/<?=$baiviet['img']?>" />
    <?php
        }
    ?>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    
    <div id="fb-root"></div>
<script>
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=582889218543377";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-71915364-1', 'auto');
    ga('send', 'pageview');

    var chieurongbandau = 700;
    window.onresize = displayWindowSize;
    window.onload = displayWindowSize;

    function displayWindowSize() {
        myWidth = window.innerWidth;
        myHeight = window.innerHeight;
        // your size calculation code here

        document.getElementById("timkiem").style.cssText = "width: "+(myWidth-chieurongbandau)+'px;';

    };
    
</script>

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
                    Yii::$app->user->isGuest ?
                        ['label' => Yii::t('app','Tạo tài khoản'), 'url' => ['/site/signup']] :
                        [
                            'label' => Yii::t('app','Thông tin cá nhân'),
                                'items' => [
                                    ['label' => Yii::t('app','Xem hồ sơ'),'url'=>['/site/user']],
                                    '<li class="divider"></li>',
                                    '<li class="dropdown-header">Bút danh, Email, số điện thoại</li>',
                                    ['label' => Yii::t('app','Đổi thông tin'), 'url' => '/site/update-user.html'],
                                    ['label' => Yii::t('app','Đổi mật khẩu'),'url'=>['/site/request-password-reset']],
                                ],
                            
                        ], 
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
                &copy; <?= \Yii::$app->name.' '.date('Y') ?>
            </span>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
