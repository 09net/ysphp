{include header}
<script>
 window.page_id = 1;

</script>
<div class="wrapper">
 {include header_menu}

 {include left_menu}
 <div class="main-container">
 <div class="padding-md">
 <h2 class="header-text">
 日志
 </h2>
 <div class="smart-widget">
  <div class="smart-widget-inner">
   <ul class="nav nav-tabs tab-style1">
   
    <li class="active">
    <a href="#style1Tab1" data-toggle="tab">
     <span class="icon-wrapper"><i class="fa fa-book"></i></span>
     用户金币
    </a>
    </li>
    <li>
    <a href="#style1Tab2" data-toggle="tab">
     <span class="icon-wrapper"><i class="fa fa-code"></i></span>
     PHP日志
    </a>
    </li>
   </ul>
   <div class="smart-widget-body">
   <div class="tab-content">
    <div class="tab-pane fade in active" id="style1Tab1">
    <table class="table table-striped" style="table-layout:fixed; word-break:break-all; word-wrap:break-word;">
    <thead>
     <tr>
     <th style="width:20%">用户名 [UID]</th>
     <th style="width:20%">金币</th>
     <th style="width:20%">积分</th>
     <th style="width:20%">变动原因</th>
     <th style="width:20%">时间</th>
     </tr>
    </thead>
    <tbody id="tbody">
     {foreach $data as $v}
     <tr>
     <td>{$v.user} [{$v.uid}]</td>
     <td style="color:{if $v['gold'] < 0}red{else}forestgreen{/if}">{$v.gold}</td>
     <td style="color:{if $v['credits'] < 0}red{else}forestgreen{/if}">{$v.credits}</td>
     <td>{$v.content}</td>
     <td>{php echo date('Y-m-d H:is',$v['atime'])}</td>
     </tr>
     {/foreach}
    </tbody>
    </table>
    <form class="form-horizontal no-margin form-border">
    <div style="margin-bottom: 10px;" class="form-group">
     <div class="col-md-6">
      <label >每页显示条数</label>
      <input id="page-size" type="text" class="form-control" placeholder="每页显示条数 [必填]" value="10">
     </div>
     <div class="col-md-6">
      <label >筛选用户名</label>
      <input id="user-box" type="text" class="form-control" placeholder="用户名 [选填]">
     </div>
      
     </div>
    </form>
    <div class="form-group">
     <div class="input-group">
     <span class="input-group-btn">
      <button onclick="load_data(--window.page_id)" class="btn btn-default" type="button">上一页</button>
     </span>
     <input id="pageid_text" type="text" class="form-control" value="第 1 页" disabled="">
     <span class="input-group-btn">
      <button onclick="load_data(++window.page_id)" class="btn btn-default" type="button">下一页</button>
     </span>
     <span class="input-group-btn">
      <button onclick="load_data(1)" class="btn btn-default" type="button">刷新新条件</button>
     </span>
     </div>
    </div>
    </div><!-- ./tab-pane -->
    <div class="tab-pane fade" id="style1Tab2">
    <div class="block h4"><strong>最近50条PHP错误记录</strong></div>
    <table class="table table-striped" style="table-layout:fixed; word-break:break-all; word-wrap:break-word;">
    <thead>
     <tr>
     <th style="width:30%">错误提示</th>
     <th style="width:20%">发生错误的文件路径</th>
     <th style="width:5%">行数</th>
     <th style="width:10%">时间</th>
     <th style="width:20%">URL</th>
     </tr>
    </thead>
    <tbody>
     <?php
     if(is_file(TMP_PATH.'log.php')){
     $log = file(TMP_PATH.'log.php');
     $log_i = count($log);
     for($i=0;$i<50;$i++){
      if($log_i <= 0)
      break;

      echo '<tr>';
      $tmp = explode('#',$log[--$log_i]);
      if(isset($tmp[0]))
      echo '<td>'.$tmp[0].'</td>';
      if(isset($tmp[1]))
      echo '<td>'.$tmp[1].'</td>';
      if(isset($tmp[2]))
      echo '<td>'.$tmp[2].'</td>';
      if(isset($tmp[3]))
      echo '<td>'.$tmp[3].'</td>';

      $tmp = explode('##',$log[$log_i]);
      if(isset($tmp[1])){
      echo '<td>'.$tmp[1].'</td>';
      }

      echo '</tr>';
     }
     }else{
     echo '你的环境很干净 没有出现PHP错误.';
     }

     ?>
     
     
     
    </tbody>
    </table>
    </div>
    
    
   </div>
   </div>
  </div>
  </div>
 

 </div>
 </div>

</div>
<script>
 function load_data(i){
 if(i < 1){
  window.page_id=1;
  return;
 }
 $("#pageid_text").val('第 '+i+' 页');
 $.post(window.location.href,{page_id:i,page_size:$("#page-size").val(),user:$("#user-box").val()},function(e){
  if(!e.error){
  $("#tbody").html('<tr><td>无数据</td></td>');
  return;
  }
  var html = '';
  for(o in e.data){
  html+='<tr><td>'+e.data[o].user+' ['+e.data[o].uid+']</td><td style="color:'+(e.data[o].gold < 0 ? 'red' : 'forestgreen')+'">'+e.data[o].gold+'</td><td style="color:'+(e.data[o].credits < 0 ? 'red' : 'forestgreen')+'">'+e.data[o].credits+'</td><td>'+e.data[o].content+'</td><td>'+e.data[o].time+'</td></tr>'
  }

  $("#tbody").html(html);
 },'json');
 }
</script>
{include footer}