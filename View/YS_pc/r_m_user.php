<div id="right-bar">
<div class="right-widget only-logo">
<div class="head">{lag 个人资料}</div>
<div class="c"><img src="{#bucketcdn}{$data['avatar']}_180" width="180" height="180" alt="{$data['user']}" title="{$data['user']}"><h2>{$data['user']}</h2></div>
<div class="user_info c">
<a onclick="friend_ajax({$data['id']},this)" class="fa fa-user-plus" id="f_star" data-uid="{$data['id']}"></a>&nbsp;<a onclick="new_chat('title','ssss',444,465,{$data['id']},'{$data['user']}','{#bucketcdn}{$data['avatar']}_180','')" class="fa fa-envelope"></a>
</div>
<ul class="user_info">
<li><span class="text">{lag 等级}</span>:<b class="num">{$data['grouptext']}</b></li>
<li><span class="text">{lag 关注}</span>:<span class="num">{$data['fans']}</span></li>
<li><span class="text">{lag 粉丝}</span>:<span class="num">{$data['follow']}</span></li>
<li><span class="text">{lag 文章}</span>:<span class="num">{$data['threads']}</span></li>
<li><span class="text">{lag 评论}</span>:<span class="num">{$data['posts']}</span></li>
<li><span class="text">{lag 积分}</span>:<span class="num">{$data['credits']}</span></li>
<li><span class="text">{lag 金币}</span>:<span class="num">{$data['gold']}</span></li>
</ul>

</div>
<div class="right-widget only-logo">
<div class="head">{lag 栏目}<a href="/f.html" class="pull-right js-tooltip">{lag 更多}</a></div>
{if isset($forum) and $forum}<div class="row">{foreach $forum as $v}<div class="col-xs-6 c"><div class="fmore"><a href="/f/{$v['id']}.html"><img src="{#bucketcdn}{$v['img']}" class="circle" width="50" height="50"><br>{$v['name']}</a></div></div>{/foreach}</div>{/if}
</div>
<div class="right-widget only-logo">
<div class="head">{lag 内容联盟}<a href="https://{#NOW_LANG}.ysv8.com" class="pull-right js-tooltip">{lag 地球城}</a></div>
<a href="https://github.com/09net/yswxapp" target="_blank">
<img src="{#bucketcdn}9fe/e16c6d5043524deb4dccc4bf3e85c24de2af47a7.jpg" alt="{lag 广告}" width="300px" height="300px"/><p class="c">{lag 微信扫一扫}&nbsp;&nbsp;内涵GIF笑话</p></a>
</div>
<div class="rFixedBox" style="position: static; top: 0px;"><div><a href="https://jq.qq.com/?_wv=1027&k=5dN9I8k" target="_blank" rel="nofollow"><img src="{#bucketcdn}727/e71d89323c05a1e8561e86cf14b11a783c6824c9.png" alt="{lag 广告}" width="300px" height="300px"/><p class="c">QQ {lag 群}:835232190</p></a></div></div>
</div>