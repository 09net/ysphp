<?php !defined('YS_PATH') && exit('YS_PATH not defined.'); ?>
<!DOCTYPE html><html lang="zh-Hans"><head>
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
<script>var www="/"; var exp="/";</script></head><div class="wrapper"><header class="top-nav">
 <div class="top-nav-inner">
 <div class="nav-header">
  <button type="button" class="navbar-toggle pull-left sidebar-toggle" id="sidebarToggleSM">
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  </button>

  <ul class="nav-notification pull-right">
  <li>
   <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog fa-lg"></i></a>
   <span class="badge badge-danger bounceIn">1</span>
   <ul class="dropdown-menu dropdown-sm pull-right user-dropdown">
   <li class="user-avatar">
    <img src="http://zh.test.com/upload/<?php echo $user['avatar'];?>" class="img-circle">
    <div class="user-content">
    <h5 class="no-m-bottom"><?php echo $user['user'];?></h5>
    <div class="m-top-xs">
     <a href="/" class="m-right-sm">返回</a>
     <a href="/admin/out">退出</a>
    </div>
    </div>
   </li>
   <li>
    <a href="/admin">
    主页
    <span class="badge badge-danger bounceIn animation-delay2 pull-right">1</span>
    </a>
   </li>

   <li class="divider"></li>
   <li>
    <a href="/admin/op">设置</a>
   </li>
   </ul>
  </li>
  </ul>
<a href="https://www.44api.com" class="brand"><span class="brand-name">YSphp</span></a>
 </div>
 <div class="nav-container">
  <button type="button" class="navbar-toggle pull-left sidebar-toggle" id="sidebarToggleLG">
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  </button>
  <ul class="nav-notification">
  <li class="search-list">
   <div class="search-input-wrapper">
   <div class="search-input">
    <input type="text" class="form-control input-sm inline-block">
    <a href="#" class="input-icon text-normal"><i class="ion-ios7-search-strong"></i></a>
   </div>
   </div>
  </li>
  </ul>
  <div class="pull-right m-right-sm">
  <div class="user-block hidden-xs">
   <a href="#" id="userToggle" data-toggle="dropdown">
   <img src="http://zh.test.com/upload/<?php echo $user['avatar'];?>" alt="" class="img-circle inline-block user-profile-pic">
   <div class="user-detail inline-block">
    <?php echo $user['user'];?>
    <i class="fa fa-angle-down"></i>
   </div>
   </a>
   <div class="panel border dropdown-menu user-panel">
   <div class="panel-body paddingTB-sm">
    <ul>

    <li>
     <a href="/">
     <i class="fa fa-inbox fa-lg"></i><span class="m-left-xs">首页</span>
     
     </a>
    </li>
    <li>
     <a href="/admin/out">
     <i class="fa fa-power-off fa-lg"></i><span class="m-left-xs">退出</span>
     </a>
    </li>
    </ul>
   </div>
   </div>
  </div>

  </div>
 </div>
 </div>
</header>

