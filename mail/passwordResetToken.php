<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>

Xin chào <?= Html::encode($user->username) ?>,

Bạn hãy truy cập vào đường dẫn này để tạo mật khẩu cho bạn:

<?= Html::a(Html::encode($resetLink), $resetLink) ?>
