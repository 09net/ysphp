<?php
function escape($str) {  
    preg_match_all ( "/[\xc2-\xdf][\x80-\xbf]+|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}|[\x01-\x7f]+/e", $str, $r );  
    //匹配utf-8字符，   
    $str = $r [0];  
    $l = count ( $str );  
    for($i = 0; $i < $l; $i ++) {  
        $value = ord ( $str [$i] [0] );  
        if ($value < 223) {  
            $str [$i] = rawurlencode ( utf8_decode ( $str [$i] ) );  
        //先将utf8编码转换为ISO-8859-1编码的单字节字符，urlencode单字节字符.   
        //utf8_decode()的作用相当于iconv("UTF-8","CP1252",$v)。   
        } else {  
            $str [$i] = "%u" . strtoupper ( bin2hex ( iconv ( "UTF-8", "UCS-2", $str [$i] ) ) );  
        }  
    }  
    return join ( "", $str );  
}  
function unescape($str) {  
    $ret = '';  
    $len = strlen ( $str );  
    for($i = 0; $i < $len; $i ++) {  
        if ($str [$i] == '%' && $str [$i + 1] == 'u') {  
            $val = hexdec ( substr ( $str, $i + 2, 4 ) );  
            if ($val < 0x7f)  
                $ret .= chr ( $val );  
            else if ($val < 0x800)  
                $ret .= chr ( 0xc0 | ($val >> 6) ) . chr ( 0x80 | ($val & 0x3f) );  
            else  
                $ret .= chr ( 0xe0 | ($val >> 12) ) . chr ( 0x80 | (($val >> 6) & 0x3f) ) . chr ( 0x80 | ($val & 0x3f) );  
            $i += 5;  
        } else if ($str [$i] == '%') {  
            $ret .= urldecode ( substr ( $str, $i, 3 ) );  
            $i += 2;  
        } else  
            $ret .= $str [$i];  
    }  
    return $ret;  
} 

function unicode_encode($name)
{
    $name = iconv('UTF-8', 'UCS-2', $name);
    $len = strlen($name);
    $str = '';
    for ($i = 0; $i < $len - 1; $i = $i + 2)
    {
        $c = $name[$i];
        $c2 = $name[$i + 1];
        if (ord($c) > 0)
        {   //两个字节的文字
            $str .= '\u'.base_convert(ord($c), 10, 16).str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);
        }
        else
        {
            $str .= $c2;
        }
    }
    return $str;
}
//将UNICODE编码后的内容进行解码
function unicode_decode($name)
{
    //转换编码，将Unicode编码转换成可以浏览的utf-8编码
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches))
    {
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++)
        {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0)
            {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code).chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            }
            else
            {
                $name .= $str;
            }
        }
    }
    return $name;
}
function ampimg($str){
$str=$str[1];
if(!preg_match('/src=[\"|\'](.*?)[\"|\']/i',$str,$src)) return '';
if(preg_match('/width=[\"|\'](\d*)[\"|\']/i',$str,$w) and preg_match('/height=[\"|\'](\d*)[\"|\']/i',$str,$h)){
$wz=$w[1];
$hz=$h[1];
}else{
$wz=3;
$hz=4;
}
return '<amp-img src="'.$src[1].'" width="'.$wz.'"  height="'.$hz.'" layout="responsive"></amp-img>';

}
function echotag($img){if($img==''){return false;}$s2=explode(' ',$img);
foreach($s2 as $value) echo '<a href="/search/',urlencode($value),'.html">',$value,'</a>';
}

