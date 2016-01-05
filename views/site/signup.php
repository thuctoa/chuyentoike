<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\SignupForm */

$this->title = 'Tạo tài khoản';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Yii::t("app", "Bạn hãy điền đầy đủ thông tin vào các mục dưới đây"
            . " để tạo tài khoản mới cho riêng mình"); ?></p>
    <div class="taotaikhoan">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <fieldset><legend><?= Yii::t('app', 'Thông tin của bạn')?></legend>
            <?= $form->field($model, 'displayname') ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        </fieldset>
            <div class="form-group">
                <?= Html::submitButton('Đăng ký', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
