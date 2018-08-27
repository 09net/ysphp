{include h}<div class="container"><div id="main"><div class="wrap-box"><ol><li><a href="/">{lag 首页}</a></li><li class="fa fa-chevron-right"><a href="/f/{$fdate['id']}.html">{$fdate['name']}</a></li></ol><div  class="pull-right"><a href="/post/{$thread_data['fid']}.html" class="red">{lag 发布主题}</a></div>
</div><div class="wrap-box t-info"><div class="head">
<h1 id="titlefy">{$thread_data.title}</h1>
{if $thread_data['lang']<>NOW_LANG}<p><a href="javascript:void(0);" onclick="str_fy('titlefy','{$thread_data['lang']}',this)" class="btn">{lag 翻译}</a></p>{/if}
<div class="meta tags">
<a href="/u/<?php echo urlencode($thread_data['user']);?>.html" target="_blank">{$thread_data.user}</a><a onclick="friend_ajax({$thread_data['uid']},this)" class="fa fa-user-plus" id="f_star" data-uid="{$thread_data['uid']}"></a>&nbsp;<span>{php echo humandate($thread_data['atime']);}</span>&nbsp;<a href="#maincontent" class="fa fa-commenting-o">{$thread_data.posts}{lag 回复}</a>
</div><a href="/u/<?php echo urlencode($thread_data['user']);?>" class="avatar" target="_blank"><img src="{#bucketcdn}{$thread_data['avatar']}_50" width="60" height="60" class="circle js-info" data-uid="{$thread_data.uid}" alt="{$thread_data['user']}"></a>
</div>
{if $thread_data['vs']}<div><video controls="controls" autoplay="autoplay"><source src="{$thread_data['vs']}" type="video/mp4" poster="{$thread_data['vs']}?x-oss-process=video/snapshot,t_1000,f_jpg,m_fast" /></video></div>{/if}
<div class="my-gallery"><div class="tcontent typo editor-style" id="contentfy">{$post_data}</div></div>
{if $thread_data['lang']<>NOW_LANG}<p><a href="javascript:void(0);" onclick="str_fy('contentfy','{$thread_data['lang']}',this)" class="btn">{lag 翻译}</a></p>{/if}
{if isset($filelist) and $filelist}
<h2 style="border-bottom: solid #E6E6E6 1px;padding-bottom: 10px;">{lag 附件列表}</h2>
{foreach $filelist as $k => $v}
<p style="padding:10px;font-size:18px">
<a href="javascript:void(0);" onclick="downfile({$v['id']});">{$v['filename']}.{$v['ext']}</a>
</p>
{/foreach}
{/if}
{include tags::share}
<div class="meta tags2"><a class='fa fa-thumbs-up' href="javascript:void(0);" onclick="vote({$thread_data['id']},'thread','goods');"><span>{$thread_data['goods']}</span></a><a class='fa fa-thumbs-down pull-right' href="javascript:void(0);" onclick="vote({$thread_data['id']},'thread','nos');"><span>{$thread_data['nos']}</span></a></div>
</div>
{include tags::admin}
<div class="wrap-box"><div class="tags2"><?php echotag($thread_data['keys']);?></div></div>
<div class="typo comments"><div class="wrap-box comment-list"><div class="list" id="maincontent">
{php $i=0;$pagetime=0;}
{if empty($PostList)}
<div class="c">{lag 没有评论}</div>
{else}
{foreach $PostList as $k => $v}{php $pagetime=$v['btime'];$i++;}{include postlist}{/foreach}
{/if}

</div></div></div>
 <div class="wrap-box">{if $i>9}<a href="/comment/{$thread_data['id']}?pageid={$pagetime}" class="btn btn-primary btn-lg btn-block">{lag 下一页}</a>{else}<button class="btn btn-lg btn-block">{lag 完毕}</button>{/if}</div>
 
 
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
{if is_array($data)}
<div class="wrap-box t-list">
<div class="list">
 {foreach $data as $v}
{include t_list}
 {/foreach}
</div>
</div>
 {/if}
{if $thread_data['img']}{include meta::pswp}{/if}
</div>{include r_m}</div>{include f}
