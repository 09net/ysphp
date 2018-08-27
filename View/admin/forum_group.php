{include header}
<div class="wrapper">
    {include header_menu}
    {include left_menu}
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
                                    {foreach $data as $v}
                                    <tr>
                                        <td>{$v.id}</td>
                                        <td>{$v.name}</td>
                                        <td>
                                            <a onclick="edit_fg({$v['id']},'{$v.name}')" class="btn btn-success btn-xs">编辑</a>
                                            <a onclick="del_fg({$v['id']})" class="btn btn-danger btn-xs">删除分组</a>
                                        </td>
                                    </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        		
        	</div>
            <div class="row">
                {foreach $data as $v}
                <div class="col-md-6">
                    <div class="smart-widget">
                        <div class="smart-widget-header">
                            {$v.name} - 分组
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
                                            {foreach $forum_data as $vv}
                                            {if $vv['fgid'] == $v['id']}
                                            <tr>
                                                <td>{$vv.id}</td>
                                                <td>{$vv.name}</td>
                                                <td><button onclick="move_fg({$vv.id},{$v.id},'{$vv.name}')" class="btn btn-success btn-xs">移动</button></td>
                                            </tr>
                                            {/if}
                                            {/foreach}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                {/foreach}
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
                                            {foreach $forum_data as $v}
                                                <?php $has = false; ?>
                                                {foreach $data as $vv}
                                                    
                                                    {if $v['fgid'] == $vv['id']}
                                                        <?php $has = true;break; ?>
                                                    {/if}
                                                    
                                                {/foreach}
                                                {if !$has}
                                                    <tr>
                                                        <td>{$v.id}</td>
                                                        <td>{$v.name}</td>
                                                        <td><button onclick="move_fg({$v.id},{$v.id},'{$v.name}')" class="btn btn-success btn-xs">移动</button></td>
                                                    </tr>
                                                {/if}
                                            {/foreach}
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
                            {foreach $data as $v}
                            <option value="{$v.id}">{$v.name}</option>
                            {/foreach}
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
{include footer}
