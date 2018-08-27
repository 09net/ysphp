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
<div class="wrap-box">
<?php if (isset($fdata)): ?>
<ol><li><a href="/">首页</a></li><li class="fa fa-chevron-right"><a href="/f/<?php echo $fdata['id'];?>.html"><?php echo $fdata['name'];?></a></li><li class="fa fa-chevron-right">发布主题</li></ol>
<?php else: ?>
<ol><li><a href="/">首页</a></li><li class="fa fa-chevron-right">发布主题</li></ol>
<?php endif ?>
</div>
<div class="wrap-box">
<div class="row">
<div class="col-xs-3">
<?php if (isset($fdata)): ?><input id="fid" type="hidden" value="<?php echo $fdata['id'];?>" /><?php echo $fdata['name'];?><?php else: ?><select id="fid" type="text" class="input" style="width:150px;margin-bottom:10px"><option value="-1">选择</option><?php if ($forum): ?>
<?php foreach ($forum as $key => $v): ?><option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option><?php endforeach ?><?php endif ?></select><?php endif ?>
</div>
<div class="col-xs-9">
<input type="text" id="title" class="input-text " placeholder="请填写标题">
</div></div>
<label>内容 <span></span></label>
<script id="container" name="content" type="text/plain"></script>
<div class="wrap-box" style="margin-top:10px" id="upload">
<label for="fileTofUpload" class="btn btn-primary" ><i class="am-icon-check"></i>附件(50M,rar,zip,mp3,mp4)</label>
<label for="mp4up" class="btn btn-primary" ><i class="am-icon-check"></i>视频(50M,mp3,mp4)</label>
<input type="file" name="mp4up" id="mp4up" accept="audio/mp4,video/mp4,audio/mpeg" onChange="mp4up('uploadfiles','mp4up');" style="display: none;">
<input name="vs" id="vs" type="hidden" value="" />
<input type="file" name="fileTofUpload" id="fileTofUpload" onChange="fileSelected('uploadfiles','fileTofUpload');" style="display: none;">
<input name="files" id="files" type="hidden" value="" />
</div>

<button type="button" class="btn btn-primary" id="post1">发表</button>
<link href="/public/UMeditor/public/themes/default/css/umeditor.min.css" type="text/css" rel="stylesheet">
<link href="/public/UMeditor/style.css" type="text/css" rel="stylesheet">
<script src="/public/UMeditor/public/third-party/template.min.js"></script>
<script src="/public/UMeditor/public/umeditor.min.js"></script>
<script src="/public/UMeditor/public/umeditor.config.js"></script>
<script src="/public/UMeditor/edit_files.js"></script>
<script>
 var ue = UM.getEditor('container',
 {
 imageFieldName:'photo',
 initialFrameWidth:"100%",
 imageUrl: "/post/upload",
 imagePath:'',
 initialFrameHeight:300,
   toolbar: ['source | insertimage insertcode undo redo | bold  | removeformat |', 'insertorderedlist insertunorderedlist | selectall paragraph | fontfamily fontsize' ,'| justifyleft justifycenter justifyright justifyjustify |', 'link unlink | image','| preview print fullscreen hide drafts'],
 zIndex:9000,
 }
 );
 function postzhen(_obj){
 _obj.text("提交中");
 ue.execCommand('selectall');
 ue.execCommand('removeformat');
var getContent= formatImg(ue.getContent());
 var fid = $("#fid").val();
 if(fid<0){
  _obj.removeAttr('disabled');
 _obj.text("发表");
 swal("error", "小组为空", "error");
 }
 $.ajax({
 url: '/post.html',
 type:"POST",
 cache: false,
 data:{
 title:$("#title").val(),
 content:getContent,
 fid:fid,
 vs:$("#vs").val(),
 files:$("#files").val()
 },
 dataType: 'json'
 }).then(function(e) { 
 if(e.code==200){ 
 window.location.href="/t/"+e.id + ".html";
 }else{
 _obj.removeAttr('disabled');
 _obj.text("发表");
 swal(e.error?"成功":"失败", e.info, e.error?"success": "error");
 }
 }, function() {
 _obj.removeAttr('disabled');
 _obj.text("发表");
 swal("失败", "请重新提交", "error");
 });
 }
$(function(){
 $("#post1").click(function(){
 var _obj = $(this);
 _obj.attr('disabled','disabled');
 swal('上传图片')
 setTimeout(uppase(_obj,'container'),500)
 })
})
</script></div></div>
<div id="footer"><span class="beian" style="margin-left:0">Runtime:<?php echo number_format(microtime(1) - $GLOBALS['START_TIME'], 4); ?>s</span><span class="beian" style="margin-left:0">Mem:<?php echo round((memory_get_usage() - $GLOBALS['START_MEMORY'])/1024); ?>Kb</span> </div>