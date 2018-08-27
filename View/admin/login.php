{include header}
<div class="modal fade lock-screen-wrapper" id="lockScreen">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-body">
 <div class="lock-screen-img">
  <img src="{#bucketcdn}{$user['avatar']}">
 </div>
 <div class="text-center m-top-sm">
  <div class="h4 text-white">{$user.user}</div>
  {if isset($info)}<b style="color:#FF0000">{$info}</b>{/if}
   <form action="/admin/login" method="POST">
  <div class="input-group m-top-sm">
  <span class="input-group-btn">
   
   <a class="btn btn-info" href="/"><i class="fa fa-home"></i> </a>
  </span>
  <input type="password" name="pass" class="form-control text-sm" placeholder="{lag 密码}">
  <span class="input-group-btn">
   <button class="btn btn-success">
   <i class="fa fa-arrow-right"></i>
   </button>
  </span>
  </div>
   </form>
 </div>
 </div>
 </div>
 </div>
</div>
{include footer}
