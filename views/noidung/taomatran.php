<div id="taomatran">
<?php
    if($loai>0){
?>
    <h4 class="text-center">
        <?=Yii::t('app','Nhập vào các hệ số $a_{ij}$ của ma trận')?>
    </h4>
    <hr>
    <div style="width: <?=$n*69?>px; margin: 0 auto;">
<?php
        for($i=0;$i<$m;$i++){
            for($j=0;$j<$n;$j++){
?>
        <div 
            class="form-group taomatran_input" 
            onclick="document.getElementById('input<?=$i.$j?>').focus();"
            onkeypress ="document.getElementById('label<?=$i.$j?>') .style.visibility = 'hidden';"
        >
            <label id="label<?=$i.$j?>" >$a_{<?=$i.$j?>}..$  </label>
            <input 
                id="input<?=$i.$j?>"
                type="text" class="form-control"  aria-describedby="basic-addon1">
        </div>
<?php
            }
?>
                 <br>
<?php
        }
?>
    </div>
<?php
    }
?>
</div>
    