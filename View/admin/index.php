{include header}
<div class="wrapper">
  {include header_menu}
  <div class="main-container">
   <div class="padding-md">
      <div id="mess">
       

      </div>
      <div id="code-mess">
       
      </div>
   
      <style>
      .list-group-item>.sone{
        width: 100px;
        display: inline-block;
      }
      </style>
      <h3 class="m-left-xs header-text m-top-lg">{lag 缓存清理}</h3>
      <div class="smart-widget">
   <div class="smart-widget-header">
 {lag 缓存清理}

   </div>
   <div class="smart-widget-inner">
    <div class="smart-widget-body">

          <form action="" method="post" id="formToggleLine" class="form-horizontal no-margin form-border">
          
          <div class="form-group">
      <label class="col-lg-2 control-label">{lag 文件组建缓存}</label>
      <div class="col-lg-10">
       <div class="checkbox inline-block">
        <div class="custom-checkbox">
         <input name="one1" type="checkbox" id="inlineCheckbox1" class="checkbox-red">
         <label for="inlineCheckbox1"></label>
        </div>
        <div class="inline-block vertical-top">(Tmp)</div>
       </div>
      </div>
     </div>
     <div class="form-group">
      <label class="col-lg-2 control-label">{lag 多语言翻译}</label>
      <div class="col-lg-10">
       <div class="checkbox inline-block">
        <div class="custom-checkbox">
         <input name="lang" type="checkbox" id="lang" class="checkbox-red">
         <label for="lang"></label>
        </div>
        <div class="inline-block vertical-top">
         Cache（DB：fyCache）
        </div>
       </div>
      </div>
     </div>

     <div class="form-group">
      <label class="col-lg-2 control-label">{lag 数据缓存}</label>
      <div class="col-lg-10">
       <div class="checkbox inline-block">
        <div class="custom-checkbox">
         <input name="one3" type="checkbox" id="inlineCheckbox3" class="checkbox-red">
         <label for="inlineCheckbox3"></label>
        </div>
        <div class="inline-block vertical-top">
         {lag 数据缓存}
        </div>
       </div>
      </div>
     </div>

     <div class="form-group">
      <label class="col-lg-2 control-label">{lag 日志文件}</label>
      <div class="col-lg-10">
       <div class="checkbox inline-block">
        <div class="custom-checkbox">
         <input name="one4" type="checkbox" id="inlineCheckbox4" class="checkbox-red">
         <label for="inlineCheckbox4"></label>
        </div>
        <div class="inline-block vertical-top">
         {lag 文件大小}: <?php if(is_file(TMP_PATH .'log.php')){echo number_format(floatval(((filesize(TMP_PATH .'log.php')/1024)/1024)),3,'.', '') . 'MB'; }else{echo fy('无');} ?>
        </div>
       </div>
      </div>
     </div>


          

          <div class="form-group">
      <label class="col-lg-2 control-label">{lag 确认}</label>
      <div class="col-lg-10">
       <button class="btn btn-danger">{lag 提交}</button>
      </div><!-- /.col -->
     </div>
        </form>
    </div>
   </div><!-- ./smart-widget-inner -->
  </div>
    <h3 class="m-left-xs header-text m-top-lg">{lag 服务器信息}</h3>
    <div class="row m-top-md">
        <div class="col-sm-12">
          <table class="table table-striped table-bordered " id="dataTable">
      <thead>
       <tr class="bg-dark-blue">
        <th class="col-sm-2">{lag 名称}</th>
        <th class="col-sm-10">{lag 信息}</th>

       </tr>
      </thead>
      <tbody>
              
              <tr>
        <td>{lag 论坛版本}</td>
        <td><label class="label label-success"><?php echo YSPHP_VERSION;?></label></td>

       </tr>
       <tr>
        <td>YSPHP {lag 框架版本}</td>
        <td><?php echo YSPHP_VERSION;?></td>

       </tr>
       <tr>
        <td>
         {lag 伪静态}
        </td>
        <td id="re">{lag 检测中}</td>
       </tr>
       <tr>
        <td>{lag 服务器IP地址}</td>
        <td><?php if('/'==DIRECTORY_SEPARATOR){echo $_SERVER['SERVER_ADDR'];}else{echo @gethostbyname($_SERVER['SERVER_NAME']);} ?></td>
       </tr>
       <tr>
        <td>{lag 本机发信IP}</td>
        <td id="ip">{lag 加载中}</td>
       </tr>
       {if function_exists('disk_free_space') && function_exists('disk_total_space')}
       <tr>
        <td>{lag 磁盘空间大小}</td>
        <td>
         <div class="progress" style="height: 20px;margin-bottom: 0;">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo 100-number_format((disk_free_space(INDEX_PATH)/disk_total_space(INDEX_PATH))*100,0); ?>%">
            <span class="">已用<?php echo 100-number_format((disk_free_space(INDEX_PATH)/disk_total_space(INDEX_PATH))*100,0); ?>% 剩余<?php echo number_format(disk_free_space(INDEX_PATH)/1024/1024,0,'.','.');?> G / 总量<?php echo number_format(disk_total_space(INDEX_PATH)/1024/1024,0,'.','.');?> G</span>
           </div>
         </div>
         
        </td>
       </tr>
       {/if}
       <tr>
        <td>{lag 服务器信息}</td>
        <td><?php if(function_exists('php_uname')) echo php_uname();?></td>
       </tr>
       <tr>
        <td>{lag 服务器系统}</td>
        <td><?php if(function_exists('php_uname')) echo php_uname('s');?></td>

       </tr>
       <tr>
        <td>{lag 服务器类型}</td>
        <td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
       </tr>
       <tr>
        <td>{lag 根目录}</td>
        <td><?php echo INDEX_PATH;?></td>
       </tr>
       <tr>
        <td>PHP</td>
        <td>
        <?php
