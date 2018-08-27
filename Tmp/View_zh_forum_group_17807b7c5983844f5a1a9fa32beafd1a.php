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

    <style>
    .gallery-list .gallery-item {
        position: relative;
        display: inline-block;
        width: 33%;
        padding: 2px;
    }
    .gallery-list .gallery-item .gallery-wrapper .gallery-title.action{
        background-color: #2baab1;
    }
    .gallery-list .gallery-item .gallery-wrapper .gallery-overlay .gallery-action.action {
        background-color: #2baab1;
    }
    </style>
    <div class="main-container">
        <div class="padding-md">
            <h2 class="header-text no-margin">
                板块分组
            </h2>
            <div class="gallery-filter m-top-md m-bottom-md">
                <ul class="clearfix">
                    <li class="active"><a href="javascript:void(0)" data-toggle="modal" data-target="#normalModal"><i class="fa fa-plus"></i> 添加分组</a></li>
                    
                    
                </ul>
            </div>

            <div class="smart-widget">
        		<div class="smart-widget-header">
        			分组 列表
        		</div>
                <div class="smart-widget-inner">
                    <div class="smart-widget-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>分组ID</th>
                                        <th>分组名称</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $v): ?>
                                    <tr>
                                        <td><?php echo $v['id'];?></td>
                                        <td><?php echo $v['name'];?></td>
                                        <td>
                                            <a onclick="edit_fg(<?php echo $v['id'];?>,'<?php echo $v['name'];?>')" class="btn btn-success btn-xs">编辑</a>
                                            <a onclick="del_fg(<?php echo $v['id'];?>)" class="btn btn-danger btn-xs">删除分组</a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        		
        	</div>
            <div class="row">
                <?php foreach ($data as $v): ?>
                <div class="col-md-6">
                    <div class="smart-widget">
                        <div class="smart-widget-header">
                            <?php echo $v['name'];?> - 分组
                        </div>
                        <div class="smart-widget-inner">
                            <div class="smart-widget-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>板块ID</th>
                                                <th>板块名称</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($forum_data as $vv): ?>
                                            <?php if ($vv['fgid'] == $v['id']): ?>
                                            <tr>
                                                <td><?php echo $vv['id'];?></td>
                                                <td><?php echo $vv['name'];?></td>
                                                <td><button onclick="move_fg(<?php echo $vv['id'];?>,<?php echo $v['id'];?>,'<?php echo $vv['name'];?>')" class="btn btn-success btn-xs">移动</button></td>
                                            </tr>
                                            <?php endif ?>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php endforeach ?>
                <div class="col-md-6">
                    <div class="smart-widget">
                        <div class="smart-widget-header">
                            未分组的分类 - 必须将分类分组 否则无法显示
                        </div>
                        <div class="smart-widget-inner">
                            <div class="smart-widget-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>板块ID</th>
                                                <th>板块名称</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($forum_data as $v): ?>
                                                <?php $has = false; ?>
                                                <?php foreach ($data as $vv): ?>
                                                    
                                                    <?php if ($v['fgid'] == $vv['id']): ?>
                                                        <?php $has = true;break; ?>
                                                    <?php endif ?>
                                                    
                                                <?php endforeach ?>
                                                <?php if (!$has): ?>
                                                    <tr>
                                                        <td><?php echo $v['id'];?></td>
                                                        <td><?php echo $v['name'];?></td>
                                                        <td><button onclick="move_fg(<?php echo $v['id'];?>,<?php echo $v['id'];?>,'<?php echo $v['name'];?>')" class="btn btn-success btn-xs">移动</button></td>
                                                    </tr>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            
            
        </div><!-- ENd box  -->

    </div>
</div>
<script>
    function del_fg(id){
        swal({
            title: "删除分组?",
            text: '删除分组. 不会影响分类的使用',
            type: "warning",
            showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "删除",
             cancelButtonText:'取消'
        },function(){
                window.location.href="/admin/forum_group/del/" + id;
            });

    }
    function edit_fg(id,name){
        $("#edit_name").val(name);
        $("#edit_id,#fgid").val(id);
        $("#d1").modal('show');
    }
    function move_fg(id,fgid,name){
        $("#move_forum_name").val(name);
        $("#move_fg").val(fgid);
        $("#fid").val(id);
        $("#d2").modal('show');
    }
</script>
<!-- Modal -->
<div class="modal fade" id="normalModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">添加分组</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="form">
                    <input type="hidden" name="gn" value="add">
                    <div class="form-group">
                        <label for="fg_name">分组名称</label>
                        <input type="text" name="fg_name" class="form-control" id="fg_name" >
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="$('#form').submit()">保存</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="d1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">修改分组</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="form1">
                    <input type="hidden" name="gn" value="edit">
                    <input type="hidden" name="fgid" id="fgid" value="">
                    <div class="form-group">
                        <label for="edit_id">分组ID</label>
                        <input type="text" name="edit_id" class="form-control" id="edit_id" >
                        <span class="help-block">不可重复</span>
                    </div>
                    <div class="form-group">
                        <label for="edit_name">分组名称</label>
                        <input type="text" name="edit_name" class="form-control" id="edit_name" >
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-primary" onclick="$('#form1').submit()">保存</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="d2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">移动板块到其他分组</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="form3">
                    <input type="hidden" name="gn" value="move">
                    <input type="hidden" name="fid" id="fid" value="">
                    
                    <div class="form-group">
                        <label for="">板块名称</label>
                        <input type="text" name="move_forum_name" class="form-control" id="move_forum_name" disabled="" value="">
                        
                    </div>
                    <div class="form-group">
                        <label for="move_fg">移动到分组</label>
                        <select class="form-control" name="move_fg" id="move_fg">
                            <option value="-1">移出大分组(不使用大分组)</option>
                            <?php foreach ($data as $v): ?>
                            <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-primary" onclick="$('#form3').submit()">保存</button>
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

