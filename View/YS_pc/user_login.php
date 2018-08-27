{include h}
<div class="container">
 <div id="main">
 <div class="wrap-box">
 <h1>{lag 用户登录}</h1>
 <div class="head c"><img id="img" src="{#icdn}public/img/user.png" alt="{lag 头像}" class="circle js-info" width="50" height="50"/></div>
 <form id="form">
 <label for="user" style="margin-top:0">{lag 账户}</label>
 <input type="text" id="user" name="user" class="input-text" value=""/>
 <label for="pass" style="margin-top:0">{lag 密码}</label>
 <input type="password" id="pass" name="pass" value="" class="input-text"/>
 <div class="submit">
 <input id="login" type="submit" value="{lag 登录}" class="btn btn-primary">
 </div>
 <p><a href="/user/add" class="btn btn-success">{lag 注册}</a>&nbsp;<a href="/user/repass" class="btn btn-success">{lag 忘记密码}?</a></p>
 </form></div>
  <div class="wrap-box">

  </div>
 
 </div>{include r_m}</div>
<script>
$(function(){
$("#user").blur(function(){
 $.get("/ajax/useravatar",{user:$(this).val()},function(e){
 if(e.avatar){
 $("#img").attr('src','{#bucketcdn}'+e.avatar+'_150');
 }
 },'json');
 });
 $('#form').submit(function() {return false;});
 $("#login").click(function(){
 var postdata = $('#form').serialize();
 $.post("/user/login", postdata, function(e){
 if(e.code==200){
 if(e.url !='')
  window.location.href=e.url;
 else
  window.location.href="/";
 }else{
 swal(e.error ? "{lag 成功}" : "{lag 失败}", e.info, e.error ? "success" : "error");
 }
 },'json');
 })
});
</script>
</body>
</html>