$able=get_loaded_extensions();
foreach ($able as $key=>$value) {
 if ($key!=0 && $key%13==0) {
  echo '<br /><br />';
 }
 echo '<label class="label label-success" style="margin-bottom:10px">'.$value.'</label>&nbsp;&nbsp;';
 
}
?>
        </td>
       </tr>
       

              <tr>
        <td>PHP {lag 版本}</td>
        <td><?php echo PHP_VERSION;?></td>
       </tr>
       <tr>
        <td>PHP {lag 安装路径}</td>
        <td><?php echo DEFAULT_INCLUDE_PATH;?></td>
       </tr>
       <tr>
        <td>PHP {lag 运行方式}</td>
        <td><?php echo strtoupper(php_sapi_name());?></td>
       </tr>
       <tr>
        <td>PHP脚本最大内存可用</td>
        <td><?php echo get_cfg_var("memory_limit");?></td>
       </tr>
       <tr>
        <td>POST提交字节最大限制</td>
        <td><?php echo get_cfg_var("post_max_size");?></td>
       </tr>
       <tr>
        <td>上传文件最大限制字节</td>
        <td><?php echo get_cfg_var("upload_max_filesize");?></td>
       </tr>
       <tr>
        <td>脚本超时时间</td>
        <td><?php echo get_cfg_var("max_execution_time");?>秒</td>
       </tr>
       
       {if function_exists('Zend_Version')}
              <tr>
        <td>Zend版本</td>
        <td><?php echo Zend_Version();?></td>
       </tr>
       {/if}
              
              <tr>
        <td>网站根目录</td>
        <td><?php echo INDEX_PATH;?></td>
       </tr>
       {if function_exists('GetHostByName')}
              <tr>
        <td>服务器IP</td>
        <td><?php echo GetHostByName($_SERVER['SERVER_NAME']);?></td>
       </tr>
       {/if}
              
              <tr>
        <td>当前你的访问IP</td>
        <td><?php echo $_SERVER['ip'];?></td>
       </tr>
              
              <tr>
        <td>{lag 服务器语言}</td>
        <td><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?></td>
       </tr>


      </tbody>

     </table>
        </div>
    </div>
      
  
   </div>
   <!-- ./padding-md -->
  </div>
  {include left_menu}


</div>
{include footer}
<script>
 $.get('/admin/getip',function(e){
  $("#ip").text(e.info);
 },'json');
 $.ajax({
  url:'/admin/is_rewrite',
  type:'get',
  dataType:'html',
  success:function(e){
   if(e=='on')
    return $('#re').html('<label class="label label-success"><i class="fa fa-check"></i>{lag 支持}</label>');
   $('#re').html('<label class="label label-danger"><i class="fa fa-close"></i>{lag 不支持}</label>');
  },error:function(e){
   $('#re').html('<label class="label label-danger"><i class="fa fa-close"></i>{lag 不支持}</label>');
  }
 })
</script>