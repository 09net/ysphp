{include h}
{include header}
 {php $i=0;$pagetime=0;}
<section class="body" id="index_body">
{include user_menus}
<div class="ys-box">
<div class="row my-gallery" id="maincontent">
{if $piclist}{foreach $piclist as $v}<?php $i++;$pagetime=$v['btime'];?>
<div class="col-xs-6 c">
<img src="{#bucketcdn}{$v['hash']}_150" data-size="{$v['w']}x{$v['h']}" />
<p><?php echo humandate($v['atime']);?>&nbsp;<i class="fa fa-heart">{$v['likes']}</i></p>
</div>
{/foreach}
{/if}
</div>
{include meta::pswp}
<div class="ys-box">{include tags::share}</div><div class="ys-box">{if $i>9}<a href="/u/<?php echo urlencode($data['user']);?>/{$method}/{$pagetime}.html" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div></div>
</section>
{include f}