{include h}
 {php $i=0;$pagetime=0;}
<div class="container">
<div id="main">
{include user_menus}

<div class="wrap-box">
 {if NOW_UID==$data['id']} <form class="form-horizontal" action="/user/edit" method="post">{/if}
 <input type="hidden" name="gn" value="ps">
 <div class="page-header">
 <h3 id="info">{lag 修改资料} <small></small></h3>
 </div>
 
 <div class="row">
 <label for="display_name" class="col-xs-3 c">{lag 个性签名}</label>
 <div class="col-xs-9">
 <input class="input-text" type="text" name="ps" value="{$data.ps}"/>
 <span>{lag 最大支持40个字符}</span>
 </div>
 </div>
   {if NOW_UID==$data['id']}<div class="row"><div class="col-xs-offset-3 col-xs-9"><button type="submit" class="btn btn-success">{lag 保存}</button></div></div>{/if}
  {if NOW_UID==$data['id']}</form>{/if}
  {if NOW_UID==$data['id']}<form class="form-horizontal" action="/user/ava" method="post" enctype="multipart/form-data">{/if}
 <div class="page-header">
 <h3 id="info">{lag 修改头像} <small></small></h3>
 </div>
 <div class="row">
 <label class="col-xs-3 c">{lag 头像}</label>
 <div class="col-xs-9">
 <div class="radio">
 <img style="display:block" src="{#bucketcdn}{$data.avatar}" class="avatar avatar-80" height="80" width="80"><label>


 </div>

 </div>
 </div>
 <div class="row">
 <label for="display_name" class="col-xs-3 c">{lag 选择图片}</label>
 <div class="col-xs-9">
 <input class="" type="file" name="photo" />
 </div>
 </div>
 {if NOW_UID==$data['id']}<div class="row"><div class="col-xs-offset-3 col-xs-9"><button type="submit" class="btn btn-success">{lag 保存}</button></div></div>{/if}
  {if NOW_UID==$data['id']}</form>{/if}
 {if NOW_UID==$data['id']}<form action="/user/edit" class="form-horizontal" role="form" method="post">{/if}
 <input type="hidden" name="gn" value="pass">
 <div class="page-header">
 <h3>{lag 账号安全} <small>{lag 修改登陆密码}</small></h3>
 </div>
 <div class="row">
 <label class="col-xs-3 c">{lag 旧密码}</label>
 <div class="col-xs-9">
 <input type="password" class="form-control" name="pass0">
 <span class="help-block">{lag 请输入当前用户所使用的密码}</span>
 </div>
 </div>
 <div class="row">
 <label class="col-xs-3 c">{lag 新密码}</label>
 <div class="col-xs-9">
 <input type="password" class="form-control" name="pass1">
 <span class="help-block">{lag 字母与数字}</span>
 </div>
 </div>
 <div class="row">
 <label class="col-xs-3 c">{lag 确认密码}</label>
 <div class="col-xs-9">
 <input type="password" class="form-control" name="pass2">
 <span class="help-block">{lag 字母与数字}</span>
 </div>
 </div>
 {if NOW_UID==$data['id']}<div class="row"><div class="col-xs-offset-3 col-xs-9"><button type="submit" class="btn btn-success">{lag 保存}</button></div></div>{/if}
  {if NOW_UID==$data['id']}</form>{/if}
</div>
</div>{include r_m_user}</div>{include f}