<div class="item"><div class="middle text"><h4 class="title"><a href="/t/{$v['id']}.html" >{$v['title']}</a></h4>
{if $v['vs']}<amp-video controls width="600" height="400" src="{#bucketcdn}{$v['vs']}" poster="{#bucketcdn}{$v['vs']}?x-oss-process=video/snapshot,t_1000,f_jpg,m_fast"> <div fallback><p>{lag 视频}</p></div></amp-video>{else}
<?php
if(!empty($v['img'])){
$s2=explode(',',trim(str_replace('{m}',bucketcdn,$v['img']),','));
echo '<br><amp-img src="',$s2[0],'" width="180" height="180" layout="fixed"></amp-img>';
}
?>{/if}
<div class="meta"><a href="/u/{php echo urlencode($v['user']);}/thread.html" class="author" target="_blank">{$v.user}</a>·&nbsp;&nbsp;{php echo humandate($v['atime']);}&nbsp;&nbsp;{if isset($v['buser'])}·&nbsp;&nbsp;{$v.buser}&nbsp;&nbsp;·&nbsp;&nbsp;{lag 回复} {php echo humandate($v['btime']);}{/if}&nbsp;&nbsp;{if $v['posts']}<a href="/t/{$v['id']}.html#comment" class="comment" ><span class="badge {if ($v['btime']+1800) > NOW_TIME}badge-success{/if}">{$v.posts}</span></a>{/if}</div></div>
</div>