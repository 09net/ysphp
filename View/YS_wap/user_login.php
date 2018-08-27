{include h}
{include header}
<section class="body" id="user_body">
<div>	  
    <form id="user-login-form" method="post" onsubmit="return user_login()">
        <div class="ys-box" style="margin-top:20px"> 
	    <div class="ys-input-box">
	        <input type="text" name="user" placeholder="{lag 请输入用户名}">
	    </div>
	    <div class="ys-input-box">
	        <input type="password" name="pass" placeholder="{lag 请输入密码}">
	    </div>
        </div>
    	<div style="padding:10px;    text-align: center;">
    		<button id="login" type="submit" class="id-login btn btn-danger btn-block" style="padding: 8px 0;">{lag 登录}</button>
    		<a href="/user/add"   rgb="#f1f4f9"  type="button" class="btn btn-link" style="color: #a2a2a2;">
                {lag 注册新账号}
            </a>
            <a href="/user/repass"   rgb="#f1f4f9" type="button" class="btn btn-link" style="color: #a2a2a2;">{lag 忘记密码}?</a>
            
        <div style="height:40px"></div>
    	</div>
    </form>
</div>
</section>
<script>
function user_login(){
    var postdata = $('#user-login-form').serialize();
    $(".id-login").attr('disabled','disabled').text('{lag 登录中}');
    $.ajax({
        url:"/user/login",
        type:'post',
        data:postdata,
        dataType:'json',
        success:function(e){
            $(".id-login").removeAttr('disabled').text('{lag 登录}');
  if(e.code==200){
 if(e.url !='')
                    window.location.href=e.url;
                else
                    window.location.href="/";
            }else{
                $.hy.warning(e.info);
            }
        },
        error:function(e){
            $(".id-login").removeAttr('disabled').text('{lag 登录}');
        }
    });
    return false;
}
</script>
{include f}