<div class="thuattoan">
    <?php
    use app\controllers\BookController;
        if($loai){
            $model =BookController::findIsbn($loai);
            if(Yii::$app->user->can('permission_monitor')){
            ?>
            <a href="/book/update?id=<?=$model->id?>" 
                class="pull-right"
                title="Update" aria-label="Update" data-pjax="0">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <?php }?>
            <strong><p><?=$model->title?></p></strong>
            <div ><?=$model->description?></div>  
    <?php
        }
    ?>
</div>