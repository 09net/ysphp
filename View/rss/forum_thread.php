<?xml version="1.0" encoding="utf-8"?>
<?xml-stylesheet type="text/xsl" href="/View/rss/feed.css"?>
<rss version="2.0"><channel><title>{$title}</title>
<image><title>{$title}</title>
<link>//{#NOW_LANG}.{#DOMAIN}/{$urlhz}</link>
<url>{#icdn}public/logo/favicon.png</url></image>
<description>{$title}</description>
<link>//{#NOW_LANG}.{#DOMAIN}/{$urlhz}</link>
<copyright>Copyright 2018 - 2025 09hnnet Inc. All Rights Reserved</copyright>
<language>{#NOW_LANG}</language><generator>{#DOMAIN}</generator>{if $data}{foreach $data as $v}<item><title>{$v.title}</title><link>//{#NOW_LANG}.{#DOMAIN}/t/{$v.id}.html</link><author>{$v['user']}</author><category/><pubDate>{php echo date("Y-m-d H:i:s",$v['btime']);}</pubDate><comments/><description><![CDATA[]]></description></item>{/foreach}{/if}</channel></rss>