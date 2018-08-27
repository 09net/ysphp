{include h}
{include header}
 {php $i=0;$pagetime=0;}
<section class="body" id="index_body">
<div class="ys-box"><ol><li><a href="/">{lag 首页}</a></li><li class="fa fa-chevron-right"><a href="/f/{$fdate['id']}.html">{$fdate['name']}</a></li></ol><div  class="pull-right btn"><a href="/post/{$thread_data['fid']}.html" class="red">{lag 发布主题}</a></div></div>

<div style="padding-bottom:5px">
<div class="ys-box thread-index" style="margin-bottom: 0;padding-bottom: 0;padding-top: 0;">
<h2 id="titlefy">{$thread_data.title}</h2>
{if $thread_data['lang']<>NOW_LANG}<p><a href="javascript:void(0);"  onclick="str_fy('titlefy','{$thread_data['lang']}',this)" class="btn">{lag 翻译}</a></p>{/if}
<p class="cl tags"><a href="/u/{php echo urlencode($thread_data['user']);}/thread.html"><img src="{#bucketcdn}{$thread_data.avatar}" class="avatar">{$thread_data.user}</a><a onclick="friend_ajax({$thread_data['uid']},this)" class="fa fa-user-plus" id="f_star" data-uid="{$thread_data['uid']}"></a>&nbsp;<a href="#maincontent"><i class="fa fa-comment"></i>{$thread_data.posts}</a><br /><em class="">{php echo humandate($thread_data['atime'])}</em></p></div>

{if $thread_data['vs']}<div class="ys-box"><video controls="controls" autoplay="autoplay"><source src="{$thread_data['vs']}" type="video/mp4" poster="{$thread_data['vs']}?x-oss-process=video/snapshot,t_1000,f_jpg,m_fast" /></video></div>{/if}
<div class="ys-box thread-cen my-gallery"><div class="my-gallery"><div id="contentfy">{$post_data}</div></div>
{if $thread_data['lang']<>NOW_LANG}<p><a href="javascript:void(0);" onclick="str_fy('contentfy','{$thread_data['lang']}',this)" class="btn">{lag 翻译}</a></p>{/if}
<div>{if isset($filelist) and $filelist}
<h2 style="border-bottom: solid #E6E6E6 1px;padding-bottom: 10px;">{lag 附件列表}</h2>
{foreach $filelist as $k => $v}
<p style="padding:10px;font-size:18px"><a href="javascript:void(0);" onclick="downfile({$v['id']});">{$v['filename']}.{$v['ext']}</a></p>
{/foreach}
{/if}</div>
<div class="tags2">{php echotag($thread_data['keys']);}</div>
{include tags::share}
<div class="baod">
<ul class="ys-lable-group">
<li><a class="fa fa-thumbs-up" href="javascript:void(0);" onclick="vote({$thread_data['id']},'thread','goods');"><span>{$thread_data['goods']}</span></a></li>
<li class="pull-right" style="margin-right: 25px;"><a class="fa fa-thumbs-down" href="javascript:void(0);" onclick="vote({$thread_data['id']},'thread','nos');"><span>{$thread_data['nos']}</span></a></li>
</ul>
</div>
</div>

<div class="ys-box t-list">
<div id="maincontent">
{php $i=0;$pagetime=0;}
{if empty($PostList)}
<div class="c">{lag 没有评论}</div>
{else}
{foreach $PostList as $k => $v}{php $pagetime=$v['btime'];$i++;}{include YS_pc::postlist}{/foreach}
{/if}
</div></div>
<div class="ys-box">{if $i>9}<a href="/comment/{$thread_data['id']}?pageid={$pagetime}" class="btn btn-primary btn-lg btn-block">{lag 下一页}</a>{else}<button class="btn btn-lg btn-block">{lag 完毕}</button>{/if}</div>

<div class="ys-box t-list">
{if is_array($data)}
<div>
 {foreach $data as $v}
{include YS_pc::t_list}
 {/foreach}
  </div>
 {/if}
 </div>
</div>

</section>
<div class="ys-fix-b ys-bo-t item" style="background: #f6f6f6;width:100%;padding:10px;">
<button type="button" onclick="open_post_box(this)" class="btn btn-danger btn-outlined" style="border-radius: 15px;width:40%">{lag 评论}</button>
<div class="r post-div weibor" style="width:57%" data-id='{$thread_data.id}' data-post='post'></div>
</div><div class="post-box ys-bo-t">
{if isset($foruml['guest']) and $foruml['guest']>1}
{lag 不允许评论}
{else}
{if IS_LOGIN}
<div class="ys-box" style="font-size: 16px;">
<div class="ys-input-box">
<label style="font-weight: bold;
 font-size: 1.4rem;">{lag 内容}<a href="javascript:void(0)" onclick="hide_post_box()">{lag 关闭}</a></label>
</div>
<form action="/comment/{$thread_data['id']}" method="post"><input name="pid" id="pid" type="hidden" value="0" />
<p><textarea id="content" name="content" class="input-text"></textarea></p><button type="submit" id="post_post" class="btn btn-danger">{lag 发布}</button><span id="acom"></span></form></div>
{else}<a class="btn btn-block" href="/user/login">{lag 登录}</a>{/if}{/if}
</div>
{if $thread_data['img']}{include meta::pswp}{/if}
{include f}