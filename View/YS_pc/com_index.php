{include h}<div class="container"><div id="main"><div class="wrap-box"><ol><li><a href="/">{lag 首页}</a></li><li class="fa fa-chevron-right"><a href="/t/{$thread_data['id']}.html">{lag 原文}</a></li></ol><div  class="pull-right"><a href="/post/{$thread_data['fid']}.html" class="red">{lag 发布主题}</a></div>
</div><div class="wrap-box t-info"><div class="head">
<h1 id="titlefy"><a href="/t/{$thread_data['id']}.html">{$thread_data.title}</a></h1>
{if $thread_data['lang']<>NOW_LANG}<p><a href="javascript:void(0);" onclick="str_fy('titlefy','{$thread_data['lang']}',this)" class="btn">{lag 翻译}</a></p>{/if}
<div class="meta tags">
<a href="/u/<?php echo urlencode($thread_data['user']);?>.html" target="_blank">{$thread_data.user}</a><a onclick="friend_ajax({$thread_data['uid']},this)" class="fa fa-user-plus" id="f_star"></a>&nbsp;<span>{php echo humandate($thread_data['atime']);}</span>&nbsp;<a href="#maincontent" class="fa fa-commenting-o">{$thread_data.posts}{lag 回复}</a>
</div><a href="/u/<?php echo urlencode($thread_data['user']);?>" class="avatar" target="_blank"><img src="{#bucketcdn}{$thread_data['avatar']}_50" width="60" height="60" class="circle js-info" data-uid="{$thread_data.uid}" alt="{$thread_data['user']}"></a>
</div>
{include tags::share}
<div class="meta tags2" data-id='{$thread_data.id}' data-post='post'><a class='up2 fa fa-thumbs-up'><span>{$thread_data['goods']}</span></a><a class='down2 fa fa-thumbs-down pull-right'><span>{$thread_data['nos']}</span></a></div>
</div>
 <div class="wrap-box">
<form action="/comment/{$thread_data['id']}" method="post">
<input name="pid" id="pid" type="hidden" value="0" />
{if IS_LOGIN}
<textarea id="content" name="content" class="input-text"></textarea>
<p><button type="submit" class="btn btn-primary" id="post_post">{lag 评论}</button><span id="acom"></span></p>
{else}
<a href="/user/login">{lag 登录}</a>
{/if}
</form>
</div>
<div class="typo comments"><div class="wrap-box comment-list"><div class="list" id="maincontent">
{php $i=0;$pagetime=0;}
{if empty($PostList)}
<div class="c">{lag 没有评论}</div>
{else}
{foreach $PostList as $k => $v}{php $pagetime=$v['btime'];$i++;}{include postlist}{/foreach}
{/if}
</div></div></div>
 <div class="wrap-box">{if $i>9}<a href="/comment/{if !is_numeric(METHOD_NAME)}more/{/if}{$thread_data['id']}?pageid={$pagetime}" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div>
</div>{include r_m}</div>{include f}
