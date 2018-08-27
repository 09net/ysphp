{include h}<header id="top" class="amp-wp-header"><div><a href="{$m_ca}"><span class="amp-site-title">{$dname}</span></a></div></header>
<article class="amp-wp-article">
<header class="amp-wp-article-header">
<h1 class="amp-wp-title">{$title}</h1>
</header>
<div class="amp-wp-article-content">
 {php $i=0;$pagetime=0;}
{if $data}{foreach $data as $v}<?php $i++;$pagetime=$v['btime'];?>{include t_list}
{/foreach}{else}<div class="c">{lag 空}</div>{/if}
</div><footer class="amp-wp-article-footer">
<div class="amp-c"><amp-social-share type="facebook"></amp-social-share>
<amp-social-share type="twitter"></amp-social-share>
<amp-social-share type="linkedin"></amp-social-share>
<amp-social-share type="gplus"></amp-social-share>
<amp-social-share type="whatsapp"></amp-social-share>
<amp-social-share type="pinterest"></amp-social-share>
<amp-social-share type="email"></amp-social-share>
</div>
<div class="amp-wp-meta amp-wp-comments-link">{if $i>9}<a href="/index/index/{$mode}/{$pagetime}.html" class="btn btn-primary btn-lg btn-block">{lag 下一页}</a>{else}{lag 完毕}{/if}</div>
<div class="amp-c"><amp-auto-ads type="adsense" data-ad-client="ca-pub-2005983165848766"></amp-auto-ads></div>
</footer></article><footer class="amp-wp-footer"><div><h2>{$dname}</h2><p><a href="/">{lag 首页}</a></p><a href="#top" class="back-to-top">{lag 顶部}</a></div></footer></body></html>