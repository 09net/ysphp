<?php
// +------------------------------------------+
// | YSPHP 44api.com                          |
// +------------------------------------------+
// | Copyright (c) 1997-2004 The 09hnnet      |
// +------------------------------------------+
// | 最大匹配分词法，版权所有，不允许用于商业目的   |
// +------------------------------------------+
// | 购买授权  09hnnet <719048503@qq.com>      |
// +------------------------------------------+
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Mykey extends Model {
private $ai	=array();
private $aid=0;
private $Keyattr=false;
/*组合数据*/
public function getsize($size,$mcache){

if($mcache==false){
return $this->select('id',array('size'=>$size,"ORDER"=>'sid DESC',"LIMIT" => array(0,10)));
}else{
$data2=$mcache->get('mk_s_l'.$size);
if(empty($data2)){$data2=$this->select('id',array('size'=>$size,"ORDER"=>'sid DESC',"LIMIT" => array(0,10)));if($data2)$mcache->set('mk_s_l'.$size,$data2);}
}
return $data2;
} 
public function get_implode($ch,$mcache=false,$mykey=''){
if($mykey=='') return false;
if($ch=='') return false;
if(!$data=$this->like($mykey,$mcache)) return false;
$this->aid=$data['id'];
if($this->Keyattr===false) $this->Keyattr=M('Keyattr');

$ch.=' ';
$allarr=array();
$allarr[0] = ch2arr($ch);
$len=count($allarr[0]);
if($len>1) return $this->implode_key($allarr,$len,'',$mcache);

return false;

}

public function bool_str($str,$id,$mcache){

if($this->aid==0) return true;
if(empty($str))  return false;
switch ($this->aid){
case 14992:
$str=trim(str_replace(array('[',']'),'',$str));
if(in_array(strtolower(mb_substr($str,0,1,'utf-8')),array('a','b','c','d','e','f','g','h','j','k','l','m','n','o','p','q','r','s','t','w','x','y','z','ā','ǎ','á','à','è','é','ò','ó','ē','ě','ō','ǒ'))){return true;}else{
$this->Keyattr->delete(array('AND'=>array('kid'=>$id,'aid'=>$this->aid),'limit'=>array(0,1)));
$mcache->rm('r2_h_'.$id.'_'.$this->aid);

return false;}
  break;
default:
}
return true;

}

public function implode_key($allarr,$len,$file,$mcache){
$i=0;
for ($x=0; $x<$len; $x++) {
if($x<($len-1) and  (preg_match("/^[A-Za-z0-9]*$/", $file.$allarr[0][$x]) or $size=$this->liker($file.$allarr[0][$x].'%',$mcache))){/*继续搜索*/
$file=$file.$allarr[0][$x];
$allarr[1][$i]=array(trim($allarr[0][$x]),'');
$i++;
}else{/*继续搜索*/

if($file ==''){ /*一个字还能liker肯定是不能like*/

$allarr[1][$i]=array(trim($allarr[0][$x]),'');
$i++;

}else{/*退回搜索*/
$bool=true;

$ji=mb_strlen($file,'UTF8');
/*关键字提取成功*/
for ($z=0; $z<$ji; $z++) {
if(($size=$this->like(mb_substr($file,0,$ji-$z,'UTF8'),$mcache)) and ($hash=$this->Keyattr->read_hash($size['id'],$this->aid,$mcache)) and $this->bool_str($hash,$size['id'],$mcache)){
$i=$i-$ji;
$bool=false;
$x=$x-$z-1;
$allarr[1][$i]=array(trim(mb_substr($file,0,$ji-$z,'UTF8')),$hash);
for ($k=$i+1; $k<$i+$ji; $k++) unset($allarr[1][$k]);
$file='';
$i++;
break;
}

}

if($bool){
$x=$x-$ji;
$i=$i-$ji;
$allarr[1][$i]=array(trim($allarr[0][$x]),'',);
for ($k=$i+1; $k<$i+$ji; $k++) unset($allarr[1][$k]);
$file ='';
$i++;

}/*基本上不会出现的情况*/
/*关键字提取成功*/
}
}
}
ksort($allarr);
return $allarr;
}





public function jyc($from,$to,$mcache=false){
$fid=0;$tid=0;
if($size=$this->like($to,$mcache)){$tid=$size['pid']?$size['pid']:$size['id'];}else{$tid=$this->insert(array('mykey'=>$from,'size'=>3));}
if($tid>0){
if($size=$this->like($from,$mcache)){$fid=$size['id'];if($fid!=$tid) $this->up_int($fid,array('pid'=>$tid),$mcache);}else{$fid=$this->insert(array('mykey'=>$from,'size'=>3,'pid'=>$tid));}
}
return array($fid,$tid);
}
public function liker($str,$mcache){
$str=mb_ereg_replace('_','\_',$str);
if($mcache!=false) $data=$mcache->get(md5(__CLASS__.'l_'.$str));
if(empty($data)) $data=$this->find('id',array('mykey[~]'=>$str));
if($mcache!=false) if($data) $mcache->set(md5(__CLASS__.'l_'.$str),$data); else $mcache->set(md5(__CLASS__.'l_'.$str),'f');
return $data=='f'?false:$data;
}
public function encode($name){/*汉子正则表达式处理,生成正则表达式*/
$name = iconv('UTF-8', 'UCS-2', $name);
    $len = strlen($name);
    $str = '';
    for ($i = 0; $i < $len - 1; $i = $i + 2)
    {
        $c = $name[$i];
        $c2 = $name[$i + 1];
        if (ord($c) > 0)
        {    // 两个字节的文字
            $str .= '\x{'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16).'}';
        }
        else
        {
            $str .= $c2;
        }
    }
    return $str;
}
public function geshihua($str){
return trim(preg_replace('/[\x{ff01}\x{ff08}\x{ff09}\x{2026}\x{ff1f}\x{ff1}\x{ffc}\x{302}\x{3010}\x{3001}\x{300a}\x{300b}\x{3011}\x{ff1a}\x{2018}\x{301}\x{30a}\x{30b}]+/u',' ',preg_replace("/[[:punct:]]+|[[:space:]]+/",' ',strip_tags($str))));
}
public function degeshihua($str){
return str_replace(' ','_',trim($str));
}


