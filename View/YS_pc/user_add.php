{include h}
<div class="container"><div id="main"><div class="wrap-box"><h1>{lag 用户注册}</h1>
<form id="form">
<label for="user" style="margin-top:0">{lag 账户}</label>
<input type="text" name="user"  value="" class="input-text"/>
<label for="user" style="margin-top:0">{lag 邮箱}</label>
<input type="text" name="email" value="" class="input-text"/>
<label for="user" style="margin-top:0">{lag 密码}</label>
<input type="password" name="pass" value="" class="input-text"/>
<label for="user" style="margin-top:0">{lag 确认密码}</label>
<input type="password" name="pass2" value="" class="input-text" />
<label for="user" style="margin-top:0">{lag 邀请码}</label>
<input type="text" name="upuid" value="{if $upuid}{$upuid}{/if}" placeholder="{lag 邀请码}" class="input-text"/>
<div class="submit"><input id="login" type="submit" value="{lag 注册}" class="btn btn-primary"/></div>
<p><a href="/user/login" class="btn btn-success">{lag 已有账号登录}</a></p>
</form>
</div>
<div class="wrap-box">

  </div>
</div>{include r_m}</div>
<script>
$(function(){
 $('#form').submit(function() {return false;});
 $("#login").click(function(){
 var postdata = $('#form').serialize();
 $.post("/user/add", postdata, function(e){
 if(e.code==200){
 if(e.url !='') window.location.href=e.url; else window.location.href="/";
 }else{
 swal('{lag 失败}', e.info, 'error');
 }
 },'json');
 })
});
</script>
</body>
</html>
