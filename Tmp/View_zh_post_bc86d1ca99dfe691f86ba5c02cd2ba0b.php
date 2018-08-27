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
<script>var www="/"; var exp="/";</script></head>
 <?php $i=0;$pagetime=0; ?>
<div class="wrapper">
  <header class="top-nav">
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

  <div class="main-container">
    <style>
    .table-striped>tbody>tr {
      cursor: pointer;
    }
    </style>
    <div class="padding-md">
     
      <form action="" method="post">
        <input type="hidden" name="gn" value="del">
        <div class="table-responsive">
          <table class="table table-striped table-bordered m-top-md" id="dataTable">
            <thead>
              <tr class="bg-dark-blue">
                <th>
                  <div class="custom-checkbox">
                    <input type="checkbox" id="chkx" onclick="if($(this).is(':checked'))$('.checkboxx').prop('checked','checked'); else $('.checkboxx').attr('checked',false);">
                    <label for="chkx"></label>
                  </div>
                </th>
                <th>id</th>
                <th width="60%">内容</th>
                
                <th>时间</th>
                <th>子评论</th>
                <th>赞/踩</th>
    
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $v): ?><?php $i++;$pagetime=$v['btime'];?>
              <tr>
                <td>
                  <div class="custom-checkbox">
                    <input name="id[]" value="<?php echo $v['id'];?>" class="checkboxx" type="checkbox" id="chk<?php echo $v['pid'];?>">
                    <label for="chk<?php echo $v['pid'];?>"></label>
                  </div>
                </td>
                <td><?php echo $v['id'];?></td>
                
                <td><?php echo $v['content'];?><br /><?php echo $v['user'];?><small class="badge badge-success badge-square bounceIn animation-delay2 m-left-xs pull-right"><?php echo $v['uid'];?></small>  <p><a  href="/t/<?php echo $v['tid'];?>.html" target="_blank">查看详细内容</a></p></td>
                
                <td>
                  <p>发表：<?php echo date("Y-m-d H:i:s",$v['atime']); ?></p>
                  <p>排序：<?php echo date("Y-m-d H:i:s",$v['btime']); ?></p>
                  
                </td>
                <td>
                  <p><?php echo $v['posts'];?></p>
                  
                  
                </td>
                <td>
                  <?php echo $v['goods'];?>/<?php echo $v['nos'];?>
                </td>
                
                
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <div class="smart-widget-body">
          <div class="row">
            
            <div class="col-md-12">
              <button class="btn btn-danger">删除 (不可恢复)</button>
            </div>
          </div>
        </div>
      </form>
      <div class="smart-widget-body">
<?php if ($i>9): ?><a href="/admin/post/<?php echo $pagetime;?>.html" class="btn btn-primary btn-lg btn-block">下一页<i class="fa fa-angle-double-right m-left-xs"></i></a><?php else: ?><button class="btn btn-lg btn-block">完毕</button><?php endif ?>

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