function read_header($ch, $header){
 $comps = explode(":", $header);
 if (count($comps) >= 2){
 if (strcasecmp(trim($comps[0]), "Content-Type") == 0){
  if (strpos($comps[1], "mp3") > 0 ){
  
  }else{
  die($header);
  }
 }
 }
 return strlen($header);
}
function img1($img,$size='_180'){
$s2=explode(',',$img,2);
$s2[0]=img_w_h($s2[0]);
if($size) return $s2[0][0].$size;else return $s2[0][0];
}
function echoimg1($img,$size='_180'){if($size) $s2=explode(',',str_replace('{m}',bucketcdn,$img),2); else $s2=explode(',',str_replace('{m}',imgcdn,$img),2);
$s2[0]=img_w_h($s2[0]);return $s2[0][0].$size;
}/*输出图片*/
function echoimg($img,$size='_180',$mode=false,$alt=''){
if(empty($img)) return false;
if($alt=='') $alt=fy('配图'); else $alt=addslashes($alt);
if($size=='') $qz=imgcdn;else $qz=bucketcdn;
$s2=explode(',',trim(str_replace('{m}',$qz,$img),','));
if($mode){
if($mode==='amp180'){
$s2[0]=img_w_h($s2[0],$size);
if(count($s2)>1){
$s2[1]=img_w_h($s2[1],$size);
echo '<amp-img src='.$s2[0][0].$size.' width="180" height="180" layout="fixed"></amp-img><amp-img src='.$s2[1][0].$size.' width="180" height="180" layout="fixed"></amp-img>';
}else{
echo '<amp-img src='.$s2[0][0].$size.' width="180" height="180" layout="fixed"></amp-img>';
}
return true;
}


foreach($s2 as $value){
$value=img_w_h($value,$size);
if(strtolower(substr($value[0], 0, 4))=='http'){/*兼容性处理*/
if($mode==='amp') echo '<amp-img src="',$value[0].$size,'" ',$value[1],' layout="responsive"></amp-img>'; else echo '<img src=',$value[0],$size.' alt="',$alt,'" onerror="nf(this);" />';
}else{
if($mode==='amp') echo '<amp-img src="',$qz,$value[0],$size,'" ',$value[1],' layout="responsive"></amp-img>';else echo '<img src=',$qz,$value[0],$size,' alt="',$alt,'" onerror="nf(this);" />';
}
}
return true;
}

$s2[0]=img_w_h($s2[0],$size);
if(count($s2)>1){
$s2[1]=img_w_h($s2[1],$size);
echo '<img src='.$s2[0][0].$size.' alt="'.$alt.'" onerror="nf(this);" /><img src='.$s2[1][0].$size.' alt="'.$alt.'" onerror="nf(this);" />';
}else{
echo '<img src='.$s2[0][0].$size.' alt="'.$alt.'" onerror="nf(this);" />';
}}

function img_w_h($img,$size=false){
$img = explode('@', $img);
if(isset($img[1])) $img[1]='width='.str_replace('|',' height=',$img[1]).' ';else $img[1]='width=3 height=4';/*amp*/
if($size) $img[1]='width=1 height=1';/*缩微图*/
return $img;
}

function A($name) {
 $class = "\Action\\{$name}";
 return new $class;
}

function g($name) {
 return $GLOBALS[$name];
}
function X($name,$default = ''){
    $data = explode(".",$name);
    if(count($data) == 2){
        $v = $data[1];
        if($data[0]=='get'){
            return isset($_GET[$v])?$_GET[$v]:$default;
        }elseif($data['0']=='post'){
            return isset($_POST[$v])?$_POST[$v]:$default;
        }elseif($data['0']=='session'){
            return isset($_SESSION[$v])?$_SESSION[$v]:'$default';
        }elseif($data['0']=='cookie'){
            return isset($_COOKIE[$v])?$_COOKIE[$v]:'$default';
        }elseif($data['0']=='server'){
            return isset($_SERVER[$v])?$_SERVER[$v]:'$default';
        }
    }
    return '';
}
function S($name, $more = '') {
 return new YS\Model(strtolower($name) , $more);
}
function M($name, $more = '') {
 $class = "\Model\\{$name}";
 return new $class(strtolower($name) , $more);
}
function L($name) {
 $class = "Lib\\{$name}";
 return new $class;
}
function Sl($name) {
 $class = "Slib\\{$name}";
 return new $class;
}


