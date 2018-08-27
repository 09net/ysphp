<div class="ys-fix-b ys-bo-t ys-footer-nav">
 <a href="/" {if ACTION_NAME=='Index'} class="a"{/if}>
  <span class="icon icon-yahoo2"></span>{lag 论坛}
 </a>
 <a href="/f.html"{if ACTION_NAME=='Forum'} class="a"{/if}>
  <span class="icon icon-grid2"></span>{lag 板块}
 </a>
 <a {if IS_LOGIN}href="/post.html"{else}href="/user/login" {/if} rgb="#f1f4f9" style="position: relative;display: block;top: -18px;">
  <span class="ys-footer-c icon icon-plus" style="display: inline-block; box-shadow: 0px 0px 1px #496676;"></span>
 </a>
 <a href="{if IS_LOGIN}javascript:void(0);{else}/user/login{/if}" {if IS_LOGIN}onclick="tog_friend_box()"{else} rgb="#f1f4f9"{/if}>
  <span class="icon icon-users" ></span>{lag 好友}{if IS_LOGIN}{if $user['mess']}<i id="ys-mess">(<em class="ys-font-warning">{$user.mess}</em>)</i>{/if}{/if}
 </a>
 <a {if !IS_LOGIN}onclick="$.YS.canvas_show('left')"{else}href="/u/<?php echo urlencode($user['user']);?>.html"{/if}>
  <span class="icon icon-star" ></span>{lag 我的}
 </a>
</div>