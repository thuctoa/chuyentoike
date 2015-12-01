<div class="fullscreen text-right">
    <span 
        title="<?=Yii::t('app','Phóng to')?>"
        class="glyphicon glyphicon-resize-full phongto" data-toggle="modal" data-target="#fulldauvao" data-local="#dauvao">  
    </span>
</div>
<div id ="khung_dauvao" onscroll="borderbottom('khung_dauvao')">
    <div id="dauvao" >
    
    </div>
    
    <div class="modal fade" id="fulldauvao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" >
        <div class="modal-content" >
          <div class="modal-header">
                <span title="<?=Yii::t('app','Thu nhỏ')?>" data-dismiss="modal" aria-hidden="true" class="glyphicon glyphicon-resize-small thunho"></span>
          </div>
            <div class="modal-body" id="body_dauvao" onscroll="borderbottom('body_dauvao')">
            <p>One fine body…</p>
          </div>
<!--          <div class="modal-footer">
          </div>-->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<div id="khung_dauvao_duoi">
    <button class="btn " id="khoi_tao" 
            onclick="giai_matran()">
        <?=Yii::t('app','Khởi tạo nạp các hệ số')?>
        <span class="glyphicon glyphicon-arrow-up"></span>
    </button>
    <button class="btn " id="nut_giai">
        <?=Yii::t('app','Giải')?>
        <span class="glyphicon glyphicon-share-alt "></span>
    </button>
</div>