function oss($file, $getObject,$data=''){
 static $oss =false;
if($oss==false) $oss=require(INDEX_PATH.'oss/Common.php');
if(empty($GLOBALS['conf']['OSS_BUCKET'])) return false;
switch ($getObject){
case 'getObject':
return $oss->getObject($GLOBALS['conf']['OSS_BUCKET'],$file);
  break;  
case 'putObject':
return $oss->putObject($GLOBALS['conf']['OSS_BUCKET'],$file,$data);
  break;
  case 'doesObjectExist':
return $oss->doesObjectExist($GLOBALS['conf']['OSS_BUCKET'],$file);
  break;
   case 'multiuploadFile':
return $oss->multiuploadFile($GLOBALS['conf']['OSS_BUCKET'],$file,$data);
  break;
  
  
default:
}
return false; 
}
function isValidData($s){//垃圾检测
 if(preg_match("/([\S])\\1{4,}/u",$s)){
 return fy('字符重复');
 }elseif(preg_match("/^[0-9a-zA-Z]*$/",$s)){
 return fy('只有字母和数字');
 }elseif(preg_match("/([a-zA-Z0-9\-]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}/s",$s)){
 return fy('包含网址');
 }elseif(strlen($s)<5){
 return fy('长度不过');
 }
 return false;

}

function mk($text, $toVariant=false){
 static $mk =false;
 static $mk_i=0;
 if($mk_i>5) return $text;
 if($toVariant==false) return $text;
 if($mk==false) $mk=require(INDEX_PATH.'mk/zhconverter.php');
 $mk_i++;
 return $mk->convert($text, $toVariant);
}

function C($name = null, $value = null, $default = null) {
 static $_config = array();
 if (empty($name)) {
 return $_config;
 }
 if (is_string($name)) {
 if (!strpos($name, '.')) {
  $name = strtoupper($name);
  if (is_null($value)) return isset($_config[$name]) ? $_config[$name] : $default;
  $_config[$name] = $value;
  return null;
 }
 $name = explode('.', $name);
 $name[0] = strtoupper($name[0]);
 if (is_null($value)) return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
 $_config[$name[0]][$name[1]] = $value;
 return null;
 }
 if (is_array($name)) {
 $_config = array_merge($_config, array_change_key_case($name, CASE_UPPER));
 return null;
 }
 return null;
}
function cookie($name = '', $value = '', $expire = 0) {
 $name = str_replace('.', '_', $name);
 if ('' === $value) {
 if ('' === $name) {
  return $_COOKIE;
 } elseif (isset($_COOKIE[$name])) {
  $value = $_COOKIE[$name];
  return $value;
 } else {
  return null;
 }
 } else {
 if (is_null($value)) {
  setcookie($name, '', NOW_TIME - 3600, '/', DOMAIN);
  unset($_COOKIE[$name]);
 } else {
  $expire = !empty($expire) ? NOW_TIME + intval($expire) : NOW_TIME + 8640000;
  setcookie($name, $value, $expire, '/', DOMAIN);
  $_COOKIE[$name] = $value;
 }
 }
 return null;
}
function session($name = '', $value = '') {
 if ('' === $value) {
 if ('' === $name) {
  return $_SESSION;
 } elseif (0 === strpos($name, '[')) {
  if ('[pause]' == $name || '[stop]' == $name) {
  session_write_close();
  } elseif ('[start]' == $name) {
  session_start();
  } elseif ('[destroy]' == $name || '[end]' == $name) {
  $_SESSION = array();
  session_unset();
  session_destroy();
  } elseif ('[regenerate]' == $name) {
  session_regenerate_id();
  }
 } elseif (0 === strpos($name, '?')) {
  $name = substr($name, 1);
  if (strpos($name, '.')) {
  list($name1, $name2) = explode('.', $name);
  return isset($_SESSION[$name1][$name2]);
  } else {
  return isset($_SESSION[$name]);
  }
 } elseif (is_null($name)) {
  $_SESSION = array();
 } else {
  if (strpos($name, '.')) {
  list($name1, $name2) = explode('.', $name);
  return isset($_SESSION[$name1][$name2]) ? $_SESSION[$name1][$name2] : null;
  } else {
  return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
  }
 }
 } elseif (is_null($value)) {
 if (strpos($name, '.')) {
  list($name1, $name2) = explode('.', $name);
  unset($_SESSION[$name1][$name2]);
 } else {
  unset($_SESSION[$name]);
 }
 } else {
 if (strpos($name, '.')) {
  list($name1, $name2) = explode('.', $name);
  $_SESSION[$name1][$name2] = $value;
 } else {
  $_SESSION[$name] = $value;
 }
 }
 return null;
}
function format_size($size){
if ($size==0){return '-';}
 if ($size >= 1073741824){$size = round($size / 1073741824 * 100) / 100 . ' GB';}elseif ($size >= 1048576){$size = round($size / 1048576 * 100) / 100 . ' MB';}elseif ($size >= 1024){$size = round($size / 1024 * 100) / 100 . ' KB';}else{$size = $size . ' Bytes';}
 return $size;
}
function put_tmp_file($path, $content) {
 if (!is_dir(TMP_PATH)) return;
 file_put_contents($path, "<?php !defined('YS_PATH') && exit('YS_PATH not defined.'); ?>\r\n" . $content);
}

