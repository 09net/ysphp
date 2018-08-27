{include header}
 {php $i=0;$pagetime=0;}
<div class="wrapper">
  {include header_menu} {include left_menu}
  <div class="main-container">
    <style>
    .table-striped>tbody>tr {
      cursor: pointer;
    }
    </style>
    <div class="padding-md">
     
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
                <th>id</th>
                <th width="60%">{lag 内容}</th>
                
                <th>{lag 时间}</th>
                <th>{lag 子评论}</th>
                <th>{lag 赞}/{lag 踩}</th>
    
              </tr>
            </thead>
            <tbody>
              {foreach $data as $v}<?php $i++;$pagetime=$v['btime'];?>
              <tr>
                <td>
                  <div class="custom-checkbox">
                    <input name="id[]" value="{$v.id}" class="checkboxx" type="checkbox" id="chk{$v.pid}">
                    <label for="chk{$v.pid}"></label>
                  </div>
                </td>
                <td>{$v.id}</td>
                
                <td>{$v.content}<br />{$v.user}<small class="badge badge-success badge-square bounceIn animation-delay2 m-left-xs pull-right">{$v.uid}</small>  <p><a  href="/t/{$v['tid']}.html" target="_blank">{lag 查看详细内容}</a></p></td>
                
                <td>
                  <p>{lag 发表}：<?php echo date("Y-m-d H:i:s",$v['atime']); ?></p>
                  <p>{lag 排序}：<?php echo date("Y-m-d H:i:s",$v['btime']); ?></p>
                  
                </td>
                <td>
                  <p>{$v.posts}</p>
                  
                  
                </td>
                <td>
                  {$v.goods}/{$v.nos}
                </td>
                
                
              </tr>
              {/foreach}
            </tbody>
          </table>
        </div>
        <div class="smart-widget-body">
          <div class="row">
            
            <div class="col-md-12">
              <button class="btn btn-danger">{lag 删除} ({lag 不可恢复})</button>
            </div>
          </div>
        </div>
      </form>
      <div class="smart-widget-body">
{if $i>9}<a href="/admin/post/{$pagetime}.html" class="btn btn-primary btn-lg btn-block">{lag 下一页}<i class="fa fa-angle-double-right m-left-xs"></i></a>{else}<button class="btn btn-lg btn-block">{lag 完毕}</button>{/if}

      </div>
    </div>
  </div>
  {include footer}