<script>
function save_op(){
 var data = $("#save_op").serialize();
 $.ajax({
 url:window.location.href,
 type:'post',
 data:data,
 dataType:'json',
 success:function(e){
 $("#submit_button").text(e.info);
 },
 error:function(){
 $("#submit_button").text('访问本地服务器出错');
 }

 })
 return false;
 }
 </script>
 <div class="main-container">
 <div class="padding-md">
 <h2 class="header-text">
 设置
 </h2>
 <form method="POST" class="form-horizontal no-margin form-border" id="save_op" onsubmit="return save_op();">
 <div class="smart-widget">
 <div class="smart-widget-inner">
 <ul class="nav nav-tabs tab-style2">
 <li class="active">
 <a href="#style2Tab1" data-toggle="tab">
 <span class="icon-wrapper"><i class="fa fa-bar-chart-o"></i></span>
 <span class="text-wrapper">基本设置</span>
 </a>
 </li>
 <li>
 <a href="#user" data-toggle="tab">
 <span class="icon-wrapper"><i class="fa fa-user"></i></span>
 <span class="text-wrapper">用户</span>
 </a>
 </li>
 <li class="">
 <a href="#style2Tab2" data-toggle="tab">
 <span class="icon-wrapper"><i class="fa fa-book"></i></span>
 <span class="text-wrapper">主题</span>
 </a>
 </li>
 <li>
 <a href="#style2Tab5" data-toggle="tab">
 <span class="icon-wrapper"><i class="fa fa-street-view"></i></span>
 <span class="text-wrapper">发帖</span>
 </a>
 </li>
 <li>
 <a href="#style2Tab6" data-toggle="tab">
 <span class="icon-wrapper"><i class="fa fa-upload"></i></span>
 <span class="text-wrapper">上传</span>
 </a>
 </li>
 <li>
 <a href="#style2Tab7" data-toggle="tab">
 <span class="icon-wrapper"><i class="fa fa-at"></i></span>
 <span class="text-wrapper">邮箱</span>
 </a>
 </li>
 <li>
 <a href="#style2Tab8" data-toggle="tab">
 <span class="icon-wrapper"><i class="fa fa-database"></i></span>
 <span class="text-wrapper">数据缓存</span>
 </a>
 </li>
 <li>
 <a href="#style2Tab9" data-toggle="tab">
 <span class="icon-wrapper"><i class="fa fa-bug"></i></span>
 <span class="text-wrapper">运营</span>
 </a>
 </li>
 <li>
 <a href="#style2Tab10" data-toggle="tab">
 <span class="icon-wrapper"><i class="fa fa-bug"></i></span>
 <span class="text-wrapper">加速</span>
 </a>
 </li>
  <li>
 <a href="#style2Tab11" data-toggle="tab">
 <span class="icon-wrapper"><i class="fa fa-bug"></i></span>
 <span class="text-wrapper">微信小程序</span>
 </a>
 </li>
 
 </ul>
 <div class="smart-widget-body">
 <div class="tab-content">
 <div class="tab-pane fade active in" id="style2Tab1">
 <div class="form-group">
 <label class="col-lg-2 control-label">授权</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="token" value="<?php echo $conf['token'];?>">
 <span class="help-block">获取<a href="https://www.ysv8.com/myweb/tk" target="_blank">https://www.ysv8.com/myweb/tk</a></span>
 </div>
 </div>

 <div class="form-group">
 <label class="col-lg-2 control-label">网站标题</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="title" value="<?php echo $conf['title'];?>">
 <span class="help-block">这是你的首页标题.</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">网站LOGO文字</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="logo" value="<?php echo $conf['logo'];?>">
 <span class="help-block">在模板中显示的LOGO 文字.</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">网站关键字</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="keywords" value="<?php echo $conf['keywords'];?>">
 <span class="help-block">这将是你的首页keyword.</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">网站描述</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="de" value="<?php echo $conf['description'];?>">
 <span class="help-block">这将是你的首页description.</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">网站标题尾巴</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="title2" value="<?php echo $conf['title2'];?>">
 <span class="help-block">每个页面的标题后缀</span>
 </div>
 </div>

 
 </div>
 <div class="tab-pane fade active in" id="user">
 <div class="form-group">
 <label class="col-lg-2 control-label">默认用户组</label>
 <div class="col-lg-10">
 <select class="form-control" name="usergroup">
 <?php foreach ($usergroup as $v): ?>
 <option value="<?php echo $v['id'];?>" <?php if ($v['id']==$conf['usergroup']): ?>selected="selected"<?php endif ?>><?php echo $v['name'];?></option>
 <?php endforeach ?>
 </select>
 <span class="help-block">控制新用户的权限</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">敏感词</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="badword" value="<?php echo $conf['badword'];?>">
 <span class="help-block">禁止用户账号携带敏感词注册,每个词请用小写,号分隔</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">找回密码邮件标题</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="emailtitle" value="<?php echo $conf['emailtitle'];?>">
 <span class="help-block">发送找回密码邮件给用户时,邮件标题名称从此项获取 默认为: HYBBS找回密码验证码邮件</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">发送找回密码邮箱模板</label>
 <div class="col-lg-10">
 <textarea class="form-control" name="emailcontent"><?php echo $conf['emailcontent'];?></textarea>
 <span class="help-block">请根据默认的内容去修改! 需要注意%s, 第一个%s会转换为用户名 第二个%s将是验证码. 模板支持HTML代码</span>
 </div>
 </div>

 <div class="form-group">
 <label class="col-lg-2 control-label">找回密码间隔</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="send_email_s" value="<?php echo $conf['send_email_s'];?>">
 <span class="help-block">发送邮件找回密码 间隔时间(秒)</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">离线判断</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="out_s" value="<?php echo $conf['out_s'];?>">
 <span class="help-block">超出N秒不访问论坛 判断为离线，建议设置为300. 则是5分钟不访问则判断为离线用户</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">系统提示音</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="mp3_system" value="<?php echo $conf['mp3_system'];?>">
 <span class="help-block">系统消息提示音路径, 默认:public/mp3/system.mp3</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">好友提示音</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="mp3_friend" value="<?php echo $conf['mp3_friend'];?>">
 <span class="help-block">默认:public/mp3/msg.mp3</span>
 </div>
 </div>

 </div>
 <div class="tab-pane fade" id="style2Tab2">
 <div class="form-group">
 <label class="col-lg-2 control-label">附件</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="fgold" value="<?php echo $conf['fgold'];?>">
 <span class="help-block">附件下载所需金币</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">标题最大长度</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="titlesize" value="<?php echo $conf['titlesize'];?>">
 <span class="help-block">默认 : 128</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">标题最小长度</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="titlemin" value="<?php echo $conf['titlemin'];?>">
 <span class="help-block">{默认 : 5</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">摘要长度</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="summary_size" value="<?php echo $conf['summary_size'];?>">
 <span class="help-block">默认: 200</span>
 </div>
 </div>




 <div class="form-group">
 <label class="col-lg-2 control-label">每次展示数据数量</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="listnum" value="<?php echo $conf['listnum'];?>">
 <span class="help-block">每次展示数据数量:10</span>
 </div>
 </div>
 
 
 
 </div>
 
 <!-- 帖子相关 -->
 <div class="tab-pane fade" id="style2Tab5">
 <div class="form-group">
 <label class="col-lg-2 control-label">发表主题增加金钱数</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="gold_thread" value="<?php echo $conf['gold_thread'];?>">
 <span class="help-block">用户发表主题增加金钱数</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">回复增加金钱数</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="gold_post" value="<?php echo $conf['gold_post'];?>">
 <span class="help-block">用户回复增加金钱数</span>
 </div>
 </div>

 <div class="form-group">
 <label class="col-lg-2 control-label">发表主题增加积分</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="credits_thread" value="<?php echo $conf['credits_thread'];?>">
 <span class="help-block">用户积分仅用于用户组升级以及后续额外功能</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">回复增加积分</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="credits_post" value="<?php echo $conf['credits_post'];?>">
 <span class="help-block">同上</span>
 </div>
 </div>
 
 </div>
 <!-- 上传设置 -->
 <div class="tab-pane fade" id="style2Tab6">
 <div class="form-group">
 <label class="col-lg-2 control-label">帖子图片列表保存个数</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="post_image_size" value="<?php echo $conf['post_image_size'];?>">
 <span class="help-block">储存展示缩略图个数, 如果模板有该功能</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">图片上传允许格式</label>
 <div class="col-lg-10">
 
 
 <input class="form-control" type="text" name="uploadimageext" value="<?php echo $conf['uploadimageext'];?>">
 <span class="help-block">请用 , 隔开</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">图片上传大小限制</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="uploadimagemax" value="<?php echo $conf['uploadimagemax'];?>">
 <span class="help-block">单位（ M ）.如输入3 则限制3M以下图片上传,输入0为无限制大小 , 如果是单位kb以下 请输入小数点 0.1 = 100kb</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">附件上传允许格式</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="uploadfileext" value="<?php echo $conf['uploadfileext'];?>">
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">附件上传大小限制</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="uploadfilemax" value="<?php echo $conf['uploadfilemax'];?>">
 <span class="help-block">单位（ M ）.如输入3 则限制3M以下附件上传，输入0为无限制大小</span>
 </div>
 </div>
 <h4>当前PHP.ini配置上传文件最大字节：<label class="label label-success"><?php echo ini_get('upload_max_filesize') ?></label> 与 POST提交字节最大限制为：<label class="label label-success"><?php echo ini_get('post_max_size') ?></label></h4><hr><h4>特别提醒，你在本页配置的限制只是局部的，全局控制上传大小在php.ini中修改！ 可在网上搜索一下 php.ini 上传大小限制</h4>
 <hr>PHP.ini <h4>upload_max_filesize : <label class="label label-success"><?php echo ini_get('upload_max_filesize') ?></label> </h4><h4>post_max_size : <label class="label label-success"><?php echo ini_get('post_max_size') ?></label></h4>
 </div>
 <!-- 邮箱设置 -->
 <div class="tab-pane fade" id="style2Tab7">
 <div class="form-group">
 <label class="col-lg-2 control-label">SMTP服务器地址</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="emailhost" value="<?php echo $conf['emailhost'];?>">
 <span class="help-block">这是你的服务器SMTP地址</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">SMTP服务器端口</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="emailport" value="<?php echo $conf['emailport'];?>">
 <span class="help-block">一般默认为:25</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">邮箱账号</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="emailuser" value="<?php echo $conf['emailuser'];?>">
 <span class="help-block">这是你的邮箱验证账号</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">邮箱密码</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="emailpass" value="<?php echo $conf['emailpass'];?>">
 <span class="help-block">现在使用SMTP的邮箱大多都采用了授权码,这里填写你的邮箱授权码,如果没有此类功能,请填写邮箱密码</span>
 </div>
 </div>
 </div>
 <!-- 缓存 -->
 <div class="tab-pane fade" id="style2Tab8">
 <div class="form-group">
 <label class="col-lg-2 control-label">缓存类型</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="cache_type" value="<?php echo $conf['cache_type'];?>">
 <span class="help-block">目前支持: Apachenote, Apc, db, file, Eacceleratpr, Memcache, Memcached, Redis, Shmop, Wincache, Xcache , 请选择一款你服务器支持的缓存扩展. </span>
 <span class="help-block">效率比较: File < DB < 内存缓存</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">DB缓存表</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="cache_table" value="<?php echo $conf['cache_table'];?>">
 <span class="help-block">当你使用DB缓存时,此项将生效. 输入一个数据表作为缓存表. 默认: cache (不建议更改)</span>
 
 </div>
 </div>
 
 <div class="form-group">
 <label class="col-lg-2 control-label">缓存加密KEY</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="cache_key" value="<?php echo $conf['cache_key'];?>">
 <span class="help-block">只有缓存类型为File才生效,主要用于加密缓存文件名,你可以随便输入几个字符保存即可!</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">缓存过期时间(秒)</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="cache_time" value="<?php echo $conf['cache_time'];?>">
 <span class="help-block">缓存的过期时间，输入0等于无限制缓存！</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">缓存前缀</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="cache_pr" value="<?php echo $conf['cache_pr'];?>">
 <span class="help-block">默认为空 , 不建议修改</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">缓存数据压缩</label>
 <div class="col-lg-10">
 <div class="checkbox inline-block">
 <div class="custom-checkbox">
 <input type="checkbox" name="cache_ys" id="inlineCheckbox1" class="checkbox-red" <?php if ($conf['cache_ys'] == 'on'): ?>checked="checked"<?php endif ?>>
 <label for="inlineCheckbox1"></label>
 </div>
 <div class="inline-block vertical-top">
 压缩缓存数据
 </div>
 </div>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">缓存服务器连接超时(秒)</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="cache_outtime" value="<?php echo $conf['cache_outtime'];?>">
 <span class="help-block">当使用缓存服务器时生效,连接缓存服务器超时时间</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">Redis 服务器地址</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="cache_redis_ip" value="<?php echo $conf['cache_redis_ip'];?>">
 <span class="help-block">当你的缓存类型为Redis时使用</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">Redis 服务器端口</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="cache_redis_port" value="<?php echo $conf['cache_redis_port'];?>">
 <span class="help-block">当你的缓存类型为Redis时使用</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">Memcache 服务器地址</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="cache_mem_ip" value="<?php echo $conf['cache_mem_ip'];?>">
 <span class="help-block">当你的缓存类型为Memcache时使用</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">Memcache 服务器端口</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="cache_mem_port" value="<?php echo $conf['cache_mem_port'];?>">
 <span class="help-block">当你的缓存类型为Memcache时使用</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">Memcached 服务器分布IP</label>
 <div class="col-lg-10">
 <textarea rows="4" name="cache_memd_ip" class="form-control"><?php echo $conf['cache_memd_ip'];?></textarea>
 <span class="help-block">Memcache 负载均衡,多台服务器配置,参数配置: IP:端口:调用权重, 多台换行配置 例: 127.0.0.1:11211:33</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">Memcached 配置参数</label>
 <div class="col-lg-10">
 请到Config.php 手动配置 MEMCACHED_LIB
 </div>
 </div>


 </div>
 
 
 
 
 
 
 <div class="tab-pane fade" id="style2Tab10">
 <div class="form-group">
 <label class="col-lg-2 control-label">缩微图</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="bucketcdn" value="<?php echo $conf['bucketcdn'];?>">
 <span class="help-block">推荐:https://i.44api.com</span>
 
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">大图</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="imgcdn" value="<?php echo $conf['imgcdn'];?>">
 <span class="help-block">推荐:https://l.44api.com</span>
 
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">静态资源</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="icdn" value="<?php echo $conf['icdn'];?>">
 <span class="help-block">只有缓存类型为File才生效,主要用于加密缓存文件名,你可以随便输入几个字符保存即可!</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">OSS(阿里云)</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="OSS_ACCESS_ID" value="<?php echo $conf['OSS_ACCESS_ID'];?>">
 <span class="help-block">OSS_ACCESS_ID</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">KEY</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="OSS_ACCESS_KEY" value="<?php echo $conf['OSS_ACCESS_KEY'];?>">
 <span class="help-block">OSS_ACCESS_KEY</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">地址</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="OSS_ENDPOINT" value="<?php echo $conf['OSS_ENDPOINT'];?>">
 <span class="help-block">OSS_ENDPOINT</span>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">BUCKET</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="OSS_BUCKET" value="<?php echo $conf['OSS_BUCKET'];?>">
 <span class="help-block">OSS_BUCKET</span>
 </div>
 </div>


 </div>
 
   <div class="tab-pane fade" id="style2Tab11">
 <div class="form-group">
 <label class="col-lg-2 control-label">APPID</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="WX_APPID" value="<?php echo $conf['WX_APPID'];?>">
 <span class="help-block">xxxxx</span>
 
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label">AppSecret</label>
 <div class="col-lg-10">
 <input class="form-control" type="text" name="WX_AppSecret" value="<?php echo $conf['WX_AppSecret'];?>">
 <span class="help-block">xxxxx</span>
 
 </div>
 </div>
 </div>
 
 
 <div class="tab-pane fade" id="style2Tab9">
 <div class="form-group">
 <label class="col-lg-2 control-label"> 右下角调试窗口</label>
 <div class="col-lg-10">
 <div class="checkbox inline-block">
 <div class="custom-checkbox">
 <input type="checkbox" name="debug_page" id="inlineCheckbox3" class="checkbox-red" <?php if ($conf['debug_page']): ?>checked="checked"<?php endif ?>>
 <label for="inlineCheckbox3"></label>
 </div>
 <div class="inline-block vertical-top">
 网站上线请关闭
 </div>
 </div>
 </div>
 </div>
 
 <div class="form-group">
 <label class="col-lg-2 control-label">用户系统</label>
 <div class="col-lg-10">
 <div class="checkbox inline-block">
 <div class="custom-checkbox">
 <input type="checkbox" name="user_bool" id="inlineCheckbox2" class="checkbox-red" <?php if ($conf['user_bool']): ?>checked="checked"<?php endif ?>>
 <label for="inlineCheckbox2"></label>
 </div>
 <div class="inline-block vertical-top">
 是否允许用户注册及登陆
 </div>
 </div>
 </div>
 </div>
 
 <div class="form-group">
 <label class="col-lg-2 control-label">DEBUG</label>
 <div class="col-lg-10">
 <div class="checkbox inline-block">
 <div class="custom-checkbox">
 <input type="checkbox" name="debug" id="inlineCheckbox4" class="checkbox-red" <?php if (DEBUG): ?>checked="checked"<?php endif ?>>
 <label for="inlineCheckbox4"></label>
 </div>
 <div class="inline-block vertical-top">
手动配置YS/YS.php
 </div>
 </div>
 </div>
 </div>
 
 </div>

 </div>
 </div>
 </div>
 </div>
 <div class="form-group">
 <label class="col-lg-2 control-label"></label>
 <div class="col-lg-10">
 <button type="submit" class="btn btn-success" id="submit_button">保存配置</button>
 </div>
 </div>
 </form>
 </div>
 </div>
 <aside class="sidebar-menu fixed">
 <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
 <div class="sidebar-inner scrollable-sidebar" style="overflow: hidden; width: auto; height: 100%;">
 <div class="main-menu">
 <ul class="accordion">
 <li class="menu-header">
 菜单
 </li>
 <li class="bg-palette1 <?php if (METHOD_NAME == 'Index'): ?>active open<?php endif ?>">
 <a href="/admin">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-home fa-lg"></i></span>
 <span class="text m-left-sm">首页</span>
 </span>
 <span class="menu-content-hover block">
 首页
 </span>
 </a>
 </li>
 <li class="bg-palette4 <?php if (METHOD_NAME == 'Op'): ?>active open<?php endif ?>">
 <a href="/admin/op">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-cog fa-lg"></i></span>
 <span class="text m-left-sm">全局</span>
 </span>
 <span class="menu-content-hover block">
 全局
 </span>
 </a>
 </li>
 <li class="bg-palette2">
 <a href="/">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-desktop fa-lg"></i></span>
 <span class="text m-left-sm">网站首页</span>
 </span>
 <span class="menu-content-hover block">
 网站首页
 </span>
 </a>
 </li>
 <li class="openable bg-palette3 <?php if (METHOD_NAME == 'Forum_group' || METHOD_NAME == 'Forum' || METHOD_NAME == 'Forumg' || METHOD_NAME == 'Forum_json' ): ?>active open<?php endif ?>">
 <a href="#">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-list fa-lg"></i></span>
 <span class="text m-left-sm">板块分类</span>
 <span class="submenu-icon"></span>
 </span>
 <span class="menu-content-hover block">
 板块分类
 </span>
 </a>
 <ul class="submenu bg-palette4">
 <li><a <?php if (METHOD_NAME == 'Forum_group'): ?>class="active"<?php endif ?> href="/admin/forum_group" title="板块分组"><span class="submenu-label">大分组</span></a></li>
 <li><a <?php if (METHOD_NAME == 'Forum'): ?>class="active"<?php endif ?> href="/admin/forum" title="板块分类列表管理"><span class="submenu-label">分类管理</span></a></li>
 <li><a <?php if (METHOD_NAME == 'Forumg'): ?>class="active"<?php endif ?> href="/admin/forumg" title="板块分类 版主列表编辑"><span class="submenu-label">分类版主</span></a></li>
 <li><a <?php if (METHOD_NAME == 'Forum_json'): ?>class="active"<?php endif ?> href="/admin/forum_json" title="板块用户组列表权限控制"><span class="submenu-label">分类用户组权限</span></a></li>

 </ul>
 </li>
 <li class="openable bg-palette4 <?php if (METHOD_NAME == 'User' || METHOD_NAME == 'Usergroup'): ?>active open<?php endif ?>">
 <a href="#">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-users fa-lg"></i></span>
 <span class="text m-left-sm">用户管理</span>
 <span class="submenu-icon"></span>
 </span>
 <span class="menu-content-hover block">
 用户管理
 </span>
 </a>
 <ul class="submenu" style="display: none;">
 <li><a <?php if (METHOD_NAME == 'User'): ?>class="active"<?php endif ?> href="/admin/user"><span class="submenu-label">用户管理</span></a></li>

 </ul>
 </li>

 <li class="openable bg-palette3 <?php if (METHOD_NAME == 'Thread' || METHOD_NAME == 'Post' || METHOD_NAME == 'Post_post'): ?>active open<?php endif ?>">
 <a href="#">
 <span class="menu-content block">
 <span class="menu-icon">
 <i class="block fa fa-tags fa-lg"></i>
 </span>
 <span class="text m-left-sm">文章 & 评论</span>
 <span class="submenu-icon"></span>
 </span>
 <span class="menu-content-hover block">
 文章&评论
 </span>
 </a>
 <ul class="submenu" style="display: none;">
 <li><a <?php if (METHOD_NAME == 'Thread'): ?>class="active"<?php endif ?> href="/admin/Thread"><span class="submenu-label">文章管理</span></a></li>
 <li><a <?php if (METHOD_NAME == 'Post'): ?>class="active"<?php endif ?> href="/admin/Post"><span class="submenu-label">评论管理</span></a></li>
 </ul>
 </li>


 
 <li class="bg-palette2 <?php if (METHOD_NAME == 'Mykey'): ?>active open<?php endif ?>">
 <a href="/admin/mykey">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-paint-brush fa-lg"></i></span>
 <span class="text m-left-sm">分词</span>

 </span>
 <span class="menu-content-hover block">
 分词管理
 </span>
 </a>
 </li>
 <li class="bg-palette3 <?php if (METHOD_NAME == 'Fy'): ?>active open<?php endif ?>">
 <a href="/admin/fy">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-code fa-lg"></i></span>
 <span class="text m-left-sm"> 翻译管理</span>

 </span>
 <span class="menu-content-hover block">
 翻译管理
 </span>
 </a>
 </li>
 <li class="bg-palette4 <?php if (METHOD_NAME == 'Log'): ?>active open<?php endif ?>">
 <a href="/admin/log">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-cube fa-lg"></i></span>
 <span class="text m-left-sm">日志</span>

 </span>
 <span class="menu-content-hover block">
日志
 </span>
 </a>
 </li>
 </ul>
 </div>
 <div class="sidebar-fix-bottom clearfix">
 <div class="user-dropdown dropup pull-left">
 <a title="菜单" href="javascript:;" class="dropdwon-toggle font-18" data-toggle="dropdown">
 <i class="fa fa-flickr"></i>
 </a>
 <ul class="dropdown-menu">
 <li class="dropdown-header"><i class="fa fa-flickr"></i> 菜单</li>
 <li>
 <a href="javascript:;" onclick="delete_cache()">
 <i class="fa fa-trash"></i>清空文件缓存
 </a>
 </li>
 <li class="divider"></li>
 <li>
 <a href="/admin/op"><i class="fa fa-cog"></i>全局设置</a>
 </li> 
 </ul>
 </div>
 <a title="注销" href="/admin/out" class="pull-right font-18">
 <i class="fa fa-sign-out"></i>
 </a>
 </div>
 <script>
 function delete_cache(data){
 swal({
 title: "删除缓存",
 text: '确认删除文件缓存！',
 type: "warning",
 confirmButtonColor: "#DD6B55",
 confirmButtonText: "确定",
 cancelButtonText: '取消',
 //allowOutsideClick:false,
 showCancelButton: true,
 }).then(
 function() {
 $.ajax({
 url:'/admin',
 type:'post',
 data:data,
 dataType:'json',
 success:function(e){
 if(e.error){
 swal('成功',e.info,'success');
 }
 else{
 swal('错误',e.info,'error');
 }
 },error:function(e){

 }
 });
 },
 function(){

 }
 );
 }</script>
</div>
 <div class="slimScrollBar" style="width: 0px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 651px; background: rgb(0, 0, 0);"></div>
 <div class="slimScrollRail" style="width: 0px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div></aside>

</div>
<script src="/public/js/jquery.min.js?1.1.1"></script>
<script src="/public/bootstrap/js/bootstrap.min.js?1.1.1"></script>
<script src='/public/js/jquery.slimscroll.min.js?1.1.1'></script>
<script src="/public/js/simplify.js?1.1.1"></script>
<script src="/public/js/sweet-alert.min.js?1.1.1"></script>
<script>$(function(){
$('#lockScreen').modal({
show: true,backdrop: 'static'})});</script></body></html>

