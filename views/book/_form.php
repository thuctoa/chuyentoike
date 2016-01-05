<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); 

    ?>
    
    <?php
        
        if ( Yii::$app->user->can('permission_monitor') 
            ||  Yii::$app->user->can('permission_admin')){
            if ( Yii::$app->user->can('permission_admin')) {
                echo $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->select(['username','id'])->all(), 'id', 'username'),['class' => 'form-control inline-block']); 
            }else{
                echo $form->field($model, 'user_id')->textInput(['value'=>\Yii::$app->user->id,'type'=>'hidden'])->label(FALSE);
            }
            echo $form->field($model, 'isbn')->dropDownList(['0' => 'NO', '1' => 'YES']);

        }
        else {
            echo $form->field($model, 'isbn')->textInput(['maxlength' => 32,'type'=>'hidden'])->label(FALSE);
            echo $form->field($model, 'user_id')->textInput(['value'=>\Yii::$app->user->id,'type'=>'hidden'])->label(FALSE);
        }
    ?>
    
    <?= $form->field($model, 'title')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'advanced'
    ]) ?>
    <?php
        if($model->img){
    ?>
            <img src="../uploads/<?=$model->img?>" width="20%">
    <?php
        }
    ?>
    <?= $form->field($model, 'img')->fileInput() ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'advanced'
    ]) ?>
    <?= $form->field($model, 'body')->widget(CKEditor::className(), [
            'options' => ['rows' => 12],
            'preset' => 'advanced'
    ]) ?>
    
    
    
    <?= $form->field($model, 'time_new')->textInput(['value'=>time(),'type'=>'hidden'])->label(FALSE) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
