<header class="ys-header ys-fix-t">
<a href="javascript:void(0)" class="ys-header-nav ys-header-left fa fa-navicon" onclick="$.ys.canvas_show('left')"></a>
<h1 class="ys-header-title" >{$title}</h1>
<a class="ys-header-nav ys-header-right fa fa-ellipsis-v" onclick="$.ys.popover_bottom_show()"></a>
</header>
<div class="ys-popover-bottom">
<ul class="ys-table-view">
<li class="ys-table-view-cell"><a href="/search">{lag 搜索}</a></li>
<li class="ys-table-view-cell"><a href="/app.html">APP</a></li>
<li class="ys-table-view-cell"><a href="javascript:scroll(0,0);$.ys.popover_bottom_hide();">{lag 回顶部}</a></li>	
<li class="ys-table-view-cell"><a href="//www.{#DOMAIN}?no=1">Language</a></li>
<li class="ys-table-view-cell"><a href="javascript:$.ys.popover_bottom_hide()">{lag 关闭}</a></li></ul></div>{include forum}