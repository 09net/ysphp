<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Thread extends Model {
private $sqlme	= '*';
public function in($arr,$mcache=false){
return $this->insert($arr);
}
 
public function read($id,$mcache=false){
 if($mcache!=false) if($data=$mcache->get(__CLASS__.$id)) return $data;
if($data=$this->format_one($this->find($this->sqlme,array('id'=>$id)),$mcache) and $mcache!=false) $mcache->set(__CLASS__.$id,$data);
return $data;
 } 

public function up_so($thread_data,$mcache=false){
$getkey=M('Mykey')->get_key($thread_data['title'],$mcache);
if($thread_data['mode']>0)  $getkey[0]='mode'.$thread_data['mode'].' '.$getkey[0];
return $this->update(array('so' =>'fid'.$thread_data['fid'].' '.$getkey[0]),array('id'=>$thread_data['id']));  
 } 
 
 
 
public function del($id,$mcache=false){
if($mcache) $mcache->rm(__CLASS__.$id);
return  $this->delete(array('id'=>$id));
}
public function up_int($id,$key,$mcache=false){
if($mcache) $mcache->rm(__CLASS__.$id);
return $this->update($key,array('id'=>$id));
} 

public function top_list($top,$mcache=false){
if($top>6) $data=array('LIMIT' => array(0,10),'AND'=>array('lang'=>NOW_LANG,'top'=>$top));
else  $data=array('LIMIT' => array(0,10),'AND'=>array('lang'=>NOW_LANG,'top[<]'=>$top));
if($mcache!=false) if($data2=$mcache->get('tpl'.$top.NOW_LANG)) return $data2;
$data2=$this->select($this->sqlme,$data);
$this->format($data2,$mcache);
if($mcache!=false and $data2) $mcache->set('tpl'.$top.NOW_LANG,$data2);
return $data2;
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

if($mcache!=false) if($data2=$mcache->get('tl'.$uid.'_'.$mode.$fid.NOW_LANG.$pageid)) return $data2;
$data2=$this->select($this->sqlme,$data);
$this->format($data2,$mcache);
if($mcache!=false and $data2) $mcache->set('tl'.$uid.'_'.$mode.$fid.NOW_LANG.$pageid,$data2);
return $data2;
 }
 

 

 public function search_list($pageid,$listnum,$key,$mcache=false){
if($mcache!=false) if($data2=$mcache->get(md5('ts'.$pageid.$key[0])))  return $data2;
$data2=$this->select($this->sqlme,array('LIMIT'=>array($listnum*$pageid,$listnum),'MATCH'=>array('columns'=>array('pinyin'),'keyword'=>$key[0])));
$this->format($data2,$mcache,$key[1]);
if($mcache!=false and $data2) $mcache->set(md5('ts'.$pageid.$key[0]),$data2);

return $data2;
}

 public function search_list_44api($pageid,$listnum,$key,$mcache=false){
if($mcache!=false) if($data2=$mcache->get(md5('ts4'.$pageid.$key[0])))  return $data2;
$data2=$this->select($this->sqlme,array('LIMIT'=>array($listnum*$pageid,$listnum),'MATCH'=>array('columns'=>array('so'),'keyword'=>$key[0])));
$this->format($data2,$mcache,$key[1]);
if($mcache!=false and $data2) $mcache->set(md5('ts4'.$pageid.$key[0]),$data2);
return $data2;
}


public function format_one($v,$mcache=false){
 if(!is_array($v)) return $v;
 $User = M("User"); 
$tem=$User->read($v['uid'],$mcache);
$v['user'] = $tem['user'];
$v['avatar']=$tem['avatar'];
 return $v;
}

 public function format(&$thread_list,$mcache=false,$key=false){
 if(empty($thread_list)) return false;
  if($key) 
  {$k1=array();
  $k2=array();
 foreach ($key as  $value){
 $k1[]=$value;
  $k2[]='<b>'.$value.'</b>';
 }
 }
 
 static $user_tmp = array();
 $User = M("User");
 foreach ($thread_list as &$v){
 if(empty($user_tmp[$v['uid']])) $user_tmp[$v['uid']] = $User->read($v['uid'],$mcache);
 $v['user'] = $user_tmp[$v['uid']]['user'];
 $v['avatar']=$user_tmp[$v['uid']]['avatar'];
 if($key) $v['title']= str_ireplace($k1,$k2,$v['title']);
 }

 }




}
