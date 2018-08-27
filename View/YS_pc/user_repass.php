{include h}
<div class="container">
 <div id="main">
 <div class="wrap-box">
<h1 style="padding-top:30px">{lag 忘记密码}</h1>
 <form id="form">
 <label for="email">{lag 邮箱}</label>
 <input type="text" id="email" name="email" class="hy-text" value="" placeholder="{lag 注册所填邮箱}"/>
 <label for="code">{lag 邮箱验证码} <small><a onClick="send_code(this)" href="javascript:void(0)" class="btn btn-danger">{lag 获取验证码}</a></small></label>
 <input type="text" id="code" name="code" class="hy-text" value="" placeholder="{lag 邮箱验证码}"/>
 <label for="pass">{lag 新密码}</label>
 <input type="password" name="pass1" value="" class="hy-text"/>
 <label for="pass">{lag 确认密码}</label>
 <input type="password" name="pass2" value="" class="hy-text"/>
 <div class="submit">
 <input id="repass" type="submit" value="{lag 提交}" class="btn btn-primary"/>
 </div>
 <p><a href="/user/login"  class="btn btn-success">{lag 返回登录}</a></p>
 </form></div></div>{include r_m}</div><script>var send_b = false;
function send_code(obj){
 var _this = $(obj);
 $.ajax({
 url: '/user/recode',
 type:"POST",
 cache: false,
 data:{
 email:$("#email").val(),
 },
 dataType: 'json'
 }).then(function(e) {
 if(e.code==200){
 swal("{lag 发送成功}","{lag 请到你的}"+$("#email").val()+"{lag 查看验证码},{lag 可能垃圾邮件}",'success');
 }else{
 swal('{lag 发送失败}',e.info,'error');
 }
 }, function() {
 swal("{lag 发送失败}",'{lag 服务器繁忙}');
 });
 
}
$(function(){
 $('#form').submit(function() {return false;});
 $("#repass").click(function(){
 var postdata = $('#form').serialize();
 $.post("/user/recode2", postdata, function(e){
 if(e.code==200){
 swal("{lag 修改成功}","{lag 密码修改成功}",'success');
 }else{
 swal("{lag 修改失败}", e.info, "error");
 }
 },'json');
 })
});
</script>
</body>
</html>
