{include header}
<div class="wrapper">
    {include header_menu}
    {include left_menu}
    <div class="main-container">
        <div class="padding-md">
            <h3 class="m-left-xs header-text m-top-lg">版主指派</h3>
                版主如每个板块有个管理员权限一样，版主可以删除主题，帖子，修改主题，修改评论。
            <div class="table-responsive">
            <table class="table table-striped table-bordered m-top-md" id="dataTable">
				<thead>
					<tr class="bg-dark-blue">
						<th>分类ID</th>
						<th>分类名称</th>
                        <th>版主用户列表</th>
					</tr>
				</thead>
				<tbody>
                    {foreach $data as $v}
                    <tr >
                        <td>{$v.id}</td>
                        <td>{$v.name}</td>
                        <td>
                            {foreach $v['user'] as $vv}
                            <span class="label label-info">{$vv}</span>
                            {/foreach}
                            <button onclick="$('#gn').val('forumg');$('.modal-body').load('/admin/forumg?id={$v['id']}&gn=forumg')" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#normalModal">编辑</button>
                        </td>
                    </tr>
                    {/foreach}


				</tbody>
			</table>
            </div>
            

        </div>
    </div>
    <form method="post">
    <input type="hidden" id="gn" name="gn" value="">
    <div class="modal fade in" id="normalModal" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="zti">编辑<span class="modal-p1"></span></h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-success">确定执行</button>
                </div>
            </div>
        </div>
    </div>
    </form>

</div>
{include footer}
