{include h}
{include header}
<section class="body" id="user_add_body">
<div>
 <form id="user-add-form" method="post" onsubmit="return user_add()">
 <div class="ys-box" style="margin-top:20px">
 <div class="ys-input-box">
 <input type="text" name="user" placeholder="{lag 请输入用户名}">
 </div>
 <div class="ys-input-box">
 <input type="text" name="email" placeholder="{lag 请输入安全邮箱}">
 </div>
 <div class="ys-input-box">
 <input type="password" name="pass" placeholder="{lag 请输入密码}">
 </div>
 <div class="ys-input-box">
 <input type="password" name="pass2" placeholder="{lag 确认密码}">
 </div>
 </div>

 <div style="padding:10px; text-align: center;">
 <button type="submit" class="id-add btn btn-danger btn-block" style="padding: 8px 0;">{lag 注册}</button>
 <a href="/user/login" rgb="#f1f4f9" type="button" class="btn btn-link" style="color: #a2a2a2;">
 {lag 已有账号}
 </a>
 <div style="height:40px"></div>
 </div>
 </form>
</div>
</section>

<script>
function user_add(){
 var postdata = $('#user-add-form').serialize();

 $(".id-add").attr('disabled','disabled').text('正在注册中...');
 

 $.ajax({
 url:"/user/add",
 type:'post',
 data:postdata,
 dataType:'json',
 success:function(e){
 $(".id-add").removeAttr('disabled').text('{lag 注册}');
 if(e.code==200){
 if(e.url !='')
 window.location.href=e.url;
 else
 window.location.href="/";
 }else{
 $.hy.warning( e.info);
 }

 },error:function(e){
 $(".id-add").removeAttr('disabled').text('{lag 注册}');
 }
 }); 
 return false;
}
</script>
{include f}