{include h}
{include header}
 {php $i=0;$pagetime=0;}
<section class="body" id="index_body">
<div class="ys-box"><ol><li><a href="/">{lag 首页}</a></li></ol><div  class="pull-right"><a href="/post/{$thread_data['fid']}.html" class="red">{lag 发布主题}</a></div></div>

<div style="padding-bottom:5px">
<div class="ys-box thread-index" style="margin-bottom: 0;padding-bottom: 0;padding-top: 0;">
<h2 id="titlefy">{$thread_data.title}</h2>
{if $thread_data['lang']<>NOW_LANG}<p><a href="javascript:void(0);"  onclick="str_fy('titlefy','{$thread_data['lang']}',this)" class="btn">{lag 翻译}</a></p>{/if}
<p class="cl tags"><a href="/u/{php echo urlencode($thread_data['user']);}/thread.html"><img src="{#bucketcdn}{$thread_data.avatar}" class="avatar">{$thread_data.user}</a><a onclick="friend_ajax({$thread_data['uid']},this)" class="fa fa-user-plus" id="f_star"></a>&nbsp;<a href="#maincontent"><i class="fa fa-comment"></i>{$thread_data.posts}</a><br /><em class="">{php echo humandate($thread_data['atime'])}</em></p></div>
{include tags::share}
</div>
<div class="ys-box t-list">
<div id="maincontent">
{php $i=0;$pagetime=0;}
{if empty($PostList)}
<div class="c">{lag 没有评论}</div>
{else}
{foreach $PostList as $k => $v}{php $pagetime=$v['btime'];$i++;}{include YS_pc::postlist}{/foreach}
{/if}
</div></div></div>
<div class="ys-box">{if $i>9}<a href="/comment/{if !is_numeric(METHOD_NAME)}more/{/if}{$thread_data['id']}?pageid={$pagetime}" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div>

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
</div><input name="pid" id="pid" type="hidden" value="0" />
<p><textarea id="content" class="publisher_textarea"></textarea></p><button type="button" id="post_post" class="btn btn-danger">{lag 发布}</button><span id="acom"></span></div>
{else}<a class="btn btn-block" href="/user/login">{lag 登录}</a>{/if}{/if}
</div>

{include f}