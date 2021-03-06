<?php !defined('YS_PATH') && exit('YS_PATH not defined.'); ?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">*{
margin: 0;
padding: 0;
white-space: normal;
word-break: break-all;
}body {
font-family:"微软雅黑";
background: #F5F5F5;
font-size: 16px;
line-height: 1.7;
}
table{
border-spacing: 0;
border-collapse: collapse;
}
body, td{
font-size: 16px;
padding:1px;
border: 1px solid #ddd;
}
dt {
font-weight: 800;
}
dl,pre{
margin: 0 10px;
}
#backtrace td {
font-size: 16px;
}
.dd{
padding: 10px;
background-color: #FFF;
border: 1px solid #E3E3E3;
box-shadow: 1px 2px 17px #D8D8D8;
margin-bottom: 20px
}

</style>
</head>
<body>

<dl>
<div class="dd" style="margin-top:10px">
<dt>YSPHP详细调试页</dt>
<dd><b style="width:100px">错误信息:</b> <font color="red"> <?php 
echo $message;
?> </font></dd>
<dd><b>发生错误文件:</b> <?php echo $file; ?> </dd>
</div>
<dd class="dd">
<table cellspacing="0" width="100%">
<?php foreach($codelist as $_line=>$code) {?>
<tr <?php if($_line + 1 == $line) echo 'title="" style="background: #f2dede;color: #a94442;"'; ?>>
<td width="40" valign=""><?php echo $_line + 1;?>:</td>
<td><?php echo $code;?></td>
</tr>

<?php } ?>
</table>
</dd>
</dl>

<dl>
<dt>返回跟踪</dt>
<dd class="dd">
<table cellspacing="3" width="100%" id="backtrace">
<tr style="text-align: left;">
<th>文件</th>
<th style="width:38px">行</th>
<th>函数</th>
</tr>
<?php foreach($backtracelist as $k=>$backtrace) {?>
<tr valign="top">
<td><?php echo $backtrace['file'];?></td>
<td><?php echo $backtrace['line'];?></td>
<td><?php if(!empty($backtrace['class'])) {?><?php echo $backtrace['class'];?><?php echo $backtrace['type'];?><?php echo $backtrace['function'];?>(<?php echo nl2br(htmlspecialchars($backtrace['args']));?>)<?php }?></td>
</tr>
<?php } ?>
</table></dd></dl>
<dl class="dd">
<dt>运行信息</dt>
<dd><b>URL:</b> <?php echo $_SERVER['REQUEST_URI'];?></dd>
<dd><b>控制器:</b> <?php echo ACTION_NAME;?></dd>
<dd><b>操作方法:</b> <?php echo METHOD_NAME;?></dd>
<dd><b>访问者ID:</b> <?php echo CLIENT_IP?></dd>
<dd><b>现在服务器时间:</b> <?php echo date('Y/n/j H:i',NOW_TIME);?></dd>

</dl>
<?php if(isset($_SERVER['new_class'])): ?>
<dl class="dd">
<dt>类库加载</dt>
<?php foreach($_SERVER['new_class'] as $key => $file) {?>
<dd><?php echo $key;?></dd>
<?php } ?>
</dl>
<?php endif; ?>

<?php if(isset($_SERVER['sqls'])): ?>
<dl class="dd">
<dt>数据库操作SQL</dt>
<?php foreach($_SERVER['sqls'] as $sql) {?>
<dd><?php echo $sql;?></dd>
<?php } ?>
</dl>
<?php endif; ?>
<dl class="dd">
<dt>文件加载</dt>
<?php foreach(get_included_files() as $file) {?>
<dd><?php echo $file;?></dd>
<?php } ?>
</dl>
<?php if(DEBUG) {
echo '<p class="dd" style=" margin: 10px 10px 0 10px;white-space: pre;word-break: break-word;">$_GET = '.print_r($_GET, 1).'</p>';
echo '<p class="dd" style=" margin: 10px 10px 0 10px;white-space: pre;word-break: break-word;">$_POST = '.print_r($_POST, 1).'</p>';
echo '<p class="dd" style=" margin: 10px 10px 0 10px;white-space: pre;word-break: break-word;">$_COOKIE = '.print_r($_COOKIE, 1).'</p>';
echo '<p class="dd" style=" margin: 10px 10px 0 10px;">内存使用 = '.(memory_get_usage() / 1000).' kb</p>';
echo '<p class="dd" style=" margin: 10px 10px 0 10px;">运行时间 = '.number_format(microtime(1) - $GLOBALS['START_TIME'], 4).' s</p>';
}?></body></html>