{include h}
 {php $i=0;$pagetime=0;}
<div class="container">
<div id="main">
<div class="wrap-box"><ol><li><a href="/">{lag 首页}</a></li></ol><div class="pull-right"><a href="/search.html">{lag 搜索}</a></div></div>
<div class="wrap-box">
<form method="get">
 <div class="row">
 <div class="col-xs-10">
 <input name="q" value="{$q}" placeholder="{lag 关键字}" class="input-text">
 </div>
 <div class="col-xs-2">
 <button type="submit" class="input-text blue">{lag 搜索}</button>
 </div>
 </div>
 
 </form></div>

<div class="wrap-box">{include mode_s_menus}</div>
<div class="wrap-box t-list">

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


<div class="list" id="maincontent">


{if $data}{foreach $data as $v}<?php $i++;?>
{include t_list}
{/foreach}{else}<div class="c">{lag 空}</div>{/if}</div></div><div class="wrap-box">{include tags::share}</div><div class="wrap-box">{if $i>9}<a href="/search/<?php echo urlencode($q);?>/{$mode}.html?pageid=<?php echo ($pageid+1);?>&fid={$fid}" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div></div>
{include r_m}</div>{include f}