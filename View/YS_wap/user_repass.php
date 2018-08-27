{include h}
{include header}
<section class="body" id="user_repass_body">
<div>
	<form id="user-repass-form" method="post" onsubmit="return user_repass()">
		<div class="ys-box" style="margin-top:20px">
		    <div class="ys-input-box">
		        <input type="text" id="email" name="email" placeholder="{lag 你注册账号所填的邮箱}">
		    </div>
		    <div class="ys-input-box">
			<a class="btn btn-success" onclick="send_code(this)" href="javascript:void(0)" style="color: ;">{lag 点击获取验证码}</a>
			</div>
		    <div class="ys-input-box">
		        <input type="text" id="code" name="code" placeholder="{lag 你邮箱接收到的验证码}">
		    </div>
		    <div class="ys-input-box">
		        <input type="password" name="pass1" placeholder="{lag 更改密码}">
		    </div>
		    <div class="ys-input-box">
		        <input type="password" name="pass2" placeholder="{lag 确认密码}">
		    </div>
		</div>
		<div style="padding:10px;    text-align: center;">
			<button id="repass" type="submit" class="btn btn-danger btn-block" style="padding: 8px 0;">{lag 修改密码提交}</button>
			<a href="/user/login"  rgb="#f1f4f9" type="button" class="btn btn-link" style="color: #a2a2a2;">
	                    {lag 返回登录}
	        </a>
	        
		</div>
		<div style="height:40px"></div>
	</form>
</div>
</section>
<script>
var send_b = false;
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
			swal("{lag 发送成功}","{lag 请到你的}"+$("#email").val()+"{lag 找回密码提示语}",'success');
		}else{
			swal('{lag 发送失败}',e.info,'error');
		}
	}, function() {
	 swal("{lag 发送失败}",'{lag 服务器繁忙}');
	});
    
}
function user_repass(){
	var postdata = $('#user-repass-form').serialize();
    $.post("/user/recode2", postdata,  function(e){
 if(e.code==200){
            swal("{lag 修改成功}","{lag 密码修改成功提示}",'success');
        }else{
        	swal("{lag 修改失败}", e.info, "error");
        }
    },'json');
	return false;
}
</script>
{include f}