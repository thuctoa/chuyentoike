<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\User;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\PasswordResetRequestForm */

$this->title = 'Yêu cầu thay đổi mật khẩu';
$this->params['breadcrumbs'][] = $this->title;
if( !Yii::$app->user->isGuest){
    $sql = 'SELECT * FROM user where id ='.Yii::$app->user->id;

    $user = User::findBySql($sql)->all();  
    $model->email=$user[0]['email'];
}
?>
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Bạn hãy cho chúng tôi biết địa chỉ Email của bạn, để thay đổi mật khẩu của bạn.</p>
    <div class="thaydoimatkhau">
        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'email') ?>
            <div class="form-group">
                <?= Html::submitButton('Gửi yêu cầu', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
