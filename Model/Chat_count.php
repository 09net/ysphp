<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Chat_count extends Model{
public function update_int($uid,$type="+",$size=1){
if($this->has(array('uid'=>$uid))){
if($type==="+")return $this->update(array("c[{$type}]"=>$size,'atime'=>NOW_TIME),array('uid'=>$uid));
return $this->update(array("c[{$type}]"=>$size),array('uid'=>$uid));
}
$this->insert(array('uid'=>$uid,'c'=>1,'atime'=>NOW_TIME));
}
public function get_c($uid){
$c = $this->find('c',array('uid'=>$uid));
return (!$c)?0:$c;
}
public function get_time($uid){
$atime = $this->find('atime',array('uid'=>$uid));
return (!$atime)?0:$atime;
}
}