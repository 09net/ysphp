{include header}
<div class="wrapper">
 {include header_menu}
 {include left_menu}
 <div class="main-container">
 <div class="padding-md">
 <h2 class="header-text no-margin">
 {lag 用户} - {lag 管理}
 </h2>
 <div class="gallery-filter m-top-md m-bottom-md">
 <ul class="clearfix">
 <li class="active"><a href="javascript:void(0)" data-toggle="modal" data-target="#normalModal"><i class="fa fa-plus"></i> {lag 添加用户}</a></li>
 </ul>
 </div><script>
 function edit_forum(uid, user, group, email, gold, credits) {
 $("#edit0").val(uid);
 $("#edit1").val(user);
 $("#edit2").val(group);
 $("#edit3").val(email);
 $("#edit7").val(gold);
 $("#edit8").val(credits);

 $('#normalModal1').modal('show')
 }

 function deluser(id, obj) { //删除用户
 if (!confirm("{lag 确定删除}?")) {
 return;
 }

 $(obj).attr("disabled", true);

 $.post('/admin/user', { id: id, gn: 4 },
 function(e) {
 $(obj).removeAttr("disabled");
 if (e.error) {
 $(obj).parent().parent().remove();
 }

 }, 'json');
 }
 </script>
 
 <div class="row" style="margin-top: 10px;">
 <form method="get">
 <input type="hidden" name="s" value="/admin/user" />
 <input type="hidden" name="gn" value="1" />
 <div class="col-md-4 col-xs-12">
 <div class="form-group">
 <label>{lag 搜索用户} (ID e-mail)</label>
 <input name="user" type="text" class="form-control" value="{if isset($skey)}{$skey}{/if}" placeholder="关键字">
 </div>
 </div>
 </form>
 </div>
 <form action="" method="post">
 <input type="hidden" name="gn" value="del_more">
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
 <th>{lag 用户}</th>
 <th>{lag 权限}</th>
 <th>{lag 发表}</th>
 <th>{lag 积分}</th>
 <th>{lag 粉丝}</th>
 <th>{lag 关注}</th>
 
 <th>{lag 注册时间}</th>
 <th>{lag 操作}</th>
 </tr>
 </thead>
 <tbody>
  {php $i=0;$pagetime=0;}{foreach $data as $v}<?php $i++;$pagetime=$v['btime'];?>
 <tr>
 <td>
 <div class="custom-checkbox">
 <input name="id[]" value="{$v.id}" class="checkboxx" type="checkbox" id="chk{$v.id}">
 <label for="chk{$v.id}"></label>
 </div>
 </td>
 <td>
 <p>ID：{$v.id}</p>
 <p>{lag 用户名}：{$v.user}</p>
 <p>{lag 邮箱}：{$v.email}</p>
 </td>
 <td>
 <p>group：{$v['group']}</p>
 <p>{lag 用户组}：{$usergroup[$v['group']-1]['name']}</p>
 
 </td>
 <td>
 <p>{lag 文章}{$v.threads}</p>
 <p>{lag 评论}：{$v.posts}</p>
 
 </td>
 <td>
 <p>{lag 金币}：{$v.gold}</p>
 <p>{lag 积分}：{$v.credits}</p>
 </td>
 <td>{$v.follow}</td>
 <td>{$v.fans}</td>
 
 <td>
 <?php echo date("Y-m-d H:i:s",$v['atime']) ?>
 </td>
 <td>
 <button type="button" onclick="edit_forum({$v.id},'{$v.user}',{$v['group']},'{$v.email}',{$v.gold},{$v.credits})" class="btn btn-success btn-xs">{lag 编辑}</button>
 {if C('ADMIN_GROUP') != $v['group']}
 <button type="button" onclick="deluser({$v.id},this)" class="btn btn-danger btn-xs">{lag 删除}</button>
 {/if}
 
 </td>
 </tr>
 {/foreach}
 </tbody>
 </table>
 </div>
 <div class="row">
 <div class="col-md-12">
 <div class="checkbox inline-block">
 <div class="custom-checkbox">
 <input type="checkbox" name="del_post" id="inlineCheckbox1" class="checkbox-red">
 <label for="inlineCheckbox1"></label>
 </div>
 <div class="inline-block vertical-top">
 {lag 勾选此项 确认多选删除}
 </div>
 </div>
 </div>
 <div class="col-md-12">
 
 <button class="btn btn-danger">{lag 删除勾选用户} ({lag 不可恢复})</button>
 </div>
 </div>
 </form>
 
<div class="smart-widget-body">
                <a href="/admin/user" class="btn btn-success marginTB-xs"><i class="fa fa-angle-double-left m-left-xs"></i>{lag 首页}</a>
                <a href="/admin/user?pageid={$pagetime}" style="float:right" class="btn btn-success marginTB-xs" {if $i<10}disabled{/if}>{lag 下一页}<i class="fa fa-angle-double-right m-left-xs"></i></a>
            </div> 

 </div>
 <!-- ENd box -->
 </div>
</div>
<!-- Modal -->
<form method="post">
 <div class="modal fade" id="normalModal">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{lag 关闭}</span></button>
 <h4 class="modal-title">{lag 添加用户}</h4>
 </div>
 <div class="modal-body">
 <input type="hidden" name="gn" value="2">
 <div class="form-group">
 <label for="">{lag 用户名}</label>
 <input type="text" name="user" class="form-control">
 </div>
 <div class="form-group">
 <label for="">{lag 用户组}</label>
 <select class="form-control" name="group">
 {foreach $usergroup as $v}
 <option value="{$v['id']}" {if $v['id']==$conf['usergroup']}selected="selected"{/if}>{$v.name}</option>
 {/foreach}
 </select>
 </div>
 <div class="form-group">
 <label for="">{lag 邮箱}</label>
 <input type="email" name="email" class="form-control">
 </div>
 <div class="form-group">
 <label for="">{lag 密码}</label>
 <input type="text" name="pass" class="form-control">
 </div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-default" data-dismiss="modal">{lag 取消}</button>
 <button type="submit" class="btn btn-primary">{lag 提交}</button>
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
 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{lag 关闭}</span></button>
 <h4 class="modal-title">{lag 修改用户}</h4>
 </div>
 <div class="modal-body">
 <input type="hidden" name="gn" value="3">
 <input type="hidden" name="id" id="edit0">
 <div class="form-group">
 <label for="">{lag 用户名}</label>
 <input name="user" id="edit1" type="text" class="form-control">
 </div>
 <div class="form-group">
 <label for="">{lag 用户组}</label>
 <select class="form-control" id="edit2" name="group">
 {foreach $usergroup as $v}
 <option value="{$v.id}">{$v.name}</option>
 {/foreach}
 </select>
 </div>
 <div class="form-group">
 <label for="">{lag 邮箱}</label>
 <input name="email" id="edit3" type="email" class="form-control">
 </div>
 <div class="form-group">
 <label for="">{lag 密码}&nbsp;{lag 留空则不修改}</label>
 <input name="pass" id="" type="text" class="form-control">
 </div>
 <div class="form-group">
 <label for="">{lag 金币}</label>
 <input name="gold" id="edit7" type="text" class="form-control">
 </div>
 <div class="form-group">
 <label for="">{lag 积分}</label>
 <input name="credits" id="edit8" type="text" class="form-control">
 </div>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-default" data-dismiss="modal">{lag 取消}</button>
 <button type="submit" class="btn btn-primary">{lag 提交}</button>
 </div>
 </div>
 </div>
 </div>
</form>{include footer}