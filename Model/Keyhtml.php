<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Keyhtml extends Model {
private $html='';
private $tx=array();/*特性*/
private $img=array();/*照片*/
private $jj='';/*简介*/
private $mykey='';/*简介*/
private $ida=array();/*防止重复数组*/
private $vod=array();/*防止重复数组*/
private $files=array();/*防止重复数组*/
private $da=array();/*短属性*/
private $gx=false;/*是否更新*/
private $listhtml=array();
private $mhtmlall='<div class="keydiv">{img}<div class="keybody"><a href="/kid/{kid}/{xid}.html">{tx}</a>{vod}{files}</div></div>';
function __construct($id='',$set=''){
if(is_array($set)) $this->con($set[0],$set[1],false);
}

public function con($id,$xid,$set=true){/*加载缓存*/
static $cache='';
if(empty($cache)) $cache=dbcache(array());
if($set){
if($this->gx) $cache->set($id.'_'.$xid,array($this->ida,$this->da,$this->tx,$this->img,$this->vod,$this->files));
}else{
if($ar=$cache->get($id.'_'.$xid)){
if(!empty($ar[0])) $this->ida=$ar[0];
if(!empty($ar[1])) $this->da=$ar[1];
if(!empty($ar[2])) $this->tx=$ar[2];
if(!empty($ar[3])) $this->img=$ar[3];
if(!empty($ar[4])) $this->vod=$ar[4];
if(!empty($ar[5])) $this->files=$ar[5];}

}


}


public function set($id,$keys,$mcache){

if(in_array($id,$this->ida)){return true;}
/*特性处理*/ 
$this->gx=true;
if($keys['aid']==0){if(mb_strlen($keys['con'],'utf8')>25){S('keyattr')->update(array('aid'=>'231428'),array('id'=>$id));
 return true;}$this->tx[]=$keys['con'];$this->ida[]=$id;return true;}
/*size:9(图片)，10（短属性）处理*/
$size=M('Mykey')->read($keys['aid'],$mcache,'size');

switch($size){  
case '12': 
$this->vod[]=$id;
$this->ida[]=$id;
 break;
case '13': 
$this->files[]=$id;
$this->ida[]=$id;
 break;
case '9': 
$this->img[]=$keys['img'];
$this->ida[]=$id;
 break;
case '11': 
$this->jj=$keys['con'];
$this->ida[]=$id;
 break; 
case '10':  
$this->da[$keys['aid']]=array($keys['con'],M('Mykey')->read($keys['aid'],$mcache),$id);
$this->ida[]=$id;
 break; 
default: 
if(mb_strlen($keys['con'],'utf8')<10){
$this->da[$keys['aid']]=array($keys['con'],M('Mykey')->read($keys['aid'],$mcache),$id);
$this->ida[]=$id;
}else{
$this->listhtml[]=array($keys['con'],M('Mykey')->read($keys['aid'],$mcache),$id);
}
break;  
  }  


}
public function gettx($id,$xid,$mcache=false){
if($a=M('Keyattr')->gettx($id,$xid,$mcache)) foreach ($a as $key => $value) $this->set($key,$value,$mcache);
}

public function getsize($id,$xid,$size,$mcache=false){
if($a=M('Keyattr')->getsize($id,$xid,$size,$mcache)) foreach ($a as $key => $value) $this->set($key,$value,$mcache);
}

public function keyhtmlget($id,$xid,$size='all',$mcache=false){
if($this->mykey=='') $this->mykey=M('Mykey')->read($id,$mcache,$mykey='mykey');
if(empty($this->tx)) $this->gettx($id,$xid,$mcache);
switch($size){  
case 'd':  /*一行纯文字*/
$this->html=$this->mykey.':';
foreach($this->tx as $value) $this->html.=' '.$value;
$this->con($id,$xid);
return trim($this->html);
 break; 
case 'pic':  /*四格*/
if(empty($this->img)) $this->getsize($id,$xid,9,$mcache);
if(count($this->img)>0){return $this->img[0];}else{return icdn.'public/upimg.jpg';}
 break; 
 
case 'k':  /*四格*/
if(empty($this->img)) $this->getsize($id,$xid,9,$mcache);
if(count($this->img)>0){$img='<a href="/kpic/'.$id.'/'.$xid.'.html" class="img"><img  src="'.$this->img[0].'_150"></a>';}else{$img='<a href="/myweb/x?size=3&id='.$id.'&idx='.$xid.'" class="mui-media-object mui-pull-left"><img src="'.icdn.'public/upimg.jpg"></a>';}
if(empty($this->vod)){$vod='';}else{$vod='<p><a href="/x/'.$this->vod[0].'.html">'.fy('观看').'</a></p>';}
if(empty($this->files)){$files='';}else{$files='<p><a href="/x/'.$this->files[0].'.html">'.fy('下载').'</a></p>';}

$this->con($id,$xid);
return str_replace(array('{img}','{mykey}','{tx}','{kid}','{xid}','{vod}','{files}'),array($img,$this->mykey,$this->mykey,$id,$xid,$vod,$files),$this->mhtmlall);
 break; 
 
 
case 'm':  /*四格*/
if(empty($this->img)) $this->getsize($id,$xid,9,$mcache);
if(count($this->img)>0){$img='<a href="/kpic/'.$id.'/'.$xid.'.html" class="img"><img  src="'.$this->img[0].'_150"></a>';}else{$img='<a href="/myweb/x?size=3&id='.$id.'&idx='.$xid.'" class="mui-media-object mui-pull-left"><img src="'.icdn.'public/upimg.jpg"></a>';}
$tx='';
if($this->tx) foreach($this->tx as $value)  $tx.=$value.' '; else $tx=fy('默认');
if(empty($this->vod)){$vod='';}else{$vod='<p><a href="/x/'.$this->vod[0].'.html">'.fy('观看').'</a></p>';}
if(empty($this->files)){$files='';}else{$files='<p><a href="/x/'.$this->files[0].'.html">'.fy('下载').'</a></p>';}

$this->con($id,$xid);
return str_replace(array('{img}','{mykey}','{tx}','{kid}','{xid}','{vod}','{files}'),array($img,$this->mykey,$tx,$id,$xid,$vod,$files),$this->mhtmlall);
 break;

 
default: /*all*/
if(empty($this->img)) $this->getsize($id,$xid,9,$mcache);
if(empty($this->da)) $this->getsize($id,$xid,10,$mcache);
if(count($this->img)>0){$img='<a href="/kpic/'.$id.'/'.$xid.'.html"><img  src="'.$this->img[0].'_150"></a>';}else{$img='<a href="/myweb/x?size=3&id='.$id.'&idx='.$xid.'"><img src="'.icdn.'public/upimg.jpg"></a>';}
$tx='';
$listhtml='';
$dah='';
if($this->tx) foreach($this->tx as $value) $tx.=' <a href="/tx/'.urlencode($value).'.html">'.$value.'</a>';else $tx=fy('无');
if($this->da) foreach($this->da as $v) $dah.='<div class="da col-xs-12 col-sm-6"><a href="/x/'.$v[2].'.html">'.$v[1].'</a>:'.$v[0].'</div>';
if($this->listhtml) foreach($this->listhtml as $v) $listhtml.='<h4><a href="/x/'.$v[2].'.html">'.$v[1].'</a></h4><p class="p10">'.$v[0].'</p>';
if(empty($this->vod)){$vod='';}else{$vod='<p><a href="/x/'.$this->vod[0].'.html">'.fy('观看').'</a></p>';}
if(empty($this->files)){$files='';}else{$files='<p><a href="/x/'.$this->files[0].'.html">'.fy('下载').'</a></p>';}
$this->con($id,$xid);
return str_replace(array('{img}','{mykey}','{tx}','{kid}','{xid}','{vod}','{files}'),array($img,$this->mykey,$tx,$id,$xid,$vod,$files),'<div class="keydiv">{img}<div class="keybody">{tx}{vod}{files}</div></div>').'<div class="row">'.$dah.'</div>'.$listhtml;
break; 
}

}


}

