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
 .smart-widget .smart-widget-inner .smart-widget-body {
 padding: 0;
 }
 .ddx td{
 background-color: #DFDFDF !important
 }
 tr td{
 background-color: #fff !important;
 }
 </style>
 <!-- Modal -->
 <form method="post">
 <div class="modal fade" id="normalModal">
 <div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
   <h4 class="modal-title">添加分类</h4>
  </div>
  <div class="modal-body">
   <input type="hidden" name="gn" value="1">
   <input type="hidden" name="id" class="form-control" AUTOCOMPLETE="off" value="0">
   <div class="form-group">
   <label for="">板块名称</label>
   <input type="text" name="name" class="form-control" AUTOCOMPLETE="off">
   </div>
   <div class="form-group">
   <label for="">板块别名</label>
   <input type="text" name="name2" class="form-control" AUTOCOMPLETE="off">
   注意: 不可以全部数字 . (建议使用字母别名, 不建议使用中文以及特殊符号)
   </div>
   <div class="form-group">
   <label for="">字体颜色</label>
   <input type="text" name="color" class="form-control" >
   用于对某些模板的独立性颜色控制 可使用 #FFF rgb 以及 rgba
   </div>
   <div class="form-group">
   <label for="">背景颜色</label>
   <input type="text" name="background" class="form-control">
   用于对某些模板的独立性颜色控制 可使用 #FFF rgb 以及 rgba
   </div>
   <div class="form-group">
   <label for="">板块描述 (支持HTML)</label>
   <textarea name="html" class="form-control"></textarea>
   </div>
   <div class="form-group">
   <label for="">父分类ID</label>
   <select class="form-control" name="fid">
    <option value="-1" selected="selected">无父分类 (默认)</option>
    <?php foreach ($forum as $v): ?>
    <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
    <?php endforeach ?>
   </select>
   作为大分类 不需要设置该项, 如果作为子分类 则需要选择你的父分类
   </div>
  </div>
  <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
   <button type="submit" class="btn btn-primary">提交</button>
  </div>
  </div>
 </div>
 </div>
 </form>

 <form method="post">
 <div class="modal fade" id="normalModal1">
 <div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
   <h4 class="modal-title">修改分类</h4>
  </div>
  <div class="modal-body">
   <input type="hidden" name="gn" value="2">
   <input type="hidden" id="iid" name="iid" value="">
   <div class="form-group">
   <label for="">分类ID (不建议更改)</label>
   <input name="id" id="edit0" type="text" class="form-control" AUTOCOMPLETE="off">
   </div><!-- /form-group -->
   <div class="form-group">
   <label for="">板块名称</label>
   <input name="name" id="edit1" type="text" class="form-control" AUTOCOMPLETE="off">
   </div>
   <div class="form-group">
   <label for="">板块别名</label>
   <input name="name2" id="edit2" type="text" class="form-control" AUTOCOMPLETE="off">
   </div>
   <div class="form-group">
   <label for="">字体颜色</label>
   <input type="text" id="edit3" name="color" class="form-control" >
   用于对某些模板的独立性颜色控制 可使用 #FFF rgb 以及 rgba
   </div>
   <div class="form-group">
   <label for="">背景颜色</label>
   <input type="text" id="edit4" name="background" class="form-control">
   用于对某些模板的独立性颜色控制 可使用 #FFF rgb 以及 rgba
   </div>
   <div class="form-group">
   <label for="">板块描述 (支持HTML)</label>
   <textarea name="html" id="edit5" class="form-control"></textarea>
   </div>

   <div class="form-group">
   <label for="">父分类ID</label>
   <select class="form-control" id="edit6" name="fid">
    <option value="-1" selected="selected">无父分类 (默认)</option>
    <?php foreach ($forum as $v): ?>
    <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
    <?php endforeach ?>
   </select>
   </div><!-- /form-group -->

  
  </div>
  <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
   <button type="submit" class="btn btn-primary">提交</button>
  </div>
  </div>
 </div>
 </div>
 </form>

 <form method="post">
 <div class="modal fade" id="normalModal2">
 <div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
   <h4 class="modal-title">合并分类</h4>
  </div>
  <div class="modal-body">
   <input type="hidden" name="gn" value="move">
  

   <div class="form-group">
   <label ></label>
   <div >
    <span>如果下面没显示你最新的板块. 请刷新一下论坛缓存!</span>
   </div>
   </div>
   <div class="form-group">
   <label >将这个分类的文章</label>
   
    <select name="move_f1" class="form-control">
    <?php foreach ($forum as $v): ?>
    <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
    <?php endforeach ?>
    </select>
   
   </div>
   <div class="form-group">
   <label >移动到这个分类</label>
   
    <select name="move_f2" class="form-control">
    <?php foreach ($forum as $v): ?>
    <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
    <?php endforeach ?>
    </select>
   
   </div>
   <div class="form-group">
   <label class=""></label>
   
    <div class="checkbox inline-block">
    <div class="custom-checkbox">
     <input type="checkbox" name="move_check" class="checkbox-red" id="inlineCheckbox3" >
     <label for="inlineCheckbox3"></label>
    </div>
    <div class="inline-block vertical-top">
     确定操作
    </div>
    </div>
   
   </div>
   <div class="form-group">
   <label ></label>
   
    <button class="btn btn-success" >移动</button>
   
   </div><!-- /form-group -->

  
  </div>
  
  </div>
 </div>
 </div>
 </form>

 <!-- !Modal -->

 <div class="main-container">
 <div class="padding-md">
  <h2 class="header-text no-margin">
  分类 & 板块 - 管理
  </h2>
  <div class="gallery-filter m-top-md m-bottom-md">
  <ul class="clearfix">
   <li class="active"><a href="javascript:void(0)" data-toggle="modal" data-target="#normalModal"><i class="fa fa-plus"></i> 添加分类 (板块)</a></li>
   <li class="active"><a href="javascript:void(0)" data-toggle="modal" data-target="#normalModal2"><i class="fa fa-copy"></i> 合并分类 (板块)</a></li>
   
   
  </ul>
  </div>
  <div class="smart-widget">

 		<div class="smart-widget-header">
 			板块列表
 		</div>
 		<div class="smart-widget-inner">
 			
   <script>
   function edit_forum(id,name,name2,color,background,fid){
   var i=0;
   $("#edit6").val('-1');
   $("#iid").val(id);
   $("#edit0").val(id);
   $("#edit1").val(name);
   $("#edit2").val(name2);
   $("#edit3").val(color);
   $("#edit4").val(background);
   $("#edit5").val($('#pre-'+id).text());
   $("#edit6").val(fid);
   
   $('#normalModal1').modal('show')
   }
   function del_forum(id){
   swal({
    title: "确认删除",
    text: '一旦删除该分类, 该分类下的文章,评论\r\n删除时会有小延迟,请等待! 时间取决于数据大小',
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "删除",
    cancelButtonText:'取消',

   }).then(
    function(){
    $.post("/admin/forum",{gn:3,id:id},function(e){
     if(e.error)
     window.location.reload();
    },'json');
    },
    function(){
    
    }
   );

   
   }
   </script>

  			<div class="smart-widget-body">
    <div class="table-responsive">
  				<table class="table table-striped">
  		 		<thead>
  		 		<tr>
  			  		<th>分类ID</th>
  			  		<th>分类信息</th>
      
      <th width="180" title="用于模板使用">颜色</th>
      
      <th>板块描述HTML</th>
      
  			  		<th>父分类信息</th>
  			  		
      <th>额外操作</th>
      <th>上传图标</th>
  		 		</tr>
  		 		</thead>
  		 		<tbody>
     
  			 	<?php foreach ($data as $v): ?>
     
     <tr >
      <td><?php echo $v['id'];?></td>
      <td>
      <p>名称：<?php echo $v['name'];?></p>
      <p>别名：<?php echo $v['name2'];?></p>
      <p>主题数：<span class="badge badge-primary"><?php echo $v['threads'];?></span></p>
      <p>评论数：<span class="badge badge-success"><?php echo $v['posts'];?></span></p>
      </td>
      
      <td>
      <p>
       字体颜色：<i style="background: <?php echo $v['color'];?>;float: left;width: 20px;height: 20px;display: inline-block;border-radius: 4px;margin-right:5px"></i><?php echo $v['color'];?>
      </p>
      <p>
       背景颜色：<i style="background: <?php echo $v['background'];?>;float: left;width: 20px;height: 20px;display: inline-block;border-radius: 4px;margin-right:5px"></i><?php echo $v['background'];?>
      </p>
      </td>
      
      <td>
      <pre id="pre-<?php echo $v['id'];?>" style="width:200px;max-height:200px"><?php echo $v['html'];?></pre>
      </td>
      <?php $tmp=false; ?>

      <?php foreach ($data1 as $vv): ?>

      <?php if ($v['fid'] == $vv['id']): ?>
       <td>
       <p>父分类ID：<?php echo $vv['id'];?></p>
       <p>父分类名称：<?php echo $vv['name'];?></p>
       </td>
       <?php $tmp=1; ?>

      <?php endif ?>
      <?php endforeach ?>
      <?php if (!$tmp): ?>
      <td></td>
      

      <?php endif ?>
      <td>
      <button onclick="edit_forum(<?php echo $v['id'];?>,'<?php echo $v['name'];?>','<?php echo $v['name2'];?>','<?php echo $v['color'];?>','<?php echo $v['background'];?>',<?php echo $v['fid'];?>)" class="btn btn-success btn-xs">修改</button>
      <button onclick="del_forum(<?php echo $v['id'];?>)" class="btn btn-danger btn-xs">删除</button>
      </td>
      <td>
      <img alt="点我上传" title="点我上传" class="pull-left" width="30" height="30" src="http://zh.test.com/upload/<?php echo $v['img'];?>" onerror="onerror='';this.src='//zh.test.com/upload/de.png'" onclick="$('#file-<?php echo $v['id'];?>').click()">

      <form style="display:none;" action="/admin/forumupload" method="post" enctype="multipart/form-data">
       <input type="hidden" name="forum" value="<?php echo $v['id'];?>">
       <input id="file-<?php echo $v['id'];?>" type="file" name="photo" onchange="$(this).parent().submit()"> 

      </form>
      </td>

     </tr>
     
     <?php endforeach ?>
  			 	</tbody>
  			 </table>
    </div>



   </div>
 		</div><!-- ./smart-widget-inner -->
 	</div>
  <div class="smart-widget-body">




			</div>
  
  
 </div><!-- ENd box -->

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

