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
<div class="container">
 <div id="main">
 <div class="wrap-box">
 <h1>用户登录</h1>
 <div class="head c"><img id="img" src="/public/img/user.png" alt="头像" class="circle js-info" width="50" height="50"/></div>
 <form id="form">
 <label for="user" style="margin-top:0">账户</label>
 <input type="text" id="user" name="user" class="input-text" value=""/>
 <label for="pass" style="margin-top:0">密码</label>
 <input type="password" id="pass" name="pass" value="" class="input-text"/>
 <div class="submit">
 <input id="login" type="submit" value="登录" class="btn btn-primary">
 </div>
 <p><a href="/user/add" class="btn btn-success">注册</a>&nbsp;<a href="/user/repass" class="btn btn-success">忘记密码?</a></p>
 </form></div>
  <div class="wrap-box">

  </div>
 
 </div><div id="right-bar">
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
</div></div>
<script>
$(function(){
$("#user").blur(function(){
 $.get("/ajax/useravatar",{user:$(this).val()},function(e){
 if(e.avatar){
 $("#img").attr('src','http://zh.test.com/upload/'+e.avatar+'_150');
 }
 },'json');
 });
 $('#form').submit(function() {return false;});
 $("#login").click(function(){
 var postdata = $('#form').serialize();
 $.post("/user/login", postdata, function(e){
 if(e.code==200){
 if(e.url !='')
  window.location.href=e.url;
 else
  window.location.href="/";
 }else{
 swal(e.error ? "成功" : "失败", e.info, e.error ? "success" : "error");
 }
 },'json');
 })
});
</script>
</body>
</html>