/*根据mykey获取*/
public function like($str,$mcache,$size=''){
if(!$str=$this->geshihua($str)) return false;
if($mcache!=false) $data=$mcache->get(md5(__CLASS__.$str));
if(empty($data)){if(!$data=$this->find('*',array('mykey'=>$str)) and $size=='add'){
$str=fy($str,'cht','zh');
if($id=$this->insert(array('mykey'=>$str,'size'=>9,'sid'=>NOW_TIME))) $data=array('id'=>$id,'name'=>$str,'size'=>9,'sid'=>NOW_TIME); else $id=0;
$str=fy($str,'zh','cht');
$this->insert(array('mykey'=>$str,'size'=>9,'pid'=>$id,'sid'=>NOW_TIME));
return $id;
}
}
if($mcache!=false) if($data) $mcache->set(md5(__CLASS__.$str),$data); else $mcache->set(md5(__CLASS__.$str),'f');


return $data=='f'?false:$data;
}




public function read($id,$mcache=false,$size='mykey'){
if($mcache!=false) $data=$mcache->get(__CLASS__.$id);
if(empty($data)) $data=$this->find('*',array('id'=>$id));
if($mcache!=false) if($data) $mcache->set(__CLASS__.$id,$data); else $mcache->set(__CLASS__.$id,'f');
if($size and $data and isset($data[$size])) return  $data[$size];
return $data=='f'?false:$data;
 }
 







public function ciyi_key($ch,$mcache){
if(!$ch) return false;
$ch.=' ';
$allarr=array();
$allarr[0] = ch2arr($ch);
$len=count($allarr[0]);
if($len>1) return $this->ciyiget_key($allarr,$len,'',$mcache);
/*长度大于1分词才有意义*/
return false;

}



public function ciyiget_key($allarr,$len,$file,$mcache){
$i=0;
for ($x=0; $x<$len; $x++) {
if($x<($len-1) and  (preg_match("/^[A-Za-z0-9]*$/", $file.$allarr[0][$x]) or $size=$this->liker($file.$allarr[0][$x].'%',$mcache))){/*继续搜索*/
$file=$file.$allarr[0][$x];
$allarr[1][$i]=array(trim($allarr[0][$x]),'0|',0,0);
$i++;
}else{/*继续搜索*/

if($file ==''){ /*一个字还能liker肯定是不能like*/

$allarr[1][$i]=array(trim($allarr[0][$x]),'0|',0,0);
$i++;

}else{/*退回搜索*/
$bool=true;

$ji=mb_strlen($file,'UTF8');
/*关键字提取成功*/
for ($z=0; $z<$ji; $z++) {
if($size=$this->like(mb_substr($file,0,$ji-$z,'UTF8'),$mcache) or preg_match("/^[A-Za-z0-9]*$/", mb_substr($file,0,$ji-$z,'UTF8'))){
if(!$size)  $size=array('size'=>0,'id'=>0,'ai'=>0,'pid'=>0);


$i=$i-$ji;
$bool=false;
$x=$x-$z-1;
$allarr[1][$i]=array($this->degeshihua(mb_substr($file,0,$ji-$z,'UTF8')),$size['size'].'|',$size['id'],$size['pid']);
if(!$size['ai'] and $size['pid']>0) $size['ai']=$this->read($size['pid'],$mcache,'ai');
if($size['ai']) $this->ai[$size['ai']]=$size['id'];
for ($k=$i+1; $k<$i+$ji; $k++) unset($allarr[1][$k]);
$file='';
$i++;
break;
}

}

if($bool){
$i=$i-$ji;
$x=$x-$ji;
$allarr[1][$i]=array(trim($allarr[0][$x]),'0|',0,0);
$file='';
$i++;

}/*基本上不会出现的情况*/
/*关键字提取成功*/
}
}
}
return $this->loop_ciyi_replace($allarr);
}
function loop_ciyi_replace($allarr){/*智能替换*/
$len2=count($allarr[1]);
if($len2<1){return $allarr;}
$i=0;
for ($len=1; $len<$len2-$i; $len++) {
switch ($allarr[1][$len-1][1].$allarr[1][$len][1]){
case '1|1|':
$allarr[1][$len-1]=array($allarr[1][$len-1][0].$allarr[1][$len][0],'1|');
array_splice($allarr[1], $len, 1); 
$len--;
$i++;
 break ;
 case '1|2|':
$allarr[1][$len-1]=array($allarr[1][$len-1][0].$allarr[1][$len][0],'2|');
array_splice($allarr[1], $len, 1); 
$len--;
$i++;
 break ;
 case '2|2|':
$allarr[1][$len-1]=array($allarr[1][$len-1][0].$allarr[1][$len][0],'2|');
array_splice($allarr[1], $len, 1); 
$len--;
$i++;
 break ;
  case '2|1|':
$allarr[1][$len-1]=array($allarr[1][$len-1][0].$allarr[1][$len][0],'2|');
array_splice($allarr[1], $len, 1); 
$len--;
$i++;
 break ;
default:

}
}

return $allarr;
}

