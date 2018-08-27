<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Ajax extends Ysv8 {

 public function __construct() {
 parent::__construct();
 $this->view = 'admin';
 }
 public function userjson(){
 $data = array('error'=>true);
 $uid = intval(X("get.uid"));
 if(!$uid)
 return $this->json(array('error'=>false,'info'=>'缺少用户UID参数'));
 $User = M("User");
 $ud = $User->read($uid,$this->CacheObj);
 if(!$ud)
  return $this->json(array('error'=>false,'info'=>'输入的UID用户不存在')); 
 $data['user'] = $ud['user'];
 $data['avatar'] = bucketd.$ud['avatar']."_150";
 $data['atime_str'] = humandate($ud['atime']);
 $data['threads'] = $ud['threads'];
 $data['posts'] = $ud['posts'];
 $data['group'] = $ud['group'];
 $data['groupname'] = $this->_usergroup[$ud['group']]['name'];
 $data['gold'] = $ud['gold'];
 $data['credits'] = $ud['credits'];
 $data['ps'] = $ud['ps'];
 $data['href'] ='/'. URL('my',$data['user']);
 $data['ol'] = M("Ol")->ol($uid,$this->CacheObj);
 $data['login'] = false;
 if(IS_LOGIN){
 if(NOW_UID != $uid){
 $Friend = M("Friend");
 $data['login'] = true;
 $data['friend_state'] = $Friend->get_state(NOW_UID,$uid);
 }
 }
 return $this->json($data);
 }

 public function useravatar(){
 $user = X("get.user");
 $ud = M("User")->user_read($user,$this->CacheObj,false);
 return $this->json($ud);
 }
 public function clear_mess(){
$this->check();
 $uid=X('post.uid');
if($uid>-1){
if($uid1=S("Friend")->find('c',array('AND'=>array('uid1'=>$uid,'uid2'=>NOW_UID)))){S("Chat_count")->update(array('c'=>0),array('uid'=>NOW_UID));S("Friend")->update(array('c'=>0),array('AND'=>array('uid1'=>$uid,'uid2'=>NOW_UID)));}
S("chat")->delete(array('AND'=>array('uid1'=>$uid,'uid2'=>NOW_UID)));
if($uid2=S("Friend")->find('c',array('AND'=>array('uid1'=>NOW_UID,'uid2'=>$uid)))){ S("Chat_count")->update(array('c'=>0),array('uid'=>$uid));S("Friend")->update(array('c'=>0),array('AND'=>array('uid1'=>NOW_UID,'uid2'=>$uid)));}
S("chat")->delete(array('AND'=>array('uid1'=>NOW_UID,'uid2'=>$uid)));
 M("Chat")->send($uid,NOW_UID,'清空',4);

}else{
 S("Chat_count")->update(array('c'=>0),array('uid'=>NOW_UID));
 S("Friend")->update(array('c'=>0),array('uid2'=>NOW_UID));
 }
 return $this->json(array('error'=>true,'info'=>fy('清空成功')));

 }
 
 public function Downfile(){
$fileid = intval(X("get.id"));
$this->check($this->conf['fgold']);
if(!$fileid) return $this->json(array('error'=>false,'info'=>fy('参数不完整'),'errorid'=>1));
$File = M("File");
if(!$data=$File->read($fileid,$this->CacheObj))  return $this->json(array('error'=>false,'info'=>fy('已删除'),'errorid'=>2));
 if(NOW_UID!=$data['uid']){if ($this->_user['gold']<$this->conf['fgold']){return $this->json(array('error'=>false,'info'=>fy('金币不足'),'errorid'=>3));  }else{
 if($this->conf['fgold']){
 M('User')->up_int(NOW_UID,['gold[-]'=>$this->conf['fgold']],$this->CacheObj);
  M('User')->up_int($data['uid'],['gold[+]'=>ceil($this->conf['fgold']*0.5)],$this->CacheObj);
  }
 }
 
 }

            $this->json(['error'=>true,'info'=>imgcdn.$data['md5name'].'.'.$data['ext']]);
            

    }
 
 
 
}
