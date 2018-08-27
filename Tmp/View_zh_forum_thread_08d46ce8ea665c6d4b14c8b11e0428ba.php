<?php !defined('YS_PATH') && exit('YS_PATH not defined.'); ?>
<!DOCTYPE html><html lang="zh-Hans"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="renderer" content="webkit" /><meta name="viewport" content="width=device-width, user-scalable=yes" /><title><?php echo $title;?></title><?php if (isset($m_key)): ?><meta content="<?php echo $m_key;?>" name="keywords" /><?php endif ?><?php if (isset($urlhz)): ?><?php foreach ($langa as $k=>$v): ?><link rel="alternate" href="//<?php echo $k;?>.test.com<?php echo $urlhz;?>" hreflang="<?php echo $v[0];?>" /><?php endforeach ?><?php endif ?><?php if (isset($m_img)): ?><meta property="og:image" content="<?php echo $m_img;?>" /><?php endif ?><meta property="og:title" content="<?php echo $title;?>" /><meta property="og:site_name" content="YSV8"/><meta property="og:type" content="article" /><?php if (isset($m_ca)): ?><link rel="canonical" href="<?php echo $m_ca;?>"/><meta property="og:url" content="<?php echo $m_ca;?>" /><?php else: ?><meta property="og:url" content="//<?php echo $_SERVER['HTTP_HOST'];?><?php echo $_SERVER['REQUEST_URI'];?>" /><?php endif ?><?php if (isset($m_des)): ?><meta content="<?php echo $m_des;?>" name="description" /><meta property="og:description" content="<?php echo $m_des;?>" /><?php endif ?><link rel="icon" href="/favicon.ico" type="image/x-icon"/><link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/><link rel="apple-touch-icon" sizes="64x64" href="http://zh.test.com/upload/logo/favicon.png" /><?php if (isset($xml)): ?><link rel="alternate" type="application/rss+xml" title="<?php echo $title;?>" href="<?php echo $xml;?>" /><?php endif ?><?php if (isset($m_vod)): ?><meta property="og:videosrc" content="<?php echo $m_vod;?>" /><?php endif ?><?php if (isset($m_amp)): ?><link rel="amphtml" href="<?php echo $m_amp;?>"><?php endif ?><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><script>(adsbygoogle = window.adsbygoogle || []).push({
google_ad_client: "ca-pub-2005983165848766",enable_page_level_ads: true});</script><?php if (isset($json)): ?><script type="application/ld+json"><?php echo $json;?></script><?php endif ?><script>var www = "/";var bucketcdn = "http://zh.test.com/upload/";var exp = "/";var lang = "zh";var <?php if (IS_LOGIN): ?>islogin=true;<?php else: ?>islogin=false;<?php endif ?></script><script src="/fy.js?1.1.1"></script>
<script src="/public/js/jquery.min.js?1.1.1"></script>
<script src="/public/pc/app.js?1.1.1"></script>
<script src="/public/js/app.js?1.1.1"></script>
<link href="/public/font-awesome/font-awesome.min.css?1.1.1" rel="stylesheet">
<link href="/public/bootstrap/css/bootstrap.min.css?1.1.1" rel="stylesheet">
<link href="/public/css/app.css?1.1.1" rel="stylesheet">
<link href="/public/pc/app.css?1.1.1" rel="stylesheet">
<link href="/public/css/guide.css?1.1.1" rel="stylesheet">
<script src="/public/sweetalert/sweet-alert.min.js?1.1.1"></script>
<link href="/public/sweetalert/sweetalert.css?1.1.1" rel="stylesheet">
<?php if (IS_LOGIN): ?><link href="/public/css/friend.css?1.1.1" rel="stylesheet"><script src="/public/js/friend.js?1.1.1"></script><?php endif ?></head><body><div class="navbar select-disabled shadow" style="position: fixed;width: 100%;z-index:1000"><div class="container clearfix"><div class="menu horizontal pull-left nav-menu"><a href="/">主页</a><a href="/admin/">管理</a></div><div class="menu horizontal nav-account"><?php if (!IS_LOGIN): ?><a href="/user/add" class="js-popup-register">注册</a><a href="/user/login" class="js-popup-login">登录</a><?php else: ?><a href="javascript:void(0);" class="menu-box" pos="bottom"><img style="border-radius:50%;vertical-align: middle;" width="40" height="40" src="http://zh.test.com/upload/<?php echo $user['avatar'];?>" alt="<?php echo $user['user'];?>"><span class="xx " style="<?php if (!$user['mess']): ?>display:none<?php endif ?>"><?php echo $user['mess'];?></span></a><?php endif ?></div></div></div><div style="height:62px"></div>
 <?php $i=0;$pagetime=0; ?>
