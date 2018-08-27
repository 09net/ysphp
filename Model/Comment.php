<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Comment extends Model {
private $sqlme	= '*';
public function in($arr,$mcache=false){
$arr['atime']=NOW_TIME;
$arr['btime']=NOW_TIME;
$arr['lang']=NOW_LANG;
$arr['uid']=NOW_UID;
return $this->insert($arr);
}
public function read($id,$mcache=false){
 if($mcache!=false){if($data=$mcache->get(__CLASS__.$id)) return $data;}
if($mcache!=false and $data=$this->format_one($this->find($this->sqlme,array('id'=>$id)))) $mcache->set(__CLASS__.$id,$data);
return $data;
} 
public function del($id,$mcache=false){
if($mcache) $mcache->rm(__CLASS__.$id);
return  $this->delete(array('id'=>$id));
}
public function up_int($id,$key,$mcache=false){
if($mcache) $mcache->rm(__CLASS__.$id);
return $this->update($key,array('id'=>$id));
} 

public function read_list($pageid ,$id,$listnum = 10,$uid='',$mcache=false){
$data = array('ORDER'=>'btime DESC','LIMIT' => array(0,$listnum));
if($pageid<1) $pageid=ceil(NOW_TIME/300)*300;
if($uid) $data['AND']=array($uid=>$id,'btime[<]'=>$pageid);else $data['AND']=array('btime[<]'=>$pageid,'lang'=>NOW_LANG);
if($mcache!=false){if($data2=$mcache->get('cmt'.$uid.'l'.$id.'_'.$pageid.NOW_LANG)) return $data2;}
if($data2=$this->select($this->sqlme,$data)){$this->format($data2); if($mcache!=false) $mcache->set('cmt'.$uid.'l'.$id.'_'.$pageid.NOW_LANG,$data2);}
return $data2;

 }
 

 


public function format_one($v,$mcache=false){
 if(!is_array($v)) return $v;
 $User = M("User"); 
$tem=$User->read($v['uid'],$mcache);
$v['user'] = $tem['user'];
$v['avatar']=$tem['avatar'];
$v['content'] =M("Post")->read_hash($v['hashid'],$mcache);
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
  static $post_tmp = array();
 $User = M("User");
  $Post = M("Post");
 foreach ($thread_list as &$v){
 if(empty($user_tmp[$v['uid']])) $user_tmp[$v['uid']] = $User->read($v['uid'],$mcache);
  if(empty($post_tmp[$v['hashid']])) $post_tmp[$v['hashid']] = $Post->read_hash($v['hashid'],$mcache);
   $v['content'] =$post_tmp[$v['hashid']];
 $v['user'] = $user_tmp[$v['uid']]['user'];
 $v['avatar']=$user_tmp[$v['uid']]['avatar'];
 if($key) $v['title']= str_ireplace($k1,$k2,$v['title']);
 }

 }




}
