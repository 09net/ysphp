{include header}
 {php $i=0;$pagetime=0;}
<div class="wrapper">
  {include header_menu}
  {include left_menu}
  <div class="main-container">
    <div class="padding-md">
      <form method="get">
      <input type="hidden" name="s" value="admin{#EXP}thread">
       <div class="form-group">
         <label>{lag 筛选}</label>
          <select class="form-control" name="forum">
            <option value="-1">{lag 分类}</option>
            {foreach $forum as $v}
            <option value="{$v.id}" {if isset($sforum)}{if $sforum == $v['id']}selected = "selected" {/if}{/if}>{$v.name}</option>
            {/foreach}
          </select>
         
       </div>
       <div class="form-group">
         
         <button type="submit" class="btn btn-success btn-sm">{lag 筛选}</button> <a href="?top=6" class="btn btn-success btn-sm">{lag 审核}</a><a href="?top=7" class="btn btn-success btn-sm">{lag 精华}</a><a href="?top=8" class="btn btn-success btn-sm">{lag 栏目置顶}</a><a href="?top=9" class="btn btn-success btn-sm">{lag 全站置顶}</a>
         
       </div>
       
         
       
     
     </form>

     
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
        				<th>FID</th>
        				<th>UID</th>
            <th>{lag 标题}</th>
            <th>{lag 发表时间}</th>
            <th>{lag 统计}</th>
            <th>{lag 赞踩}</th>
    			</tr>
  				</thead>
  				<tbody>
       {foreach $data as $v}<?php $i++;$pagetime=$v['btime'];?>
       <tr>
         <td>
          <div class="custom-checkbox">
           <input name="id[]" value="{$v.id}" class="checkboxx" type="checkbox" id="chk{$v.id}">
           <label for="chk{$v.id}"></label>
          </div>
         </td>
         <td>{$v.id}</td>
         <td><small class="badge badge-success badge-square bounceIn animation-delay2 m-left-xs pull-right">{$v.fid}</small></td>
         <td>{$v.user}<small class="badge badge-success badge-square bounceIn animation-delay2 m-left-xs pull-right">{$v.uid}</small></td>
         <td>
          <a href="/thread/{$v['id']}.html?admin" target="_blank">{$v.title}</a>
         </td>
         <td><?php echo date("Y-m-d H:i:s",$v['atime']); ?></td>
         
         <td>
          <p>{lag 评论}：{$v.posts}</p>
          <p>{lag 浏览}：{$v.views}</p>
          <p>{lag 附件}：{$v.files}</p>
         
         </td>
         <td>
          <p>{lag 赞}：{$v.goods}</p>
          <p>{lag 踩}：{$v.nos}</p>
         </td>
       </tr>
       {/foreach}
  				</tbody>
  			</table>
      </div>
      <div class="smart-widget-body">
        <div class="row">
     
        <div class="col-md-12">
          <button class="btn btn-danger">{lag 删除}</button>
        </div>
      </div>

    </div>
    </form>
    <div class="smart-widget-body">
{if $i>9}<a href="/admin/thread/{$pagetime}.html" class="btn btn-primary btn-lg btn-block">{lag 下一页}<i class="fa fa-angle-double-right m-left-xs"></i></a>{else}<button class="btn btn-lg btn-block">{lag 完毕}</button>{/if}
    </div>


    
  </div>
</div>
{include footer}

