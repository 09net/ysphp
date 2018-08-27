<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Tcpost extends Model {
public function read($id,$mcache=false){
 if($mcache!=false){if($data=$mcache->get(__CLASS__.$id)) return $data;}
if($mcache!=false and $data=$this->format_one($this->find('*',array('id'=>$id)))) $mcache->set(__CLASS__.$id,$data);
return $data;
}

public function format_one($v,$mcache=false){
 if(!is_array($v)) return $v;
 $User = M("User"); 
$tem=$User->read($v['uid'],$mcache);
$v['user'] = $tem['user'];
$v['avatar']=$tem['avatar'];
$v['content'] =M('Hash')->read($v['content'],$mcache);
 return $v;
}


public function del($id,$mcache=false){
if($mcache!=false) $mcache->rm('tcpost_'.$id);
return $this->delete(array('id'=>$id));
}
public function up_int($id,$key,$mcache=false){
if($mcache!=false) $mcache->rm('tcpost_'.$id);
return $this->update($key,array( 'id'=>$id));
 }
public function read_list($pageid ,$tid,$mcache=false,$type=0){
$data = array("ORDER"=>'btime DESC',"LIMIT" => array(0,10));
if($pageid>1){
$data['AND']=array('tid'=>$tid,'type'=>$type,'btime[<]'=>$pageid);
}else{
$data['AND']=array('tid'=>$tid,'type'=>$type);
}
if($mcache==false){
$data=$this->select('*',$data);$this->format($data,$mcache);return $data;
}else{
$data2=$mcache->get('tp_l_'.$pageid.'_'.$tid.'_'.$type);
if(empty($data2)){
$data2=$this->select('*',$data);$this->format($data2,$mcache);
$mcache->set('tp_l_'.$pageid.'_'.$tid.'_'.$type,$data2);
}
return $data2;
}
}
public function format(&$thread_list,$mcache){
if(empty($thread_list)) return;
static $user_tmp = array();
$User = M("User");
$hash=M('Hash');
foreach ($thread_list as &$v){
if(empty($user_tmp[$v['uid']])) $user_tmp[$v['uid']] = $User->read($v['uid'],$mcache);
if(empty($user_tmp[$v['content']])) $user_tmp[$v['content']] = $hash->read($v['content'],$mcache); 
$v['user'] = $user_tmp[$v['uid']]['user'];
$v['atime_str']=humandate($v['atime']);
 $v['avatar']= $user_tmp[$v['uid']]['avatar'];
$v['content'] = conkeys($user_tmp[$v['content']]);
}
}
}