<div class="container">
<div id="main">
<div class="wrap-box"><ol><li><a href="/">首页</a></li></ol><div class="pull-right"><a href="/post/<?php echo $fdata['id'];?>.html">发布主题</a></div></div>
<div class="wrap-box"><div class="row menus"><li class="col-xs-3 c<?php if ($mode==0): ?> active<?php endif ?>"><a href="/Forum/<?php echo METHOD_NAME;?>.html">首页</a></li><li class="col-xs-3 c<?php if ($mode==1): ?> active<?php endif ?>"><a href="/Forum/<?php echo METHOD_NAME;?>/1.html">图片</a></li><li class="col-xs-3 c<?php if ($mode==2): ?> active<?php endif ?>"><a href="/Forum/<?php echo METHOD_NAME;?>/2.html">附件</a></li><li class="col-xs-3 c<?php if ($mode==3): ?> active<?php endif ?>"><a href="/Forum/<?php echo METHOD_NAME;?>/3.html">视频</a></li></ul></div></div>
<div class="wrap-box t-list"><div class="list" id="maincontent"><?php if ($data): ?><?php foreach ($data as $v): ?><?php $i++;$pagetime=$v['btime'];?>
<div class="item"><a href="/u/<?php echo urlencode($v['user']); ?>/thread.html" target="_blank"><img src="http://zh.test.com/upload/<?php echo $v['avatar'];?>_50" width="50" height="50" data-uid="<?php echo $v['uid'];?>" class="circle pull-left js-info" alt="<?php echo $v['user'];?>"></a><div class="middle text"><h4 class="title"><a href="/t/<?php echo $v['id'];?>.html" ><?php echo $v['title'];?></a><?php if ($v['mode']==2): ?>&nbsp;<b class="fa fa-paperclip"></b><?php endif ?></h4><?php if ($v['img']): ?><?php if ($v['vs']): ?><p><video src="<?php echo turl($v['vs']); ?>" controls="controls" preload="none" poster="<?php echo echoimg1($v['img']);?>"></video></p><?php else: ?><p><?php echoimg($v['img']); ?></p><?php endif ?><?php else: ?><?php if ($v['vs']): ?><p><video src="http://zh.test.com/upload/<?php echo $v['vs'];?>" controls="controls" preload="none" poster="http://zh.test.com/upload/<?php echo $v['vs'];?>?x-oss-process=video/snapshot,t_1000,f_jpg,m_fast"></video></p><?php endif ?><?php endif ?> <div class="meta"><a href="/u/<?php echo urlencode($v['user']); ?>/thread.html" class="author" target="_blank"><?php echo $v['user'];?></a>·&nbsp;&nbsp;<?php echo humandate($v['atime']); ?>&nbsp;&nbsp;<?php if (isset($v['buser'])): ?>·&nbsp;&nbsp;<?php echo $v['buser'];?>&nbsp;&nbsp;·&nbsp;&nbsp;回复 <?php echo humandate($v['btime']); ?><?php endif ?></div></div>
<?php if ($v['posts']): ?><a href="/t/<?php echo $v['id'];?>.html#comment" class="comment" ><span class="badge <?php if (($v['btime']+1800) > NOW_TIME): ?>badge-success<?php endif ?>"><?php echo $v['posts'];?></span></a><?php endif ?></div>
<?php endforeach ?><?php else: ?><div class="c">空</div><?php endif ?></div></div><div class="wrap-box"><div class="social-share"><button class="fa fa-weibo" onclick="share('weibo')"></button><button class="fa fa-google-plus" onclick="share('google')"></button><button class="fa fa-facebook" onclick="share('facebook')"></button><button class="fa fa-pinterest-square" onclick="share('qzone')"></button><button class="fa fa-digg" onclick="share('digg')"></button><button class="fa fa-linkedin" onclick="share('linkedin')"></button><button class="fa fa-skype" onclick="share('skype')"></button><button class="fa fa-twitter" onclick="share('twitter')"></button><button class="fa fa-qq" onclick="share('qq')"></button><button class="fa fa-heart" onclick="share('fav')"></button><button class="fa fa-qrcode" onclick="share('qrcode')"></button><button class="fa fa-copy" onclick="share('copy')"></button></div>
</div><div class="wrap-box"><?php if ($i>9): ?><a href="/f/<?php echo $fdata['id'];?>/<?php echo $mode;?>/<?php echo $pagetime;?>.html" class="btn btn-primary btn-lg btn-block" id="getmore">下一页</a><?php else: ?><a class="btn btn-lg btn-block" id="getmore" href="/">首页</a><?php endif ?></div></div>
<div id="right-bar">
<div class="right-widget only-logo"><div class="head" style="text-align:center"><a href="//www.test.com?no=1" class="btn btn-primary">language</a></div></div>
<div class="widget-docs-search shadow"><div class="inner"><form method="get" action="/search" style="margin-bottom:0;position: relative;"><input type="text" name="q" value="" class="h-scanfin" placeholder="搜索"><button class="fa fa-searc h-scanf"></button></form></div></div>
<div class="right-widget only-logo">
<div class="head">栏目<a href="/f.html" class="pull-right js-tooltip">更多</a></div>
<?php if (isset($forum) and $forum): ?><div class="row"><?php foreach ($forum as $v): ?><div class="col-xs-6 c"><div class="fmore"><a href="/f/<?php echo $v['id'];?>.html"><img src="http://zh.test.com/upload/<?php echo $v['img'];?>" class="circle" width="50" height="50"><br><?php echo $v['name'];?></a></div></div><?php endforeach ?></div><?php endif ?>
</div>
<div class="right-widget only-logo">
<div class="head">内容联盟<a href="https://zh.ysv8.com" class="pull-right js-tooltip">地球城</a></div>
<a href="https://github.com/09net/yswxapp" target="_blank">
<img src="http://zh.test.com/upload/9fe/e16c6d5043524deb4dccc4bf3e85c24de2af47a7.jpg" alt="广告" width="300px" height="300px"/><p class="c">微信扫一扫&nbsp;&nbsp;内涵GIF笑话</p></a>
</div>