function E($str, $save_log = true) {
 $GLOBALS['Exception_save_log'] = $save_log;
 throw new \Exception($str);
}
function YS_is_mobile() {
 static $is_mobile;
 if (isset($is_mobile)) return $is_mobile;
 if (empty($_SERVER['HTTP_USER_AGENT'])) {
 $is_mobile = false;
 } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false) {
 $is_mobile = true;
 } else {
 $is_mobile = false;
 }
 return $is_mobile;
}
function cache($name, $value = '', $options = null) {
 static $cache = '';
 if (is_array($options)) {
 $type = isset($options['type']) ? $options['type'] : '';
 $cache = YS\Lib\Cache::getInstance($type, $options);
 } elseif (is_array($name)) {
 $type = isset($name['type']) ? $name['type'] : '';
 $cache = YS\Lib\Cache::getInstance($type, $name);
 return $cache;
 } elseif (empty($cache)) {
 $cache = YS\Lib\Cache::getInstance();
 }
 if ('' === $value) {
 return $cache->get($name);
 } elseif (is_null($value)) {
 return $cache->rm($name);
 } else {
 if (is_array($options)) {
  $expire = isset($options['expire']) ? $options['expire'] : NULL;
 } else {
  $expire = is_numeric($options) ? $options : NULL;
 }
 return $cache->set($name, $value, $expire);
 }
}
function to_guid_string($mix) {
 if (is_object($mix)) {
 return spl_object_hash($mix);
 } elseif (is_resource($mix)) {
 $mix = get_resource_type($mix) . strval($mix);
 } else {
 $mix = serialize($mix);
 }
 return md5($mix);
}
function DB_FY($name, $value = '', $expire = 0) {

 static $DB_cache = '';
 if (empty($DB_cache)) $DB_cache = cache(array(
 'type' => 'db',
 'table'=>'fycache',
 'expire'=>0
 ));
 if (is_null($value)) return $DB_cache->rm($name);
 elseif ($value === '') return $DB_cache->get($name);
 else return $DB_cache->set($name, $value, $expire);
}
function F($name, $value = '', $expire = 0) {
 static $file_cache = '';
 if (empty($file_cache)) $file_cache = cache(array(
 'type' => 'file'
 ));
 if (is_null($value)) return $file_cache->rm($name);
 elseif ($value === '') return $file_cache->get($name);
 else return $file_cache->set($name, $value, $expire);
}
function vendor($path) {
 $vendor_arr = C('vendor');
 array_push($vendor_arr, $path);
 C('vendor', $vendor_arr);
}
function fy2($query, $from, $to) {
 $q = '';
 $query = str_replace('
', '
<br>', $query);
 $query = str_replace('<', '
<', $query);
 $query = str_replace('>', '>
', $query);
 foreach (explode('
', $query) as $value) {
 $value = trim($value);
 if ($value <> '' and substr($value, 0, 1) <> '<' and $from != $to and $GLOBALS['fynum'] < 2) {
  $hash = md5($from . '_' . $to . '_' . $value) . $from . $to;
  if (($from == 'zh' and $to == 'cht') or ($to == 'zh' and $from == 'cht')) {
  $q.= fy($value, $from, $to);
  } else {
  $q.= '<p><span id="' . $hash . '2">' . fy($value, $from, $to) . '</span><a href="javascript:void(0);" onclick="fyadd(this)" id="' . $hash . '"><abbr>' . fy('优化') . '</abbr></a></p>' . '<blockquote>' . $value . '</blockquote>';
  }
 } else {
  $q.= $value;
 }
 }
 return $q;
}
function fy_true($query, $from = 'zh-CN', $to = NOW_LANG) {
 $query = trim($query);
 if ($from == $to or $query == '') return $query;
 $md5 = md5($from . '_' . $to . '_' . $query);
 if(!$query2 = DB_FY($md5)){
 if (in_array($from,array('zh-TW','zh-CN')) and in_array($to,array('zh-TW','zh-CN'))) {
 if($to == 'zh-TW') $query2 = mk($query, 'cht');else $query2 = mk($query, 'zh');
 } else {
 $query2 = trim(translate2($query, $to,$from));
 }
 if ($query2) DB_FY($md5,$query2,864000);
 }
 return $query2;
}

function ch2arr($str){$length=mb_strlen($str,'utf-8');$array=array();for($i=0;$i<$length;$i++){if($i>200) break;$array[]=mb_substr($str,$i,1,'utf-8');}return $array;}


function fy($query, $from = 'zh', $to = NOW_LANG,$q2='') {
 global $fynum;
 $query = trim($query);
 if ($from == $to or $query == '') return $query;
 $hash = md5($from . '_' . $to . '_' . $query) . $from . $to;
 if ($q2){DB_FY($hash, $q2, 0); return true;}
 $str = DB_FY($hash);
 if ($str !== false) return $str;
 if ($GLOBALS['fynum'] > 1) return $query;
 if (($from == 'zh' and $to == 'cht') or ($to == 'zh' and $from == 'cht')) {
 $query2 = mk($query, $to);
 
 } else {
 $query2 = trim(translate($query,$to,$from));
 $GLOBALS['fynum'] = $GLOBALS['fynum'] + 1;
 }
 if ($query2) {
 DB_FY($hash, $query2, 0);
 return $query2;
 } else {
 return $query;
 }
}
function translate2($query, $to,$from='auto') {
 if(!$GLOBALS['conf']['token']) return false;
 $curl = curl_init();
 $url = 'https://zh.picadv.com/open/fy?tk='.$GLOBALS['conf']['token'].'&source='.$from.'&target=' . $to . '&q=' . urlencode($query);
 curl_setopt($curl, CURLOPT_URL, $url);
 curl_setopt($curl, CURLOPT_HEADER, 0);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 $data = curl_exec($curl);
 curl_close($curl);
 $json = json_decode($data, true);
 if (isset($json['data'])) return $json['data']; else return false;
 return false;
}
function translate($query, $to,$from='auto') {
 if (preg_match('/[=\(\[\{;]+/', $query)) return $query;
 if(!$GLOBALS['conf']['token']) return false;
 $curl = curl_init();
 $url = 'https://zh.picadv.com/open/fy?tk='.$GLOBALS['conf']['token'].'&source='.$from.'&target=' . $to . '&q=' . urlencode($query);
 curl_setopt($curl, CURLOPT_URL, $url);
 curl_setopt($curl, CURLOPT_HEADER, 0);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 $data = curl_exec($curl);
 curl_close($curl);
 $json = json_decode($data, true);

 if (isset($json['data'])) return $json['data']; else return false;
 return false;
}
function br2nl($text) {
 return preg_replace('/<br\\s*?\/??>/i', '
', $text);
}
function geshihua($text) {
if ($text == '') return '';
$text = explode('
', trim(br2nl($text)));
$str = '';
foreach ($text as $value) {
$value=trim($value);
if($value!='' and $str!='' and substr($value,0,1)!='<') $str .='<br>'.$value; else $str .=$value;
}
return $str;
}
function bool_ads_url($linka = '') { /*允许的外链*/
 if ($linka == '') return false;
 if ($link = parse_url($linka) and isset($link['host']) and isset($link['scheme'])) {
 if (in_array(get_host($link['host']) , array(
  'ysv8.com',
  'taobao.com'
 )) and in_array($link['scheme'], array(
  "http",
  "https"
 ))) return true;
 }
 return false;
}
function get_host($url) {
 $data = explode('.', $url);
 $co_ta = count($data);
 if ($co_ta > 2) return $data[$co_ta - 2] . '.' . $data[$co_ta - 1];
 return false;
}
function conkeys($text, $mode = true) {
 if ($text == '') return '';
 /*下面两句是错误临时处理*/
 if (stripos($text, '</strong>' === 0)) $text = substr($text, 9);
 $text = str_replace(array(
 '[img]',
 '[/img]',
 '[/u]',
 '[u=',
 ']'
 ) , array(
 '',
 '',
 '</a>',
 '<a href=',
 '>'
 ) , $text);
 if ($mode) {
 if (substr($text, 0, 3) == '{m}') {
  $ta = explode('[t]', $text);
  $ta[0] = '<img src="' . $ta[0] . '" />';
  return turl(implode('<br>', $ta));
 }
 } else {
 if (substr($text, 0, 3) == '{m}') {
  $ta = explode('[t]', $text);
  return turl($ta[0]);
 }
 }
 return nl2br(turl($text));
}
function dbcache($name) {
 return $cache = YS\Lib\Cache::getInstance('Db');
}





function base64url_encode($data) { 
return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
}
function tags($tag) {
$tag=trim($tag); 
if($tag=='') return false;
$a=explode(' ',$tag);
foreach ($a as $v2) {
if($v2!='') echo '<a href="/tg/'.urlencode($v2).'.html">'.$v2.'</a>';
}

} 
function turl($str,$size=true){if($size){return str_replace('{m}',bucketcdn,$str);}else{return str_replace(bucketcdn,'{m}',$str);}}
function img_curl($url,$size=''){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url );
if($size=='json'){
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data=curl_exec( $ch );
curl_close($ch); 
return json_decode($data);
}else{
curl_exec( $ch );
curl_close($ch); 
}
}

function getRand($proArr) {$result = '';
 $proSum = array_sum($proArr);
 foreach ($proArr as $key => $proCur) {
 $randNum = mt_rand(1, $proSum);
 if ($randNum <= $proCur) {
 $result = $key;
 break;
 } else {
 $proSum -= $proCur;
 }
 }
 unset ($proArr);
 return $result;
}
function humandate($timestamp,$str='就绪') {
 $seconds = $_SERVER['REQUEST_TIME'] - $timestamp;
 if($seconds > 31536000) {
 return date('Y-n-j', $timestamp);
 } elseif($seconds > 2592000) {
 return floor($seconds / 2592000).fy('月');
 } elseif($seconds > 86400) {
 return floor($seconds / 86400).fy('天');
 } elseif($seconds > 3600) {
 return floor($seconds / 3600).fy('小时');
 } elseif($seconds > 60) {
 return floor($seconds / 60).fy('分钟');
 } elseif($seconds < 0) {
 return fy($str);
 } else {
 return $seconds.fy('秒');
 }
}

function rand_str($size){/*随机字符串*/
 $str = '';
 $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
 $max = strlen($strPol)-1;
 for($i=0;$i<$size;$i++){
 $str.=$strPol[rand(0,$max)];
 }
 return $str;
}
function rand_code($size){ //随机验证码去除了比较相似的字符 比如:0,O I J L 等.
 $str = '';
 $strPol = "ABCDEFGHKMNPQRSTUVWXYZ123456789";
 $max = strlen($strPol)-1;
 for($i=0;$i<$size;$i++){
 $str.=$strPol[rand(0,$max)];
 }
 return $str;
}
function deldir($dir,$bl=false,$on_del = false ) { 
 if(!is_dir($dir)) return true;
 $dh=opendir($dir);
 while ($file=readdir($dh)) {
 if($file!="." && $file!="..") {
 $fullpath=$dir.'/'.$file;
 if(!is_dir($fullpath) && $file != 'log.php') {
 
  @unlink($fullpath);
 } else {
  if(!$bl)
  deldir($fullpath,false,true);
 }
 }
 }
 closedir($dh);
 if($on_del){
 if(is_dir($dir)){
 if(@rmdir($dir)) {
 return true;
 } else {
 return false;
 }
 }
 }
 return true;
 
}
function del_cache_file($conf,$cache = false){
 deldir(TMP_PATH,$cache ? false : true);
 if($cache) del_cache_data($conf);
}
function del_fycache_data($conf){
 if($conf['cache_type'])
 C("DATA_CACHE_TYPE",'DB');
 if($conf['cache_table'])
 C("DATA_CACHE_TABLE",'fycache');
 if($conf['cache_key'])
 C("DATA_CACHE_KEY",$conf['cache_key']);
 if($conf['cache_time'])
 C("DATA_CACHE_TIME",$conf['cache_time']);
 if($conf['cache_pr'])
 C("DATA_CACHE_PREFIX",$conf['cache_pr']);
 if($conf['cache_ys'] == 'on')
 C("DATA_CACHE_COMPRESS",true);
 if($conf['cache_outtime'])
 C("DATA_CACHE_TIMEOUT",$conf['cache_outtime']);
 if($conf['cache_redis_ip'])
 C("REDIS_HOST",$conf['cache_redis_ip']);
 if($conf['cache_redis_port'])
 C("REDIS_PORT",$conf['cache_redis_port']);
 if($conf['cache_mem_ip'])
 C("MEMCACHE_HOST",$conf['cache_mem_ip']);
 if($conf['cache_mem_port'])
 C("MEMCACHE_PORT",$conf['cache_mem_port']);
 if($conf['cache_memd_ip']){
 $arr = explode("\r\n",$conf['cache_memd_ip']);
 $options=array();
 foreach ($arr as $v) {
  array_push($options,explode(":",$v));
 }
 C("MEMCACHED_SERVER",$options);
 }
 cache(array())->clear();
}


function del_cache_data($conf){
 if($conf['cache_type'])
 C("DATA_CACHE_TYPE",$conf['cache_type']);
 if($conf['cache_table'])
 C("DATA_CACHE_TABLE",$conf['cache_table']);
 if($conf['cache_key'])
 C("DATA_CACHE_KEY",$conf['cache_key']);
 if($conf['cache_time'])
 C("DATA_CACHE_TIME",$conf['cache_time']);
 if($conf['cache_pr'])
 C("DATA_CACHE_PREFIX",$conf['cache_pr']);
 if($conf['cache_ys'] == 'on')
 C("DATA_CACHE_COMPRESS",true);
 if($conf['cache_outtime'])
 C("DATA_CACHE_TIMEOUT",$conf['cache_outtime']);
 if($conf['cache_redis_ip'])
 C("REDIS_HOST",$conf['cache_redis_ip']);
 if($conf['cache_redis_port'])
 C("REDIS_PORT",$conf['cache_redis_port']);
 if($conf['cache_mem_ip'])
 C("MEMCACHE_HOST",$conf['cache_mem_ip']);
 if($conf['cache_mem_port'])
 C("MEMCACHE_PORT",$conf['cache_mem_port']);
 if($conf['cache_memd_ip']){
 $arr = explode("\r\n",$conf['cache_memd_ip']);
 $options=array();
 foreach ($arr as $v) {
  array_push($options,explode(":",$v));
 }
 C("MEMCACHED_SERVER",$options);
 }
 cache(array())->clear();
}