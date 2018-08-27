<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Friend extends Ysv8 {
 	public function friend_state(){
$this->check();
 $uid = intval(X("post.uid"));
 if(NOW_UID == $uid){
 return $this->json(array('code'=>501,'info'=>fy('自己')));
 }
 $User = M("User");
 if(!$User->is_id($uid,$this->CacheObj))
 return $this->json(array('code'=>400,'info'=>fy('用户不存在')));
 $Friend = M("Friend");
 $state = $Friend->get_state(NOW_UID,$uid,$this->CacheObj);

  if($state == 0){  $Friend->add_friend(NOW_UID,$uid,$this->CacheObj);
 
 
  
 $count1 = $Friend->count(['AND'=>['uid1'=>NOW_UID,'OR'=>['state'=>[1,2]]]]);
 $count2 = $Friend->count(['AND'=>['uid2'=>$uid, 'OR'=>['state'=>[1,2]]]]);
 
  $User->update(['follow'=>$count1],['uid'=>NOW_UID]);
 $User->update(['fans' =>$count2],['uid'=>$uid]);

 return $this->json(['code'=>200,'info'=>fy('成功'),'id'=>1]);
 }
 elseif($state == 1 || $state == 2){  $Friend->rm_friend(NOW_UID,$uid,$this->CacheObj);
 
 $count1 = $Friend->count(['AND'=>['uid1'=>NOW_UID,'OR'=>['state'=>[1,2]]]]);
 $count2 = $Friend->count(['AND'=>['uid2'=>$uid, 'OR'=>['state'=>[1,2]]]]);
 
 $User->update(['follow'=>$count1],['uid'=>NOW_UID]);
 $User->update(['fans' =>$count2],['uid'=>$uid]);
 
 return $this->json(['code'=>200,'info'=>fy('成功'),'id'=>0]);
 }
 return $this->json(['code'=>501,'info'=>NULL]);
 
 }
 public function send_chat(){
$this->check();
 if(IS_POST){
 
   $uid = intval(X("post.uid"));
 $content = htmlspecialchars(X("post.content"));
 $content = str_replace('&nbsp;','',$content);
 $content = trim($content);
 if(empty($content))
 return $this->json(['code'=>501,'info'=>fy('内容为空')]);

   if($uid == NOW_UID)
 return $this->json(['code'=>501,'info'=>fy('自己')]);
 $User = M("User");
  if(!$User->is_id($uid,$this->CacheObj))
 return $this->json(['code'=>400,'info'=>fy('用户不存在')]);
  M("Chat")->send($uid,NOW_UID,$content);

 return $this->json(['code'=>200,'info'=>'!']);
 }
 }
 public function friend_list(){
$this->check();
 if(IS_POST){
  $Friend = S("Friend");
  $list = $Friend->select('*',['uid1'=>NOW_UID]);
  $list1 = $Friend->select("*",['AND'=>['uid2'=>NOW_UID,'state'=>1]]);

  foreach ($list as $k=> &$v) {
  foreach ($list1 as &$vv) {
   if($v['state']== 0 && $v['uid1'] == $vv['uid2'] && $v['uid2'] == $vv['uid1']){
  $vv['c'] = $v['c'];
  unset($list[$k]);

  }
 }
 
  }
  foreach ($list1 as &$v) {
  $v['state'] = 3;
 $v['uid2'] = $v['uid1'];
 
 }
  
 $list = array_merge($list,$list1);
 $User= M("User");
 
 $user_tmp = array();
  foreach ($list as $key => &$v) {
 if(!isset($user_tmp[$v['uid2']]))
  $user_tmp[$v['uid2']] = $User->read($v['uid2'],$this->CacheObj);
  $v['uid'] = $v['uid2'];
 $v['user'] = $user_tmp[$v['uid2']]['user'];
 $v['ps'] = $user_tmp[$v['uid2']]['ps'];
 $v['avatar'] = bucketcdn.$user_tmp[$v['uid2']]['avatar'];
 unset($v['uid2']);
 unset($v['uid1']);
 if($v['uid'] <= 0)
  unset($list[$key]);
 }
  $this->json($list);
 }
 }
 
  
 
 public function get_old_chat(){
$this->check();
 if(IS_POST){
  $uid1 = intval(X("post.uid"));
 $uid2 = NOW_UID;
 $Chat = S("Chat");
 $Friend = M("Friend");
  $size = $size1 = $Friend->get_c($uid2,$uid1);
 $history = false;
  if(!$size){
 $size = 10;
 $history = true; }
  $data = [];
 if($size == 10){
 $data = $Chat->select('*',array("OR" => array("AND" => array("uid1" => $uid1,"uid2" => $uid2),"AND #" => array("uid1" => $uid2,"uid2" => $uid1)),'LIMIT' => $size,'ORDER' => 'id DESC'));
  }else{
  $data = $Chat->select('*',["AND" => ["uid1" => $uid2,"uid2" => $uid1],'LIMIT' => $size,'ORDER' => 'id DESC']);
  }		
if(!$history) $Friend->update_int($uid2,$uid1,'-',$size);
if(!$history) M("Chat_count")->update_int(NOW_UID,'-',$size1);
if(!empty($data)){foreach ($data as &$v)$v['time'] = humandate($v['atime']);}
$this->json($data);
}
}

 public function pm(){
$this->check();
 if(IS_POST && IS_AJAX){
  $time = X("post.time");
 $Chat_count = S("Chat_count");
 $c = $Chat_count->find('*',['uid'=>NOW_UID]);
   if(empty($c))return $this->json(array('code'=>400,'info'=>array(),'atime'=>$c['atime'],'ex'=>'no','error_id'=>2));
 if($time == $c['atime'] || $c['c'] == 0)
 return $this->json(array('code'=>400,'info'=>array(),'atime'=>$c['atime'],'error_id'=>3));
 $Friend = S("Friend");
 $data = $Friend->select(['uid2','c'],['AND'=>['uid1'=>NOW_UID,'c[!]'=>0]]);
 if(empty($data))
 $Chat_count->update(['c'=>0],['uid'=>NOW_UID]);
  $this->json(['code'=>200,'info'=>$data,'atime'=>$c['atime']]);
  }
 }
 public function user_info(){
$this->check();
 if(IS_POST && IS_AJAX){
  $uid = intval(X("post.uid"));
 $User = M("User");
 if(!$User->is_id($uid,$this->CacheObj))
 return $this->json(array('code'=>400,'info'=>fy('用户不存在')));
  $user = $User->read($uid,$this->CacheObj);
  return $this->json(array('code'=>200,'info'=>array('user'=>$user['user'],'avatar'=>$user['avatar'])));;
 }
 }
 }