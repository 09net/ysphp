<!DOCTYPE html><html lang="{#HTML_LANG}"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="renderer" content="webkit" /><meta name="viewport" content="width=device-width, user-scalable=yes" />{include meta::index}<script>var www = "/";var bucketcdn = "{#bucketcdn}";var exp = "/";var lang = "{#NOW_LANG}";var {if IS_LOGIN}islogin=true;{else}islogin=false;{/if}</script><script src="/fy.js?{#YSPHP_VERSION}"></script>
<script src="{#icdn}public/js/jquery.min.js?{#YSPHP_VERSION}"></script>
<script src="{#icdn}public/pc/app.js?{#YSPHP_VERSION}"></script>
<script src="{#icdn}public/js/app.js?{#YSPHP_VERSION}"></script>
<link href="{#icdn}public/font-awesome/font-awesome.min.css?{#YSPHP_VERSION}" rel="stylesheet">
<link href="{#icdn}public/bootstrap/css/bootstrap.min.css?{#YSPHP_VERSION}" rel="stylesheet">
<link href="{#icdn}public/css/app.css?{#YSPHP_VERSION}" rel="stylesheet">
<link href="{#icdn}public/pc/app.css?{#YSPHP_VERSION}" rel="stylesheet">
<link href="{#icdn}public/css/guide.css?{#YSPHP_VERSION}" rel="stylesheet">
<script src="{#icdn}public/sweetalert/sweet-alert.min.js?{#YSPHP_VERSION}"></script>
<link href="{#icdn}public/sweetalert/sweetalert.css?{#YSPHP_VERSION}" rel="stylesheet">
{if IS_LOGIN}<link href="{#icdn}public/css/friend.css?{#YSPHP_VERSION}" rel="stylesheet"><script src="{#icdn}public/js/friend.js?{#YSPHP_VERSION}"></script>{/if}</head><body><div class="navbar select-disabled shadow" style="position: fixed;width: 100%;z-index:1000"><div class="container clearfix"><div class="menu horizontal pull-left nav-menu"><a href="/">{lag 主页}</a><a href="/admin/">{lag 管理}</a></div><div class="menu horizontal nav-account">{if !IS_LOGIN}<a href="/user/add" class="js-popup-register">{lag 注册}</a><a href="/user/login" class="js-popup-login">{lag 登录}</a>{else}<a href="javascript:void(0);" class="menu-box" pos="bottom"><img style="border-radius:50%;vertical-align: middle;" width="40" height="40" src="{#bucketcdn}{$user['avatar']}" alt="{$user['user']}"><span class="xx " style="{if !$user['mess']}display:none{/if}">{$user.mess}</span></a>{/if}</div></div></div><div style="height:62px"></div>