$('.menudoc').css('display', 'none');
function menudoc(){
    var menudoc=document.getElementById('menudoc');
    var content=document.getElementById('content');
    var trangchu=document.getElementById('trangchu');
    if(menudoc.style.display!="none"){
        content.style.width="100%";
        menudoc.style.display="none";
        content.style.margin ="0 auto";
        content.style.float="none";
        if(trangchu){
            trangchu.style.width="82%";
        }
        $('.tieude-tin').css('margin-left', 0 + 'px');
        $('.thoigian').css('margin-left', 0 + 'px');
        
    }else{
        content.style.width="82%";
        menudoc.style.display="block";
        content.style.float="right";
        if(trangchu){
            trangchu.style.margin ="0 auto";
            trangchu.style.width="95%";
        }
        $('.tieude-tin').css('margin-left', 15 + 'px');
        $('.thoigian').css('margin-left', 15 + 'px');
    }
}
