{include h}{php $i=0;$pagetime=0;}
<div class="container">
<div id="main">
{include user_menus}
<div class="wrap-box">
<div class="row my-gallery" id="maincontent">
{if $piclist}{foreach $piclist as $v}<?php $i++;$pagetime=$v['btime'];?>
<div class="col-xs-4 c">
<img src="{#bucketcdn}{$v['hash']}_150" data-size="{$v['w']}x{$v['h']}" />
<p><?php echo humandate($v['atime']);?>&nbsp;<i class="fa fa-heart">{$v['likes']}</i></p>
</div>
{/foreach}
{/if}
</div></div>
{include meta::pswp}
<div class="wrap-box">{include tags::share}</div><div class="wrap-box">{if $i>9}<a href="/u/<?php echo urlencode($data['user']);?>/{$method}/{$pagetime}.html" class="btn btn-primary btn-lg btn-block" id="getmore">{lag 下一页}</a>{else}<a class="btn btn-lg btn-block" id="getmore" href="/">{lag 首页}</a>{/if}</div></div>
{include r_m_user}</div>{include f}