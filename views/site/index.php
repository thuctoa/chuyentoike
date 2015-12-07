<?php
$this->title = Yii::t('app','Chuyện tôi kể');
//$this->paralg['breadcrumbs'][] = $this->title;
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-8 ">
            <div class="noidung">
                <?php 
                $id = '';
                if(isset($_GET['baiviet'])){
                     $id=$_GET['baiviet'];
                     foreach ($books as $book){
                         if($id==$book['id']){
                             echo '<h1 class="tieude-noidung">'.$book['title'].'</h1>';
                             echo '<div class="body-noidung" >'.current($books)['description'].'</div>';
                             break;
                         }

                     }
                }
                else{
                    echo '<h1 class="tieude-noidung" >'.current($books)['title'].'</h1>';
                    echo '<div class="body-noidung" >'.current($books)['description'].'</div>';
                }
                ?>
                <!--nutlike-->
                <div
                    class="fb-like"
                    data-share="true"
                    data-width="450"
                    data-show-faces="true">
                </div>
                
                <!--box binh luan--> 
                <div id="fb-root"></div>
                <script>
                    (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=1502054410090394";
                        fjs.parentNode.insertBefore(js, fjs);
                      }(document, 'script', 'facebook-jssdk'));
                </script>
                <div class="fb-comments" 
                     data-href="<?=$actual_link?>" 
                     data-width="600" 
                     data-order-by="social"
                     data-numposts="100">
                </div>
                
<!--                like page
                <div id="fb-root"></div>
                <script>
                    (function(d, s, id) {  
                        var js, fjs = d.getElementsByTagName(s)[0];  
                        if (d.getElementById(id)) return;  
                        js = d.createElement(s); js.id = id;  
                        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3";  
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
                <div class="fb-post" 
                     data-href="https://www.facebook.com/chuyentoikevetoi/posts/134998843532792" 
                     data-width="600"><div class="fb-xfbml-parse-ignore">
                        <blockquote 
                            cite="https://www.facebook.com/chuyentoikevetoi/posts/134998843532792">
                            <p>Chuy&#x1ec7;n t&#xf4;i k&#x1ec3;</p>Posted by 
                            <a href="https://www.facebook.com/chuyentoikevetoi/">
                                Chuyện tôi kể
                            </a> on&nbsp;
                            <a href="https://www.facebook.com/chuyentoikevetoi/posts/134998843532792">
                                1 Tháng 12 2015
                            </a>
                        </blockquote>
                    </div>
                </div>-->
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="tintuc">
                <img src="../img/G1.jpg" class=" anhdau">
                <?php 
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $mauchu=['#f05','#0a0','#007197','#ff6b00'];
                if($id==''){
                    reset($books);
                    $id=key($books);
                }
                if($id!=''){
                ?>
                <div class="row tincuthe-dau">
                    <a href="?baiviet=<?=$id?>">
                        <div class="col-lg-4">
                            <img src="../uploads/<?=$books[$id]['img']?>" class="anhminhhoa">
                        </div>
                        <div class="col-lg-8" >
                            <p class="tieude-tin">
                                <?php
                                    echo $books[$id]['title'];
                                ?>
                            </p>
                            <p class="thoigian-tin">
                                <?php
                                    echo date('m-d-Y H:m:s', $books[$id]['time_new']);
                                ?>
                            </p>
                           
                        </div>
                    </a>
                </div>
                <?php
                        if(Yii::$app->user->can('permission_monitor')){
                ?>
                        <a href="/book/update.html?id=<?=$id?>" 
                            class="pull-right"
                            title="Update" aria-label="Update" data-pjax="0">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                <?php
                    }
                ?>
                <hr>
               
                
                <?php
                }
                $i=0;
                foreach ($books as $key=>$book){
                    if($i>10){
                        break;
                    }
                    if($key!=$id){
                ?>
                    <div class="row tincuthe">
                        <a href="?baiviet=<?=$book['id']?>">
                            <div class="col-lg-4">
                                <img src="../uploads/<?=$book['img']?>" class="anhminhhoa">
                            </div>
                            <div class="col-lg-8" >
                                <p class="tieude-tin">
                                    <?php
                                        echo $book['title'];
                                    ?>
                                </p>
                                <p class="thoigian-tin">
                                    <?php
                                        echo date('m-d-Y H:m:s', $book['time_new']);
                                    ?>
                                </p>
                            </div>
                            
                        </a>
                        <?php
                            if(Yii::$app->user->can('permission_monitor')){
                        ?>
                        <a href="/book/update.html?id=<?=$book['id']?>" 
                            class="pull-right"
                            title="Update" aria-label="Update" data-pjax="0">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <?php
                            }
                        ?>
                    </div>
                    
                <?php
                    }
                    $i++;
                }
                ?>
                
            </div>
        </div>
    </div>
</div>
