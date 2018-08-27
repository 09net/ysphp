<div class="wrap-box">
<div class="menus">
        <ul>
             <li class="{$menu_action.index}">
            <a href="/u/<?php echo urlencode($data['user']);?>.html"><i class="fa fa-tachometer"></i>{lag 首页}</a>
            </li>
            <li class="{$menu_action.thread}">
            <a href="/u/<?php echo urlencode($data['user']);?>/thread.html"><i class="fa fa-cube"></i>{lag 文章}</a>
            </li>
            <li class="{$menu_action.post}">
            <a href="/u/<?php echo urlencode($data['user']);?>/post.html"><i class="fa fa-comments"></i>{lag 评论}</a>
            </li>
			  <li class="{$menu_action.op}">
            <a href="/u/<?php echo urlencode($data['user']);?>/op.html"><i class="fa fa-comments"></i>{lag 资料}</a>
            </li> 
			  <li class="{$menu_action.file}">
            <a href="/u/<?php echo urlencode($data['user']);?>/file.html"><i class="fa fa-comments"></i>{lag 文件}</a>
            </li>   
			 <li class="{$menu_action.pic}">
            <a href="/u/<?php echo urlencode($data['user']);?>/pic.html"><i class="fa fa-comments"></i>{lag 图片}</a>
            </li>                   
        </ul>
    </div>
</div>