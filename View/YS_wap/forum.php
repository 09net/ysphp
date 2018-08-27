<div class="ys-canvas-left" style="overflow: hidden;"><div id="iframe-forum-box"><div id="iframe-forum-top" class="c">
<div>
{if !IS_LOGIN}
<a href="/"><img src="{#bucketcdn}logo/favicon.png" width="80" height="80" class="img-circle btn-group"></a>
<div class="btn-group">
<a href="/user/login" rgb="#f1f4f9" class="btn btn-sblue btn-xs">{lag 登录}</a>
<a href="/user/add" rgb="#f1f4f9" class="btn btn-xs">{lag 注册}</a>
</div>
 {else}
 <img src="{#bucketcdn}{$user.avatar}" width="100" height="100" class="img-circle btn-group">
 <div class="info-list">
  <span>{lag 关注} <i>{$user.follow}</i></span>
  <span>{lag 粉丝} <i>{$user.fans}</i></span>
  <span>{lag 金币} <i>{$user.gold}</i></span>
 </div>
 <div class="btn-group" style="margin-top:10px">
  <a href="/u/<?php echo urlencode($user['user']);?>" class="btn btn-warning btn-xs">{lag 空间}</a>
  <a href="javascript:void(0);" class="btn btn-danger btn-xs" onclick="tog_friend_box()">{lag 好友}</a>
    <a href="/user/out" class="btn btn-warning btn-xs">{lag 退出}</a>
 </div>
 {/if}
 </div>
</div><div class="ys-list iframe_forum" style="overflow-y: auto; height:300px;"><div>
<a href="/f.html"> 
<img src="{#bucketcdn}logo/favicon.png" width="20" height="20" style="margin-right:10px">
<span class="title">{lag 栏目大全}</span>
<span class="fa fa-chevron-right"></span>
</a>
{foreach $forum as $key => $v}
<a href="/f/{$v['id']}.html" {if isset($fid)}{if $fid==$v['id']}class="active"{/if}{/if}> 
<img src="{#bucketcdn}{$v['img']}" width="20" height="20" style="margin-right:10px">
<span class="title">{$v.name}</span>
<span class="fa fa-chevron-right"></span>
</a>
{/foreach}
</div></div>
</div></div>