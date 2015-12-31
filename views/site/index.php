<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = Yii::t('app','Chuyện tôi kể');
//$this->paralg['breadcrumbs'][] = $this->title;
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<div class="row site-index">
    <?php 
    if(isset($_GET['baiviet'])){
        $id=$_GET['baiviet'];
    ?>
        <div class="col-lg-8 ">
            <div class="noidung"> 
                <div class="row modau">
                    
                    <h1 class="text-center tieude-chinh">
                        <?=$baiviet['title']?>
                    </h1>
                    <div class="tomtat">
                        <?=$baiviet['description']?>
                    </div>
                     <img src="../uploads/<?=$baiviet['img']?>" class="anhchinh">
                </div>
                
                <div class="noidung-chinh">
                    
                    <p >
                        <?=$baiviet['body']?>
                    </p>
                    
                    <iframe
                        src="//www.facebook.com/plugins/like?href=<?=urlencode($actual_link)?>%2F&amp;kid_directed_site=true"
                        scrolling="no"
                        frameborder="0"
                        style="border:none; overflow:auto; width:450px; height:30px"
                        allowTransparency="true">
                    </iframe>
                    <div 
                        class="fb-share-button" 
                         data-href="<?=$actual_link?>" 
                         data-layout="button_count"
                         >
                    </div>
                    <div class="fb-follow" 
                         data-href="https://www.facebook.com/chuyentoikevetoi/" 
                         data-layout="standard" 
                         data-show-faces="true">
                        
                    </div>
                    
                    <div 
                        class="fb-comments" 
                        data-href="<?=$actual_link?>" 
                        data-numposts="5"
                        width="100%"
                        data-order-by="reverse_time"
                    >
                       
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="bantin">
                <?php
                    function myUrlEncode($string) {
                        $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23');
                        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#");
                        return str_replace($entities, $replacements, urlencode($string));
                    }
                ?>
                
                <?php if(isset($_GET['baiviet'])){
                ?>
                <div class="row tin-dau">
                    <div class="col-sm-4">
                        <img src="../uploads/<?=$baiviet['img']?>" class="anhminhhoa">
                    </div>
                    <div class="col-sm-8 ">
                        <p class="tieude-tin">
                        <?=$baiviet['title']?>
                        </p>
                        <p class="thoigian">
                        <?= gmdate("d-m-Y H:i:s",$baiviet['time_new'])?>
                        </p>
                        <?php
                            if(Yii::$app->user->can('permission_monitor')){
                        ?>
                        <a href="/book/update.html?id=<?=$baiviet['id']?>">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <?php
                        }?>
                    </div>
                    
                </div>
                <?php
                }?>
                
                <hr>
                <?php
                foreach ($models as $model) {
                    if($id!=$model['id']){
                ?>
                    <a href="<?=$model->getlinkurl()?>">
                        <div class="row tin">
                            <div class="col-sm-4">
                                <img src="../uploads/<?=$model['img']?>" class="anhminhhoa">
                            </div>
                            <div class="col-sm-8">
                                <p class="tieude-tin"><?=$model['title']?></p>
                                <p class="thoigian"><?=gmdate("d-m-Y H:i:s", $model['time_new'])?></p>
                            </div>
                        </div>
                    </a>
                <?php
                    }
                }
                // display pagination
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
        </div>
    <?php
    }else if(isset($_GET['BookSearch'])){
    ?>
    <div class="trangchu" id="trangchu"> 
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout'=>"{summary}\n{items}\n{pager}",
            'tableOptions' =>['class' => 'table'],
            'columns' => [
                [
                    'value' => function($data) {
                        $url = $data->linkurl;
                        return Html::a(Html::img($data->imageurl,['width'=>200,'height'=>110]),
                                $url, ['title' => 'Xem bài viết'] );
                    },
                    'format' => 'raw',
                    'contentOptions'=>['style'=>'width: 220px;'], 
                ],
                [
                    'format'=>'raw',
                    'value' => function($data){
                        $url = $data->linkurl;
                        return Html::a(
                                '<p class="tieude-tin-trangchu">'.$data->title.'</p>'.
                                '<p class="thoigian">'.
                                gmdate("d-m-Y H:i:s", $data->time_new).
                                '</p>',
                                $url, ['title' => 'Xem bài viết']
                                ); 
                    },
                    'contentOptions'=>['style'=>'text-align: left;'], 
                ],
            ],
        ]); ?>
    </div>
    <?php 
    }else {
    ?>
            <div class="trangchu" id="trangchu"> 
               <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout'=>"{items}\n{pager}",
                'tableOptions' =>['class' => 'table table-trangchu'],
                'columns' => [
                    [
                        'value' => function($data) {
                            $url = $data->linkurl;
                            return 
                                    Html::a(Html::img($data->imageurl,['width'=>160,'height'=>110]),
                                    $url, ['title' => 'Xem bài viết'] ).
                                    Html::a(
                                    '<p class="tieude-tin-trangchu">'.$data->title.'</p>'.
                                    '<p class="thoigian">'.
                                    gmdate("d-m-Y H:i:s", $data->time_new).
                                    '</p>',
                                    $url, ['title' => 'Xem bài viết']
                                    );
                            },
                        'format' => 'raw',
                        'contentOptions'=>['style'=>'width: 160px;'], 
                    ],
                ],
            ]); ?>
    <?php
        }?>
</div>
