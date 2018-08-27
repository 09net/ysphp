{if IS_LOGIN}<div class="friend-box"><audio id="play-msg"><source src="{#icdn}public/mp3/msg.mp3" type="audio/mp3"></audio><audio id="play-system"><source src="{#icdn}public/mp3/system.mp3" type="audio/mp3"></audio>
<div class="friend-box-close" onclick="$('.friend-box').toggleClass('friend-box-a')">×</div><div class="friend-info-box"><img src="{#bucketcdn}{$user.avatar}_50"><h2>{$user['user']}</h2>
<p><span class="badge badge-purple bounceIn animation-delay2" style="font-size: 14px;font-weight: 400;background: cadetblue;">{$user['grouptext']}</span></p>
<p><a href="/u/<?php echo urlencode($user['user']);?>.html">{lag 个人中心}</a><span>|</span><a href="/user/out">{lag 退出}</a></p>
<p><a href="javascript:void(0);" onclick="clear_mess()">{lag 清空未读}</a></p></div>
<script>{if IS_LOGIN}
window.YS_user = "{$user['user']}";
window.YS_avatar ="{#bucketcdn}{$user.avatar}";{else}window.YS_user = '';
window.YS_avatar = '';
{/if}$(function(){
load_friend();
})</script><div class="friend-div-box"><input type="text" class="friend-text" placeholder="{lag 搜索}">
<img src="{#icdn}public/img/cog.png" style="padding-top: 7px;padding-left: 7px;font-size: 18px;display: inline-block;"></span></div><div class="friend-title">{lag 关注列表} +</div>
<div class="friend-div-box">
<ul class="friend-ul" id="friend-1">
<li><a onclick="new_chat('title','ssss',444,465,0,'{lag 系统}','{#icdn}public/img/bell.png','{lag 信息}')" class="clearfix">
<img src="{#icdn}public/img/bell.png" class="img-circle" alt="user avatar">
<div class="chat-detail m-left-sm">
<div class="chat-name">{lag 系统}</div>
<div class="chat-message">{lag 消息}</div>
</div>
<div class="chat-status"><span class="friend-zx"></span></div>
<div class="chat-alert"><span id="friend-span-0" class="badge badge-purple bounceIn animation-delay2 friend-hide">0</span></div></a></li></ul></div>
<div class="friend-title">{lag 粉丝} +</div>
<div class="friend-div-box"><ul class="friend-ul" id="friend-3"></ul></div>
<div class="friend-title">{lag 陌生人} +
</div><div class="friend-div-box"><ul class="friend-ul" id="friend-0"> </ul></div></div>
<script>$(function(){
$(".friend-title").click(function(){
$(this).next().toggleClass('friend-div-box-hide');
})
})</script>{/if}