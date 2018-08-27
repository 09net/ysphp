<?php
$langa=array('zh'=>['zh-hans','简体中文'],'cht'=>['zh-hant','繁體中文'],'en'=>['en','English'],'ja'=>['ja','日本の'],'ko'=>['ko','한국의'],'es'=>['es','español'],'ru'=>['ru','русский'],'ar'=>['ar','العربية'],'fr'=>['fr','français'],'hi'=>['hi','हिन्दी'],'pt'=>['pt','português'],'de'=>['de','Deutsch']);/*多语言，反正都是送的，指定特定语言请联系QQ：719048503*/
define('LANGA',serialize($langa));
define('YSPHP_VERSION','1.1.1');
define('INDEX_PATH',str_replace('\\', '/', dirname(__FILE__)).'/');
define('NOW_TIME',$_SERVER['REQUEST_TIME']);
/*单语言
define('DOMAIN','44api.com');
define('NOW_LANG','zh');
require INDEX_PATH . 'YS/YS.php';
请删除下面的代码
*/
$SERVERNAME=explode('.',$_SERVER['HTTP_HOST'],2);
if(!isset($SERVERNAME[1])) die('Please bind the domain name');
if(strpos($SERVERNAME[1], '.')=== false){header('HTTP/1.1 301 Moved Permanently');header('Location: //www.'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);die();}/*44api.com*/
define('DOMAIN',$SERVERNAME[1]);
if(in_array($SERVERNAME[0], array_keys($langa))){
define('NOW_LANG',$SERVERNAME[0]);
setcookie('lang', NOW_LANG, NOW_TIME + 864000,'/',DOMAIN);
}else{
define('NOW_LANG','zh');
if(!isset($_GET['no'])){
header('HTTP/1.1 301 Moved Permanently');
$lang=isset($_COOKIE['lang'])?$_COOKIE['lang']:'zh';
header('Location: //'.$lang.'.'.DOMAIN.$_SERVER['REQUEST_URI']);
exit();
}else{
require(INDEX_PATH.'YS/View/LANG.php');
exit();
}
}     
require INDEX_PATH . 'YS/YS.php';