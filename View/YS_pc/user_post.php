{include h}
 {php $i=0;$pagetime=0;}
<div class="container">
<div id="main">
{include user_menus}

<div class="typo comments"><div class="wrap-box comment-list"><div class="list" id="maincontent">{if $post_data}{foreach $post_data as $v}<?php $i++;$pagetime=$v['btime'];?>
{include postlist}
<p><a  href="/t/{$v['tid']}.html">{lag 查看详细内容}</a></p>
{/foreach}{else}<div class="c">{lag 空}</div>{/if}</div></div></div><div class="wrap-box">{include tags::share}</div><div class="wrap-box">{if $i>9}<a href="/u/<?php echo urlencode($data['user']);?>/{$method}/{$pagetime}.html" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div></div>
{include r_m_user}</div>{include f}