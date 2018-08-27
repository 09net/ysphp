{include h}
 {php $i=0;$pagetime=0;}
<div class="container">
 <div id="main">
<div class="widget-docs-search shadow"><div class="inner"><form method="get" action="/search" style="margin-bottom:0;position: relative;"><input name="name" value="{if isset($q)}{$q}{/if}" class="h-scanfin" type="text"><button class="icon-search h-scanf"></button></form></div></div>
<div class="wrap-box t-list">
<h1>{lag 全部小组}</h1>
 <div class="row c" id="maincontent">
 {if $data}
{foreach $data as $key => $v}
{php $pagetime=$v['btime'];$i++;}
<div class="col-xs-4"><a href="/f/{$v['id']}.html"><img  src="{#bucketcdn}{$v['img']}" width="80" height="80" class="circle"><h2>{$v['name']}</h2></a>
 <p>{lag 主题}:{$v['threads']}&nbsp;&nbsp;{lag 回复}:{$v['posts']}</p>
 </div>
{/foreach}
{/if}
</div>
</div>

<div class="wrap-box">{if $i>9}<a href="/f/index/{$pagetime}.html" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div>
</div>{include r_m}</div>{include f}