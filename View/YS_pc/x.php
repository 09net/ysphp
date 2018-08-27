{include h}
{include search}
<div class="wrap-box"><h1 class="mui-title">{$title}</h1></div>
<div class="wrap-box">
{if $thread_data['vs']}<video controls="controls" autoplay="autoplay"><source src="{$thread_data['vs']}" type="video/mp4"></video>{/if}
<center>{$thread_data['kname']}&nbsp;<a href="/cdn/aid/{php echo urlencode($thread_data['aname']);}.html">{$thread_data['aname']}</a></center>{$thread_data['con']}{if isset($filelist)}
<h2 style="border-bottom: solid #E6E6E6 1px;padding-bottom: 10px;">{lag 附件}</h2>
{foreach $filelist as $k => $v}
<p style="padding:10px;font-size:18px">
<a href="/a/{$v['id']}.html">{$v['filename']}.{$v['ext']}({$v['gold']}{lag 金币})</a>
</p>
{/foreach}
{/if}<p><a href="/myweb/x?id={$thread_data['id']}" class="btn btn-primary">{lag 编辑}</a></p>
{if isset($Keyhtml)}{$Keyhtml}{/if}
</div>

<div class="wrap-box"><div class="rowdiv"><div class="g-6 c"><a class="btn btn-primary" href="{if $thread_data['id']>1}/cdn/x/{php echo ($thread_data['id']-1);}.html{else}/cdn{/if}"><i class="fa fa-arrow-left"></i></a></div><div class="g-6 c"><a class="btn btn-primary" href="/cdn/x/{php echo ($thread_data['id']+1);}.html"><i class="fa fa-arrow-right"></i></a></div></div></div>


{include ads2}</div>{include hy_boss::r_m}</div>{include f}


<div class="container"><div id="main"><div class="wrap-box"><ol><li><a href="/">{lag 首页}</a></li><li class="fa fa-chevron-right"><a href="/f/{$fdate['id']}.html">{$fdate['name']}</a></li></ol><div  class="pull-right"><a href="/post/{$thread_data['fid']}.html" class="red">{lag 发布主题}</a></div>
</div><div class="wrap-box t-info"><div class="head">
<h1 id="titlefy">{$thread_data.title}</h1>
{if $thread_data['lang']<>NOW_LANG}<p><a href="javascript:void(0);" onclick="str_fy('titlefy','{$thread_data['lang']}',this)" class="btn">{lag 翻译}</a></p>{/if}
<div class="meta tags">
<a href="/u/<?php echo urlencode($thread_data['user']);?>.html" target="_blank">{$thread_data.user}</a><a onclick="friend_ajax({$thread_data['uid']},this)" class="fa fa-user-plus" id="f_star" data-uid="{$thread_data['uid']}"></a>&nbsp;<span>{php echo humandate($thread_data['atime']);}</span>&nbsp;<a href="#maincontent" class="fa fa-commenting-o">{$thread_data.posts}{lag 回复}</a>
</div><a href="/u/<?php echo urlencode($thread_data['user']);?>" class="avatar" target="_blank"><img src="{#bucketcdn}{$thread_data['avatar']}_50" width="60" height="60" class="circle js-info" data-uid="{$thread_data.uid}" alt="{$thread_data['user']}"></a>
</div>
{if $thread_data['vs']}
<div><video controls="controls" autoplay="autoplay"><source src="{$thread_data['vs']}" type="video/mp4" /></video></div>{/if}
<div class="my-gallery"><div class="tcontent typo editor-style" id="contentfy">{$post_data}</div></div>
{if $thread_data['lang']<>NOW_LANG}<p><a href="javascript:void(0);" onclick="str_fy('contentfy','{$thread_data['lang']}',this)" class="btn">{lag 翻译}</a></p>{/if}
{if isset($filelist)}
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
