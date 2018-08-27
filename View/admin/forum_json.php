{include header}
<div class="wrapper">
    {include header_menu}
    {include left_menu}
    <div class="main-container">
        <div class="padding-md">
            
            <h3 class="m-left-xs header-text m-top-lg">分类用户组权限</h3>
            <div class="table-responsive">
            <table class="table table-striped table-bordered m-top-md" id="dataTable">
				<thead>
					<tr class="bg-dark-blue">
						<th>分类ID</th>
						<th>分类名称</th>
                        <th>禁止浏览分类</th>
                        <th>禁止浏览分类主题</th>
                        <th>禁止发帖</th>
                        <th>禁止回复</th>
                        <th>禁止下载附件</th>

					</tr>
				</thead>
				<tbody>

                    {foreach $data as $v}
                    <tr>
                        <td>{$v.id}</td>
                        <td>{$v.name}</td>
                        <td>
                            {foreach $v['jsonarr']['vforum'] as $vv}
                            <span class="label label-primary">{$vv}</span>
                            {/foreach}
                            <button onclick="$('#gn').val('vforum');$('.modal-body').load('/admin/forum_json?id={$v['id']}&gn=vforum')" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#normalModal">{lag 编辑}</button>
                        </td>
                        <td>
                            {foreach $v['jsonarr']['vthread'] as $vv}
                            <span class="label label-primary ">{$vv}</span>
                            {/foreach}
                            <button onclick="$('#gn').val('vthread');$('.modal-body').load('/admin/forum_json?id={$v['id']}&gn=vthread')" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#normalModal">{lag 编辑}</button>
                        </td>
                        <td>
                            {foreach $v['jsonarr']['thread'] as $vv}
                            <span class="label label-primary ">{$vv}</span>
                            {/foreach}
                            <button onclick="$('#gn').val('thread');$('.modal-body').load('/admin/forum_json?id={$v['id']}&gn=thread')" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#normalModal">{lag 编辑}</button>
                        </td>
                        <td>
                            {foreach $v['jsonarr']['post'] as $vv}
                            <span class="label label-primary ">{$vv}</span>
                            {/foreach}
                            <button onclick="$('#gn').val('post');$('.modal-body').load('/admin/forum_json?id={$v['id']}&gn=post')" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#normalModal">{lag 编辑}</button>
                        </td>
                      
                        <td>
                            {foreach $v['jsonarr']['downfile'] as $vv}
                            <span class="label label-primary ">{$vv}</span>
                            {/foreach}
                            <button onclick="$('#gn').val('downfile');$('.modal-body').load('/admin/forum_json?id={$v['id']}&gn=downfile')" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#normalModal">{lag 编辑}</button>
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
                    <h4 class="modal-title" id="zti">{lag 编辑}<span class="modal-p1"></span></h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{lag 取消}</button>
                    <button type="submit" class="btn btn-success">{lag 执行}</button>
                </div>
            </div>
        </div>
    </div>
    </form>

</div>
{include footer}
