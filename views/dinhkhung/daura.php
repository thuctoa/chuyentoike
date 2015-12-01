<div class="fullscreen text-right">
    <span
        title="<?=Yii::t('app','Phóng to')?>"
        class="glyphicon glyphicon-resize-full phongto" data-toggle="modal" data-target="#fulldaura" data-local="#daura">  
    </span>
</div>
<div id ="khung_daura" onscroll="borderbottom('khung_daura')">
    <div id="daura">
    </div>
    <div class="modal fade" id="fulldaura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" >
        <div class="modal-content" >
          <div class="modal-header">
                <span title="<?=Yii::t('app','Thu nhỏ')?>" data-dismiss="modal" aria-hidden="true" class="glyphicon glyphicon-resize-small thunho"></span>
          </div>
          <div class="modal-body" id="body_daura" onscroll="borderbottom('body_daura')">
            <p>One fine body…</p>
          </div>
<!--          <div class="modal-footer">
          </div>-->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<div id="khung_daura_duoi">
    <a href="#" title="<?=Yii::t('app','Lưu PDF')?>" >
        <span class="glyphicon glyphicon-floppy-save pull-right luupdf"></span>
    </a>
</div>
