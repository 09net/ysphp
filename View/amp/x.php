{include h}
<header id="top" class="amp-wp-header"><div><a href="/"><span class="amp-site-title">{$dname}</span></a></div></header>

<article class="amp-wp-article">
<header class="amp-wp-article-header">
<h1 class="amp-wp-title">{$thread_data.kname}_{$thread_data['aname']}</h1>
<div class="amp-wp-meta amp-wp-byline">
<amp-img src="{$thread_data.avatar}" width="24" height="24" layout="fixed"></amp-img>
<a href="/u/{php echo urlencode($thread_data['user']);}/thread.html"><span class="amp-wp-author author vcard">{$thread_data.user}</span></a>
</div>
<div class="amp-wp-meta amp-wp-posted-on"><time datetime="<?php echo date(DATE_W3C,$thread_data['sid']);?>">{php echo date('Y-m-d',$thread_data['sid']);}</time></div>
</header>
<div class="amp-wp-article-content">
{if isset($m_vod)}<p><amp-video controls width="600" height="400" src="{$m_vod}"> <div fallback><p>{lag 视频}</p></div></amp-video></p>{/if}
<div><a href="/kid/{$thread_data['kid']}/{$thread_data['xid']}.html">{$thread_data['kname']}</a>&nbsp;<a href="/aid/{php echo urlencode($thread_data['aname']);}.html">{$thread_data['aname']}</a></div>{$thread_data['con']}</div>
{if isset($filelist)}
<div class="amp-wp-article-file">
<h2>{lag 附件列表}</h2>
{foreach $filelist as $k => $v}
<p><a href="/a/{$v['id']}.html">{$v['filename']}.{$v['ext']}({$v['gold']}{lag 金币})</a></p>
{/foreach}
</div>{/if}
<footer class="amp-wp-article-footer">
<div class="amp-c"><amp-social-share type="facebook"></amp-social-share>
<amp-social-share type="twitter"></amp-social-share>
<amp-social-share type="linkedin"></amp-social-share>
<amp-social-share type="gplus"></amp-social-share>
<amp-social-share type="whatsapp"></amp-social-share>
<amp-social-share type="pinterest"></amp-social-share>
<amp-social-share type="email"></amp-social-share>
</div>
<div class="amp-wp-meta amp-wp-comments-link"><a href="{$m_ca}#maincontent">{lag 点赞}(<span class="red">{$thread_data.mode}</span>)</a></div>
<div class="amp-c"><amp-auto-ads type="adsense" data-ad-client="ca-pub-2005983165848766"></amp-auto-ads></div>
</footer>
</article><footer class="amp-wp-footer"><div><h2>{$dname}</h2><p><a href="">{lag 首页}</a></p><a href="#top" class="back-to-top">{lag 顶部}</a></div></footer></body></html>