<div id="YS-BOX" style="z-index: 1000;display:none;position: fixed; left: 0px; right: 0px; bottom: 0px; height: 200px; overflow-y: auto; background-color: rgb(245, 245, 245); border-top: 1px solid rgb(224, 224, 224);">
 <div id="YS-CLOSE" style="z-index: 999;font-size: 15pt; color: rgb(0, 0, 0); cursor: pointer; position: absolute; right: 9px; font-weight: bold; padding: 0px 10px;">−</div>
 <div style="z-index: 998;border-bottom: solid 1px #D2D2D2;height: 33px;position: absolute;width: 100%;background-color: #FFF;">
 <ul id="YS-LIST" class="YS1">
 <li class="action">运行</li>
 <li>数据库</li>
 <li>文件</li>
 <li>类</li>
 <li>COOKIE</li>
 </ul>
 </div>
 <div id="YS-ID0" style="height: 198px;overflow-y: auto;">
 <ul class="YS">
 <li style="border-top: solid 1px #D2D2D2;">请求：<?php echo $url; ?></li>
 <li>控制与方法：<?php echo $_Action; ?> <?php echo $_Fun; ?></li>
 <li>时间：<?php echo round($GLOBALS['END_TIME'] - $GLOBALS['START_TIME'],4); ?> s</li>
 <li>时间戳：<?php echo NOW_TIME; ?> </li>
 <li>内存：<?php echo round((memory_get_usage() - $GLOBALS['START_MEMORY'])/1024); ?> Kb</li>
 <li>DEBUG：<?php echo DEBUG?'开启':'未开启'; ?> </li>
 <li id="YS-COOKIE">COOKIE：</li>
 </ul>
 </div>
 <div id="YS-ID1" style="height: 198px;overflow-y: auto;display:none;">
 <ul class="YS">
 <li style="border-top: solid 1px #D2D2D2;">SQL (<?php echo count($DEBUG_SQL)-1; ?>)</li>
 <?php foreach ($DEBUG_SQL as $v): ?>
 <li><?php echo $v; ?></li>
 <?php endforeach; ?>
 </ul>
 </div>
 <div id="YS-ID2" style="height: 198px;overflow-y: auto;display:none;">
 <ul class="YS">
 <li style="border-top: solid 1px #D2D2D2;">文件 (<?php echo count(get_included_files()); ?>)</li>
 <?php foreach (get_included_files() as $v): ?>
 <li><?php echo $v; ?></li>
 <?php endforeach; ?>
 </ul>
 </div>
 <div id="YS-ID3" style="height: 198px;overflow-y: auto;display:none;">
 <ul class="YS">
 <li style="border-top: solid 1px #D2D2D2;">New 类 (<?php echo count($DEBUG_CLASS); ?>)</li>
 <li>new \YS</li>
 <?php foreach ($DEBUG_CLASS as $k => $v): ?>
 <li>new \<?php echo $k; ?></li>
 <?php endforeach; ?>
 </ul>
 </div>
 <div id="YS-ID4" style="height: 198px;overflow-y: auto;display:none;">
 <ul class="YS">
 <?php if(!isset($_COOKIE))
 $_COOKIE = array();
 else{
 if(empty($_COOKIE)) 
 $_COOKIE = array();
 }
 ?>
 <li style="border-top: solid 1px #D2D2D2;">COOKIE (<?php echo count($_COOKIE); ?>)</li>
 <?php foreach ($_COOKIE as $k => $v): ?>
 <li><?php echo $k; ?> : <?php echo $v; ?></li>
 <?php endforeach; ?>
 </ul>
 </div>
</div>
<style>
#YS-BOX{
font-family: "微软雅黑";}
.YS{
padding: 0;
margin: 0;
margin-top: 45px;
word-wrap: break-word;word-break:break-all;}
.YS1{
padding: 0;margin: 0;}
.YS1>li.action{
 background-color: #F3F3F3;color: #078600;}
.YS1>li{
 list-style: none;
 float: left;padding: 5px 10px;background-color: #FFF;cursor: pointer;}
.YS>li{
 font-size: 16px;
 list-style: none;
 background-color: #FFF;
 border-bottom: solid 1px #D2D2D2;
 padding: 5px 10px;}</style>
<div id="YS-SHOW" onclick style="position: fixed;right: 0px;bottom: 0px;display: block;color: #6E185F;padding: 0 8px;font-weight: bold;vertical-align: middle;cursor: pointer;height: 35px;line-height: 35px;border: dashed;">
 <span style=" float: left;">
 耗时 <?php echo round($GLOBALS['END_TIME'] - $GLOBALS['START_TIME'],4);?>毫秒
 <?php if(function_exists('memory_get_usage')): ?>
 内存:<?php echo round((memory_get_usage() - $GLOBALS['START_MEMORY'])/1024);?>KB
 <?php endif ?>
 </span>
</div>
<script>
(function(){
var cookie = document.cookie.match(/YS_DEBUG=(\d)/);
var YS_BOX = document.getElementById('YS-BOX');
var YS_open = document.getElementById('YS-SHOW');
var YS_close = document.getElementById('YS-CLOSE');
var YS_LI = document.getElementById('YS-LIST').getElementsByTagName('li');
document.getElementById('YS-COOKIE').innerHTML = 'COOKIE：'+document.cookie;
if(cookie && typeof cookie[1] != 'undefined')
 cookie = cookie[1];
else
 cookie = 0;

if(cookie == 0){
 YS_BOX.style.display = 'none';
 YS_open.style.display = 'block';
}else{
 YS_BOX.style.display = 'block';
 YS_open.style.display = 'none';
}

YS_open.onclick = function(){
 YS_BOX.style.display = 'block';
 YS_open.style.display = 'none';
 document.cookie = 'YS_DEBUG=1';
}
YS_close.onclick = function(){
 YS_BOX.style.display = 'none';
 YS_open.style.display = 'block';
 document.cookie = 'YS_DEBUG=0'
}


for(var i = 0; i < YS_LI.length; i++){
 YS_LI[i].onclick = (function(i){
 return function(){
 for(var j = 0; j < YS_LI.length; j++){
 YS_LI[j].className = '';
 document.getElementById('YS-ID'+j).style.display = 'none';
 }
 YS_LI[i].className = 'action';
 document.getElementById('YS-ID'+i).style.display = 'block';
 }
 })(i)
}
})();</script>