public function up_int_name($mykey,$key,$mcache=false){
if(!$mykey=$this->geshihua($mykey)) return false;
if($mcache!=false) $mcache->rm(md5(__CLASS__.$mykey));
return $this->update($key,array('mykey'=>$mykey));
}
 public function del($id,$mcache=false){
if($mcache!=false) $mcache->rm(__CLASS__.$id);
$this->delete(array('id'=>$id));

 }

 public function up_int($id,$key,$mcache=false){
  if($mcache!=false) $mcache->rm(__CLASS__.$id);
return $this->update($key,array(
   'id'=>$id
  ));
 
 }


public function setkey($str,$mcache){
$days_array=explode(',',$str);
$arr=array();
foreach ($days_array as $value) {
if($size=$this->like($value,$mcache)){$arr[]=$size['id'];}else{$arr[]=$this->insert(array('mykey'=>$value,'size'=>3));}
$value=$GLOBALS['mk']->convert($value, 'cht');
if($size=$this->like($value,$mcache)){$arr[]=$size['id'];}else{$arr[]=$this->insert(array('mykey'=>$value,'size'=>3));}
}
return implode(',',$arr);
}


public function get_key($str,$mcache,$f=0){/*普通，返回存储与key*,1,搜索模式，2精英模式，只返回U,与key,2*/
$this->ai=array();
if(!$str=$this->geshihua($str)) return false;
if(!$key=$this->ciyi_key(strtolower($str),$mcache)) return false;
$len=count($key[1]);
$str='';
$strt2=array();
$a=array();
/*1\数字2\字母4、符号0、不存在*/
for ($x=0; $x<$len-1; $x++) {
if(!in_array($key[1][$x][0],$a) and trim($key[1][$x][0])!=''){/*防止重复*/
$a[]=$key[1][$x][0];
if($key[1][$x][1]=='1|' or $key[1][$x][1]=='2|'){/*数字，字母*/
if(strlen($key[1][$x][0])>1){
if($f==0) $str.=$key[1][$x][0].' ';
if($f==1) $str.=' >'.$key[1][$x][0].' ';


}
}elseif($key[1][$x][1]=='4|'){/*不存在*/
}elseif($key[1][$x][1]=='0|'){/*不存在*/

if(strlen($key[1][$x][0])<20){/*长度优化*/
if($f==0) $str.=str_replace('%','',urlencode($key[1][$x][0])).' ';
if($f==1) $str.='>'.str_replace('%','',urlencode($key[1][$x][0])).' ';
}

}else{
if($f==0)  $str.='U'.$key[1][$x][2].' ';
if($f==1)  $str.='+U'.$key[1][$x][2].' ';
if($key[1][$x][3]>0){if($f==1)  $str.='>U'.$key[1][$x][3].' '; else $str.='U'.$key[1][$x][3].' ';}/*同义词*/
$strt2[$key[1][$x][2]]=$key[1][$x][0];
}
}
}
/*0:搜索或存储字符串,1:匹配到的数组，3：提取的关键字*/
return array(preg_replace ( "/\s(?=\s)/","\\1",trim($str)),$strt2,$this->ai,$this->tags($strt2));
}
/*获取关键字*/
public function tags($arr,$size=''){
if(empty($arr))return '';
$str='';
switch ($size){
case 'key':/*搜索存储优化*/
foreach ($arr as $key => $value)  $str.=$key.' ';
break;  
default:/*关键字*/
foreach ($arr as $value)  $str.=$value.' ';
}
return trim($str);
}

/*数据缓存就绪*/
}
