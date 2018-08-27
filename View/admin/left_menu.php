<aside class="sidebar-menu fixed">
 <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
 <div class="sidebar-inner scrollable-sidebar" style="overflow: hidden; width: auto; height: 100%;">
 <div class="main-menu">
 <ul class="accordion">
 <li class="menu-header">
 {lag 菜单}
 </li>
 <li class="bg-palette1 {if METHOD_NAME == 'Index'}active open{/if}">
 <a href="/admin">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-home fa-lg"></i></span>
 <span class="text m-left-sm">{lag 首页}</span>
 </span>
 <span class="menu-content-hover block">
 {lag 首页}
 </span>
 </a>
 </li>
 <li class="bg-palette4 {if METHOD_NAME == 'Op'}active open{/if}">
 <a href="/admin/op">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-cog fa-lg"></i></span>
 <span class="text m-left-sm">{lag 全局}</span>
 </span>
 <span class="menu-content-hover block">
 {lag 全局}
 </span>
 </a>
 </li>
 <li class="bg-palette2">
 <a href="/">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-desktop fa-lg"></i></span>
 <span class="text m-left-sm">{lag 网站首页}</span>
 </span>
 <span class="menu-content-hover block">
 {lag 网站首页}
 </span>
 </a>
 </li>
 <li class="openable bg-palette3 {if METHOD_NAME == 'Forum_group' || METHOD_NAME == 'Forum' || METHOD_NAME == 'Forumg' || METHOD_NAME == 'Forum_json' }active open{/if}">
 <a href="#">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-list fa-lg"></i></span>
 <span class="text m-left-sm">{lag 板块分类}</span>
 <span class="submenu-icon"></span>
 </span>
 <span class="menu-content-hover block">
 {lag 板块分类}
 </span>
 </a>
 <ul class="submenu bg-palette4">
 <li><a {if METHOD_NAME == 'Forum_group'}class="active"{/if} href="/admin/forum_group" title="板块分组"><span class="submenu-label">大分组</span></a></li>
 <li><a {if METHOD_NAME == 'Forum'}class="active"{/if} href="/admin/forum" title="板块分类列表管理"><span class="submenu-label">分类管理</span></a></li>
 <li><a {if METHOD_NAME == 'Forumg'}class="active"{/if} href="/admin/forumg" title="板块分类 版主列表编辑"><span class="submenu-label">分类版主</span></a></li>
 <li><a {if METHOD_NAME == 'Forum_json'}class="active"{/if} href="/admin/forum_json" title="板块用户组列表权限控制"><span class="submenu-label">分类用户组权限</span></a></li>

 </ul>
 </li>
 <li class="openable bg-palette4 {if METHOD_NAME == 'User' || METHOD_NAME == 'Usergroup'}active open{/if}">
 <a href="#">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-users fa-lg"></i></span>
 <span class="text m-left-sm">{lag 用户管理}</span>
 <span class="submenu-icon"></span>
 </span>
 <span class="menu-content-hover block">
 {lag 用户管理}
 </span>
 </a>
 <ul class="submenu" style="display: none;">
 <li><a {if METHOD_NAME == 'User'}class="active"{/if} href="/admin/user"><span class="submenu-label">{lag 用户管理}</span></a></li>

 </ul>
 </li>

 <li class="openable bg-palette3 {if METHOD_NAME == 'Thread' || METHOD_NAME == 'Post' || METHOD_NAME == 'Post_post'}active open{/if}">
 <a href="#">
 <span class="menu-content block">
 <span class="menu-icon">
 <i class="block fa fa-tags fa-lg"></i>
 </span>
 <span class="text m-left-sm">{lag 文章 & 评论}</span>
 <span class="submenu-icon"></span>
 </span>
 <span class="menu-content-hover block">
 {lag 文章&评论}
 </span>
 </a>
 <ul class="submenu" style="display: none;">
 <li><a {if METHOD_NAME == 'Thread'}class="active"{/if} href="/admin/Thread"><span class="submenu-label">{lag 文章管理}</span></a></li>
 <li><a {if METHOD_NAME == 'Post'}class="active"{/if} href="/admin/Post"><span class="submenu-label">{lag 评论管理}</span></a></li>
 </ul>
 </li>


 
 <li class="bg-palette2 {if METHOD_NAME == 'Mykey'}active open{/if}">
 <a href="/admin/mykey">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-paint-brush fa-lg"></i></span>
 <span class="text m-left-sm">{lag 分词}</span>

 </span>
 <span class="menu-content-hover block">
 {lag 分词管理}
 </span>
 </a>
 </li>
 <li class="bg-palette3 {if METHOD_NAME == 'Fy'}active open{/if}">
 <a href="/admin/fy">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-code fa-lg"></i></span>
 <span class="text m-left-sm"> {lag 翻译管理}</span>

 </span>
 <span class="menu-content-hover block">
 {lag 翻译管理}
 </span>
 </a>
 </li>
 <li class="bg-palette4 {if METHOD_NAME == 'Log'}active open{/if}">
 <a href="/admin/log">
 <span class="menu-content block">
 <span class="menu-icon"><i class="block fa fa-cube fa-lg"></i></span>
 <span class="text m-left-sm">{lag 日志}</span>

 </span>
 <span class="menu-content-hover block">
{lag 日志}
 </span>
 </a>
 </li>
 </ul>
 </div>
 <div class="sidebar-fix-bottom clearfix">
 <div class="user-dropdown dropup pull-left">
 <a title="{lag 菜单}" href="javascript:;" class="dropdwon-toggle font-18" data-toggle="dropdown">
 <i class="fa fa-flickr"></i>
 </a>
 <ul class="dropdown-menu">
 <li class="dropdown-header"><i class="fa fa-flickr"></i> {lag 菜单}</li>
 <li>
 <a href="javascript:;" onclick="delete_cache()">
 <i class="fa fa-trash"></i>{lag 清空文件缓存}
 </a>
 </li>
 <li class="divider"></li>
 <li>
 <a href="/admin/op"><i class="fa fa-cog"></i>{lag 全局设置}</a>
 </li> 
 </ul>
 </div>
 <a title="{lag 注销}" href="/admin/out" class="pull-right font-18">
 <i class="fa fa-sign-out"></i>
 </a>
 </div>
 <script>
 function delete_cache(data){
 swal({
 title: "{lag 删除缓存}",
 text: '{lag 确认删除文件缓存！}',
 type: "warning",
 confirmButtonColor: "#DD6B55",
 confirmButtonText: "{lag 确定}",
 cancelButtonText: '{lag 取消}',
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
 swal('{lag 成功}',e.info,'success');
 }
 else{
 swal('{lag 错误}',e.info,'error');
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
