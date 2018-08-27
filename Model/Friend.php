<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Friend extends Model {
public function get_state($uid1,$uid2,$mcache=false){
if($mcache!=false) if($state=$mcache->get('Friend_s'.$uid1.'_'.$uid2))  return $state=='f' ? false : $state;
if($state = $this->find('state',['AND'=>['uid1'=>$uid1,'uid2'=>$uid2]])) $mcache->set('Friend_s'.$uid1.'_'.$uid2,$state); else $mcache->set('Friend_s'.$uid1.'_'.$uid2,'f');
return $state;
}
public function set_state($uid1,$uid2,$s,$mcache=false){
if($mcache){if($s) $mcache->set('Friend_s'.$uid1.'_'.$uid2,$s);else  $mcache->set('Friend_s'.$uid1.'_'.$uid2,'f');}
return $this->update(['state'=>$s],['AND'=>['uid1'=>$uid1,'uid2'=>$uid2]]);
}
 public function add_friend($uid1,$uid2,$mcache=false){
 if(!$this->has(['AND'=>['uid1'=>$uid1,'uid2'=>$uid2]])){ if($this->has(['AND'=>['uid1'=>$uid2,'uid2'=>$uid1]])){ if($this->get_state($uid2,$uid1)!= 0){
 $this->set_state($uid2,$uid1,2,$mcache);
 return $this->insert(['uid1'=>$uid1,'uid2'=>$uid2,'state'=>2]);
 }
 return $this->insert(['uid1'=>$uid1,'uid2'=>$uid2,'state'=>1]);
 }else{
 return $this->insert(['uid1'=>$uid1,'uid2'=>$uid2,'state'=>1]);
 }
 }else{
 $this->set_state($uid1,$uid2,1,$mcache);
 }
 return false;
 }
 public function rm_friend($uid1,$uid2,$mcache=false){
 if($this->has(['AND'=>['uid1'=>$uid1,'uid2'=>$uid2]])){ if($this->has(['AND'=>['uid1'=>$uid1,'uid2'=>$uid2]])){ if($this->get_state($uid2,$uid1)!= 0)
 $this->set_state($uid2,$uid1,1,$mcache);
 }
 $mcache->rm('Friend_s'.$uid1.'_'.$uid2);
 $this->delete(['AND'=>['uid1'=>$uid1,'uid2'=>$uid2]]);
 }
 }

 public function update_int($uid1,$uid2,$type="+",$size=1){
 if($this->has(array('AND'=>array('uid1'=>$uid1,'uid2'=>$uid2)))){
 if($type==="+") return $this->update(["c[{$type}]"=>$size,'atime'=>NOW_TIME],['AND'=>['uid1'=>$uid1,'uid2'=>$uid2]]);
 return $this->update(["c[{$type}]"=>$size],['AND'=>['uid1'=>$uid1,'uid2'=>$uid2]]);
 }
 $this->insert(['uid1'=>$uid1,'uid2'=>$uid2,'c'=>1,'atime'=>NOW_TIME,'state'=>0]);
 }
 public function get_c($uid1,$uid2){
 if(!$this->has(array('AND'=>array('uid1'=>$uid1,'uid2'=>$uid2)))) return 0;
 return $this->find('c',array('AND'=>array('uid1'=>$uid1,'uid2'=>$uid2)));
 }
 }