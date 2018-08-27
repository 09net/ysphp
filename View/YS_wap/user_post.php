{include h}
{include header}
 {php $i=0;$pagetime=0;}
<section class="body" id="index_body">
{include user_menus}

<div class="ys-box t-list"><div id="maincontent">{if $post_data}{foreach $post_data as $v}<?php $i++;$pagetime=$v['btime'];?>
{include YS_pc::postlist}
<p><a  href="/t/{$v['tid']}.html">{lag 查看详细内容}</a></p>
{/foreach}{else}<div class="c">{lag 空}</div>{/if}</div></div><div class="ys-box">{include tags::share}</div><div class="ys-box">{if $i>9}<a href="/u/<?php echo urlencode($data['user']);?>/{$method}/{$pagetime}.html" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div>

</section>
{include f}