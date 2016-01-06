<div class="thaydoithongtin">
    <div class="thaydoithongtinform">
    <form action="/site/update-user.html" method="post">
        <label class="control-label" >Bút danh </label> 
        <input  class="form-control" type="text" name="user[displayname]" value="<?=$model['displayname']?>"><br>
        <label class="control-label" > Số điện thoại </label> 
        <input class="form-control" type="text" name="user[phone]" value="<?=$model['phone']?>"><br>
        <label class="control-label" >Địa chỉ Email </label>  
        <input class="form-control" type="email" name="user[email]" value="<?=$model['email']?>"><br>
        <button type="submit" class="btn btn-primary">Thực hiện thay đổi</button>
    </form>
    </div>
</div>