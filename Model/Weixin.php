<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Weixin extends Model {
private $sqlme	= '*';

public function openid($id,$mcache=false,$size=''){
//$this->debug();
 if($mcache!=false){if($data=$mcache->get(__CLASS__.$id)){if($size and isset($data[$size])) return  $data[$size]; else return $data;}}
if($data=$this->find('*',array('openid'=>$id)) and $mcache!=false) $mcache->set(__CLASS__.$id,$data);
if($size and isset($data[$size])) return  $data[$size];else return $data;
 }
public function up($arr){
//$this->debug();
$this->update(array('btime' =>NOW_TIME+$arr['expires_in']),array('openid'=>$arr['openid']));  
}
public function in($arr){
//$this->debug();
if($id=$this->insert(array(
 'session_key'=>$arr['session_key'],
 'openid'=>$arr['openid'],
 'btime'=>NOW_TIME+$arr['expires_in'],
 ))){
  $salt = substr(md5(mt_rand(10000000, 99999999).NOW_TIME), 0, 8);
if($uid=S('user')->insert(array(
 'user'=>'wx_'.$id,
 'pass'=>'nono',
 'email'=>'wx_'.$id.'@qq.com',
 'salt'=>$salt,
 'upuid'=>0,
 'atime'=>NOW_TIME,
  'lang'=>NOW_LANG,
  'btime'=>NOW_TIME,
  'gold'=>50,
  'group'=> $GLOBALS['conf']['usergroup']
 ))){$this->update(array('uid' =>$uid),array('id'=>$id));  
 return array('id'=>$id,'uid' =>$uid);
}

}
return false; 
}



}