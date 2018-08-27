{include h}
 {php $i=0;$pagetime=0;}
<div class="container">
<div id="main">
<div class="wrap-box"><ol><li><a href="/">{lag 首页}</a></li></ol><div class="pull-right"><a href="/post/{$fdata['id']}.html">{lag 发布主题}</a></div></div>
<div class="wrap-box">{include mode_menus}</div>
<div class="wrap-box t-list"><div class="list" id="maincontent">{if $data}{foreach $data as $v}<?php $i++;$pagetime=$v['btime'];?>
{include t_list}
{/foreach}{else}<div class="c">{lag 空}</div>{/if}</div></div><div class="wrap-box">{include tags::share}</div><div class="wrap-box">{if $i>9}<a href="/f/{$fdata['id']}/{$mode}/{$pagetime}.html" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div></div>
{include r_m}</div>{include f}