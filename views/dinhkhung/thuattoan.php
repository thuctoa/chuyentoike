<div class="fullscreen text-right">
    <span 
        title="<?=Yii::t('app','Phóng to')?>"
        class="glyphicon glyphicon-resize-full phongto" data-toggle="modal" data-target="#fullthuattoan" data-local="#thuattoan">  
    </span>
</div>
<div id ="khung_thuattoan" onscroll="borderbottom('khung_thuattoan')">  
    <div id="thuattoan">
    </div>

    <div class="modal fade" id="fullthuattoan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" >
        <div class="modal-content" >
          <div class="modal-header">
            <span title="<?=Yii::t('app','Thu nhỏ')?>" data-dismiss="modal" aria-hidden="true" class="glyphicon glyphicon-resize-small thunho"></span>
          </div>
          <div class="modal-body" id="body_thuattoan" onscroll="borderbottom('body_thuattoan')">
            <p>One fine body…</p>
          </div>
<!--          <div class="modal-footer">
          </div>-->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<div id="khung_thuattoan_duoi">
    <a href="#" title="<?=Yii::t('app','Lưu PDF')?>" >
        <span class="glyphicon glyphicon-floppy-save pull-right luupdf"></span>
    </a>
</div>

