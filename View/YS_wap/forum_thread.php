{include h}
{include header}
 {php $i=0;$pagetime=0;}
<section class="body" id="index_body">
<div class="ys-box"><ol><li><a href="/">{lag 首页}</a></li></ol><div class="pull-right btn"><a href="/post/{$fdata['id']}.html">{lag 发布主题}</a></div></div>
<div class="ys-box">{include YS_pc::mode_menus}</div>
<div class="ys-box t-list"><div id="maincontent">
{if $data}{foreach $data as $v}<?php $i++;$pagetime=$v['btime'];?>{include YS_pc::t_list}
{/foreach}{else}<div class="c">{lag 空}</div>{/if}
</div></div>
<div class="ys-box">{include tags::share}</div>
<div class="ys-box">{if $i>9}<a href="/f/{$fdata['id']}/{$mode}/{$pagetime}.html" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div>
</section>
{include f}