<div class="rFixedBox" style="position: static; top: 0px;"><div><a href="https://jq.qq.com/?_wv=1027&k=5dN9I8k" target="_blank" rel="nofollow"><img src="http://zh.test.com/upload/727/e71d89323c05a1e8561e86cf14b11a783c6824c9.png" alt="广告" width="300px" height="300px"/><p class="c">QQ 群:835232190</p></a></div></div>
</div></div><script src="/public/js/foot.js"></script><div class="guide"><div class="guide-wrap"><a href="/post.html" class="edit"><span>发帖</span></a><a href="/search" class="find"><span>搜索</span></a><a href="/app.html" class="report"><span>APP</span></a><a href="javascript:window.scrollTo(0,0)" class="top"><span>回顶部</span></a></div></div><div id="footer"><span class="beian" style="margin-left:0">Powered by <a href="http://www.44api.com">YSPHP</a></span></div><?php if (IS_LOGIN): ?><div class="friend-box"><audio id="play-msg"><source src="/public/mp3/msg.mp3" type="audio/mp3"></audio><audio id="play-system"><source src="/public/mp3/system.mp3" type="audio/mp3"></audio>
<div class="friend-box-close" onclick="$('.friend-box').toggleClass('friend-box-a')">×</div><div class="friend-info-box"><img src="http://zh.test.com/upload/<?php echo $user['avatar'];?>_50"><h2><?php echo $user['user'];?></h2>
<p><span class="badge badge-purple bounceIn animation-delay2" style="font-size: 14px;font-weight: 400;background: cadetblue;"><?php echo $user['grouptext'];?></span></p>
<p><a href="/u/<?php echo urlencode($user['user']);?>.html">个人中心</a><span>|</span><a href="/user/out">退出</a></p>
<p><a href="javascript:void(0);" onclick="clear_mess()">清空未读</a></p></div>
<script><?php if (IS_LOGIN): ?>
window.YS_user = "<?php echo $user['user'];?>";
window.YS_avatar ="http://zh.test.com/upload/<?php echo $user['avatar'];?>";<?php else: ?>window.YS_user = '';
window.YS_avatar = '';
<?php endif ?>$(function(){
load_friend();
})</script><div class="friend-div-box"><input type="text" class="friend-text" placeholder="搜索">
<img src="/public/img/cog.png" style="padding-top: 7px;padding-left: 7px;font-size: 18px;display: inline-block;"></span></div><div class="friend-title">关注列表 +</div>
<div class="friend-div-box">
<ul class="friend-ul" id="friend-1">
<li><a onclick="new_chat('title','ssss',444,465,0,'系统','/public/img/bell.png','信息')" class="clearfix">
<img src="/public/img/bell.png" class="img-circle" alt="user avatar">
<div class="chat-detail m-left-sm">
<div class="chat-name">系统</div>
<div class="chat-message">消息</div>
</div>
<div class="chat-status"><span class="friend-zx"></span></div>
<div class="chat-alert"><span id="friend-span-0" class="badge badge-purple bounceIn animation-delay2 friend-hide">0</span></div></a></li></ul></div>
<div class="friend-title">粉丝 +</div>
<div class="friend-div-box"><ul class="friend-ul" id="friend-3"></ul></div>
<div class="friend-title">陌生人 +
</div><div class="friend-div-box"><ul class="friend-ul" id="friend-0"> </ul></div></div>
<script>$(function(){
$(".friend-title").click(function(){
$(this).next().toggleClass('friend-div-box-hide');
})
})</script><?php endif ?></body></html>