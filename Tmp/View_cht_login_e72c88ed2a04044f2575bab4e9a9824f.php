<?php !defined('YS_PATH') && exit('YS_PATH not defined.'); ?>
<!DOCTYPE html><html lang="zh-Hant"><head>
<meta charset="utf-8">
<title>YSPHP_管理平台</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit" />
<meta name="viewport" content="width=device-width, user-scalable=yes" />
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="/favicon.ico">
<link href="/public/bootstrap/css/bootstrap.min.css?1.1.1" rel="stylesheet">
<link href="/public/font-awesome/font-awesome.min.css?1.1.1" rel="stylesheet">
<link href="/public/css/alert.css?1.1.1" rel="stylesheet">
<link href="/public/simplify/simplify.min.css?1.1.1" rel="stylesheet">
<script>var www="/"; var exp="/";</script></head>
<div class="modal fade lock-screen-wrapper" id="lockScreen">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-body">
 <div class="lock-screen-img">
  <img src="http://zh.test.com/upload/<?php echo $user['avatar'];?>">
 </div>
 <div class="text-center m-top-sm">
  <div class="h4 text-white"><?php echo $user['user'];?></div>
  <?php if (isset($info)): ?><b style="color:#FF0000"><?php echo $info;?></b><?php endif ?>
   <form action="/admin/login" method="POST">
  <div class="input-group m-top-sm">
  <span class="input-group-btn">
   
   <a class="btn btn-info" href="/"><i class="fa fa-home"></i> </a>
  </span>
  <input type="password" name="pass" class="form-control text-sm" placeholder="密碼">
  <span class="input-group-btn">
   <button class="btn btn-success">
   <i class="fa fa-arrow-right"></i>
   </button>
  </span>
  </div>
   </form>
 </div>
 </div>
 </div>
 </div>
</div>
<script src="/public/js/jquery.min.js?1.1.1"></script>
<script src="/public/bootstrap/js/bootstrap.min.js?1.1.1"></script>
<script src='/public/js/jquery.slimscroll.min.js?1.1.1'></script>
<script src="/public/js/simplify.js?1.1.1"></script>
<script src="/public/js/sweet-alert.min.js?1.1.1"></script>
<script>$(function(){
$('#lockScreen').modal({
show: true,backdrop: 'static'})});</script></body></html>

