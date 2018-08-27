{include h}
{include header}
 {php $i=0;$pagetime=0;}
<section class="body">
<div class="ys-box">
 <div class="row c" id="maincontent">
  {if $data}
{foreach $data as $key => $v}
{php $pagetime=$v['btime'];$i++;}
<div class="col-xs-6"><a href="/f/{$v['id']}.html"><img  src="{#bucketcdn}{$v['img']}" width="80" height="80" class="circle"><h2>{$v['name']}</h2></a>
 <p>{lag 主题}:{$v['threads']}&nbsp;&nbsp;{lag 回复}:{$v['posts']}</p>
 </div>
{/foreach}
{/if}
</div>
</div>

<div class="ys-box">{if $i>9}<a href="/f/index/{$pagetime}.html" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div>
</section>{include f}