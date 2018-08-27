<!DOCTYPE html><html lang="{#HTML_LANG}"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="renderer" content="webkit" /><meta name="viewport" content="width=device-width, user-scalable=yes" />{include meta::index}<script>var www = "/";var bucketcdn = "{#bucketcdn}";var exp = "/";var lang = "{#NOW_LANG}";var {if IS_LOGIN}islogin=true;{else}islogin=false;{/if}</script><script src="/fy.js?{#YSPHP_VERSION}"></script>
<script src="{#icdn}public/js/jquery.min.js?{#YSPHP_VERSION}"></script>
<link href="{#icdn}public/mui/css/index.css" rel="stylesheet" />
<script src="{#icdn}public/js/jquery.qrcode.min.js"></script>
<script src="{#icdn}public/mui/js/index.js"></script>
</head><body>
<div id="switcher">
<div class="center">
<ul><li class="logoTop" id="sj2"><a href="/">{lag 首页}</a></li>
<div id="Device">
<li class="device-monitor"><a href="javascript:">
<div class="icon-monitor">
</div></a></li>
<li class="device-mobile"><a href="javascript:">
<div class="icon-tablet">
</div>
</a></li>
<li class="device-mobile"><a href="javascript:">
<div class="icon-mobile-1">
</div>
</a></li>
<li class="device-mobile-2"><a href="javascript:">
<div class="icon-mobile-2">
</div>
</a></li>
<li class="device-mobile-3"><a href="javascript:">
<div class="icon-mobile-3">
</div>
</a></li>
</div>
<li class="top2" id="sj"><a href="#">{lag 手机二维码预览}</a><div class="vm">
<div id="output"></div>
<p style="color: #808080">{lag 扫一扫，直接在手机上打开}</p>
</div>
</li>
<script>jQuery('#output').qrcode({ width: 150, height: 150, text: window.location.href });</script>
</ul>
</div>
</div>
<div id="iframe-wrap" class="mobile-width-2">
<iframe id="iframe" src="/mui/index.html" frameborder="0" width="100%"></iframe>
</div>
</body></html>