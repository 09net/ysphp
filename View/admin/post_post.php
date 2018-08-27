{include header}
<div class="wrapper">
    {include header_menu} {include left_menu}
    <div class="main-container">
        <style>
        .table-striped>tbody>tr {
            cursor: pointer;
        }
        </style>
        <div class="padding-md">
            <div class="row">
                <div class="col-md-3">
                    <div class="widget-stat clearfix">
                        <span class="stat-icon bg-success bounceIn animation-delay3"><i class="fa fa-comments"></i></span>
                        <div class="stat-info">
                            <small class="text-muted text-upper">子评论数量</small>
                            <span>{php echo S('Post_post')->count()}</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="widget-stat clearfix">
                        <span class="stat-icon bg-warning bounceIn animation-delay3"><i class="fa fa-comments-o"></i></span>
                        <div class="stat-info">
                            <small class="text-muted text-upper">今日发表子评论</small>
                            <span>{php echo S('Post_post')->count(['atime[>]'=>strtotime(date('Y-m-d'))])}</span>
                        </div>
                    </div>
                </div>
            </div>
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
                                <th>ID</th>
                                <th width="400">所属文章</th>
                                
                                <th>作者&UID</th>
                                
                                <th>发表时间</th>
                                
                                <th>赞踩</th>
                                
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $Thread = M('Thread'); ?>
                            {foreach $data as $v}
                            <tr>
                                <td>
                                    <div class="custom-checkbox">
                                        <input name="id[]" value="{$v.id}" class="checkboxx" type="checkbox" id="chk{$v.id}">
                                        <label for="chk{$v.id}"></label>
                                    </div>
                                </td>
                                <td>{$v.id}</td>
                                <td>
                                    <p>文章tid：{$v.tid}</p>
                                    <p>所属评论pid：{$v.pid}</p>
                                    <p>文章标题：<a href="{php HYBBS_URL('thread',$v['tid'])}" target="_blank">{php echo $Thread->get_title($v['tid'])}</a></p>
                                    <p style="word-break: break-all;" title="内容被截断输出">内容：{php echo mb_substr(strip_tags($v['content']),0,100)}</p>
                                    
                                    
                                </td>
                                
                                <td>{$v.user}<small class="badge badge-success badge-square bounceIn animation-delay2 m-left-xs">{$v.uid}</small></td>
                                
                                <td>
                                    <p><?php echo date("Y-m-d H:i:s",$v['atime']); ?></p>
                                    
                                    
                                </td>
                               
                                <td>
                                    <p>赞：{$v.goods}</p>
                                    <p>踩：{$v.nos}</p>
                                </td>
                                
                                <td>
                                    <!-- <a target="_blank" href="{if $v['pid']==0}{php HYBBS_URL('thread',$v['tid']);}{else}{php HYBBS_URL('post','edit',['id'=>$v['pid']]);}{/if}" class="btn btn-success btn-xs">修改</a> -->
                                
                                </td>
                            </tr>
                            {/foreach}
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
                {if $pageid != 1}
                <a href="{php HYBBS_URL('admin','post',['pageid'=>$pageid-1])}" class="btn btn-success marginTB-xs" ><i class="fa fa-angle-double-left m-left-xs"></i> 上一页</a>
                {/if}

                {if $pageid != $page_count}
                <a href="{php HYBBS_URL('admin','post',['pageid'=>$pageid+1])}" style="float:right" class="btn btn-success marginTB-xs">下一页<i class="fa fa-angle-double-right m-left-xs"></i></a>
                {/if}
            </div>
        </div>
    </div>
    {include footer}