<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Pic extends Model {
private $sqlme	= '*';
private $fsize=array('jpg'=>1,'png'=>2,'jpeg'=>1,'gif'=>3,'webp'=>4,'bmp'=>5);
public function up_int($id,$key,$mcache=false){
if($mcache!=false) $mcache->rm(__CLASS__.$id);
return $this->update($key,array('id'=>$id));
}



public function read_list($pageid , $listnum = 10,$mode=0,$fid = -1,$uid = 0,$mcache=false){
$data = array('ORDER'=>'btime DESC','LIMIT' => array(0,$listnum));
if($pageid<1) $pageid=ceil(NOW_TIME/300)*300;

if($fid != -1){/*栏目*/
  if($mode>0) $data['AND']=array('fid'=>$fid,'mode'=>$mode,'btime[<]'=>$pageid);else $data['AND']=array('fid'=>$fid,'btime[<]'=>$pageid);
}elseif($uid != 0){/*UID*/
$data['AND']=array('uid'=>$uid,'btime[<]'=>$pageid);
 
 }else{/*多语言*/
  if($mode>0)  $data['AND']=array('lang'=>NOW_LANG,'mode'=>$mode,'btime[<]'=>$pageid); else $data['AND']=array('lang'=>NOW_LANG,'btime[<]'=>$pageid);
 }

if($mcache!=false) $data2=$mcache->get('pl'.$uid.'_'.$mode.$fid.NOW_LANG.$pageid);
if(empty($data2)) $data2=$this->select($this->sqlme,$data);
$this->format($data2,$mcache);
if($mcache!=false and $data2) $mcache->set('pl'.$uid.'_'.$mode.$fid.NOW_LANG.$pageid,$data2);
return $data2;
 }
 

 

 public function search_list($pageid,$listnum,$key,$mcache=false){
if($mcache!=false) $data2=$mcache->get(md5('pls'.$pageid.$key[0]));
if(empty($data2)) $data2=$this->select($this->sqlme,array('LIMIT'=>array($listnum*$pageid,$listnum),'MATCH'=>array('columns'=>array('so'),'keyword'=>$key[0].' IN NATURAL LANGUAGE MODE')));
$this->format($data2,$mcache,$key[1]);
if($mcache!=false and $data2) $mcache->set(md5('pls'.$pageid.$key[0]),$data2);
return $data2;
}

public function read($id,$mcache=false){
if($mcache==false){
return $this->find($this->sqlme,array('id'=>$id));
}else{
$data=$mcache->get(__CLASS__.$id);
if(empty($data)){
$data=$this->find($this->sqlme,array('id'=>$id));
$mcache->set(__CLASS__.$id,$data);
}
return $data;
}
}


public function in($info,$w,$h,$user=279,$url=''){
if($url){if(!$num=stripos($url,'.ysv8.com/')) $url='';else $url='{u}'.substr($url,$num+9);}
$a=explode('.',strtolower($info));
if(count($a)!=2) return false;
$hash=$a[0];
$ext=$a[1];
if($id=$this->find('id',array('hash'=>$info))){
if($url) $this->update(array('btime'=>NOW_TIME,'url'=>$url),array('id'=>$id));else $this->update(array('btime'=>NOW_TIME),array('id'=>$id));

}else{
S('pic')->insert(array('hash'=>$info,'mode'=>$this->fsize[$ext],'w'=>$w,'h'=>$h,'atime'=>NOW_TIME,'btime'=>NOW_TIME,'uid'=>$user,'url'=>$url));
}

}



public function format(&$thread_list,$mcache=false){
 if(empty($thread_list)) return;
 static $user_tmp = array();
 $User = M("User");
 foreach ($thread_list as &$v){
 if(empty($user_tmp[$v['uid']])) $user_tmp[$v['uid']] = $User->read($v['uid'],$mcache);
 $v['user'] = $user_tmp[$v['uid']]['user'];
 $v['avatar']=$user_tmp[$v['uid']]['avatar'];
 }

 }


}