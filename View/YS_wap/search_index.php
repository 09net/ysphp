{include h}
{include header}
 {php $i=0;$pagetime=0;}
<section class="body" id="index_body">
<div class="ys-box"><ol><li><a href="/">{lag 首页}</a></li></ol><div class="pull-right"><a href="/search.html">{lag 搜索}</a></div></div>
<div class="ys-box">
<form method="get">
 <div class="row">
 <div class="col-xs-8">
 <input name="q" value="{$q}" placeholder="{lag 关键字}" class="input-text">
 </div>
 <div class="col-xs-4">
 <button type="submit" class="input-text blue">{lag 搜索}</button>
 </div>
 </div>
 
 </form></div>

<div class="ys-box">{include YS_pc::mode_s_menus}</div>
<div class="ys-box t-list">

 {if !empty($user_list)}
 <div style="margin-bottom:5px">
 {foreach $user_list as $v}
 <a class="user-box" href="/u/<?php urlencode($v['user']);?>.html" target="_blank">
 <img src="{#bucketcdn}{$v['avatar']}" class="circle">
 {$v.user}
 </a>
 {/foreach}
 <div style="clear: both;margin-bottom:0"></div>
 </div>
 {/if}
 {if !empty($forum_list)}
 <div style="margin-bottom:5px">
 {foreach $forum_list as $v}
 <a class="user-box" href="/f/{$v['id']}.html" target="_blank">
 <img src="{#bucketcdn}{$v['img']}" class="circle">
 {$v.name}
 </a>
 {/foreach}
 <div style="clear: both;margin-bottom:0"></div>
 </div>
 {/if}
<div id="maincontent">
{if $data}{foreach $data as $v}<?php $i++;?>
{include YS_pc::t_list}
{/foreach}{else}<div class="c">{lag 空}</div>{/if}</div></div><div class="ys-box">{include tags::share}</div><div class="ys-box">{if $i>9}<a href="/search/<?php echo urlencode($q);?>/{$mode}.html?pageid=<?php echo ($pageid+1);?>&fid={$fid}" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div>

</section>
{include f}
