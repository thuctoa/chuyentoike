<?php
use yii\helpers\Html;
use yii\grid\GridView; 
$this->title = Yii::t('app','Chuyện tôi kể');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-9 ">
            <div class="noidung">
                <?php 
                 if(isset($_GET['baiviet'])){
                     $id=$_GET['baiviet'];
                     foreach ($books as $book){
                         if($id==$book['id']){
                             echo '<h1>'.$book['title'].'</h1>';
                             echo $book['description'];
                             break;
                         }

                     }
                 }
                 else{
                     echo '<h1>'.current($books)['title'].'</h1>';
                     echo current($books)['description'];
                 }
                 ?>
            </div>
        </div>
        <div class="col-lg-3 ">
            <div class="tintuc">
                <?php 
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $mauchu=['#f05','#0a0','#007197','#ff6b00'];
                foreach ($books as $key=>$book){
                ?>
                    <div class="row">
                        <a href="?baiviet=<?=$book['id']?>">
                        <div class="col-lg-7" style="color: <?=$mauchu[$key%4]?>;margin-top: 10px;">
                            <p>
                                <?php
                                    echo $book['title'];
                                ?>
                            </p>
                        </div>
                        <div class="col-lg-5">
                            <img src="../uploads/<?=$book['img']?>" width="100%" height="70px;">
                        </div>
                       
                        </a>
                        <?php
                            if(Yii::$app->user->can('permission_monitor')){
                        ?>
                        <a href="/book/update?id=<?=$book['id']?>" 
                            class="pull-right"
                            title="Update" aria-label="Update" data-pjax="0">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <?php }?>
                    </div>
                    <p style="color: #aaaaaa; margin: 10px 0 20px 0;">
                            <?php
                                echo date('m-d-Y H:m:s', $book['time_new']);
                            ?>
                    </p>
                    <hr>
                <?php
                }
                ?>
                
            </div>
        </div>
    </div>
</div>
