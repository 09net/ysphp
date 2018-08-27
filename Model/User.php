<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class User extends Model {
public function up_so($thread_data,$mcache=false){
$getkey=M('Mykey')->get_key($thread_data['user'].' '.$thread_data['ps'],$mcache);
return $this->update(array('so' =>$getkey[0]),array('id'=>$thread_data['id']));  
 } 

 public function read($id,$mcache=false,$size=''){
 if($mcache!=false){if($data=$mcache->get(__CLASS__.$id)){if($size and isset($data[$size])) return  $data[$size]; else return $data;}}
if($data=$this->format_one($this->find('*',array('id'=>$id)),$mcache) and $mcache!=false) $mcache->set(__CLASS__.$id,$data);
if($size and isset($data[$size])) return  $data[$size];else return $data;
 }


public function read_user($user,$mcache=false,$size=''){
 if($mcache!=false){if($data=$mcache->get(md5(__CLASS__.$user))){if($size and isset($data[$size])) return  $data[$size]; else return $data;}}
if($data=$this->format_one($this->find('*',array('user'=>$user)),$mcache) and $mcache!=false) $mcache->set(md5(__CLASS__.$user),$data);
if($size and isset($data[$size])) return  $data[$size];else return $data;
 }
 

public function read_list_user_email($user,$listnum = 10,$mcache=false){
$data = array('LIMIT' => array(0,$listnum));
$data['OR']=array('user[~]'=>$user,'email[~]' => $user,'id'=>$user);
if($mcache!=false) if($data2=$mcache->get('user_rl'.$user)) return $data2;
if($data2=$this->select(array('id','user','avatar','atime','btime','posts','email','threads','credits','gold','follow','fans','group','lang'),$data) and $mcache!=false) $mcache->set('user_rl'.$user,$data2);
return $data2;
 }



public function read_list($pageid , $listnum = 10,$mcache=false){
$data = array('ORDER'=>'btime DESC','LIMIT' => array(0,$listnum));
if($pageid<1) $pageid=ceil(NOW_TIME/300)*300;
$data['AND']=array('lang'=>NOW_LANG,'btime[<]'=>$pageid);
if($mcache!=false) if($data2=$mcache->get('user_rl'.NOW_LANG.$pageid)) return $data2;
if($data2=$this->select(array('id','user','avatar','atime','btime','posts','email','threads','credits','gold','follow','fans','group','lang'),$data) and $mcache!=false) $mcache->set('user_rl'.NOW_LANG.$pageid,$data2);
return $data2;
 }

 
 public function search_list($pageid,$listnum,$key,$mcache=false){
if($mcache!=false) $data2=$mcache->get(md5('su'.$pageid.$key[0]));
if(empty($data2)){$data2=$this->select(array('id','user','avatar','atime','btime','posts','threads','credits','gold','follow','fans','group','lang'),array('LIMIT'=>array($listnum*$pageid,$listnum),'MATCH'=>array('columns'=>array('so'),'keyword'=>$key[0])));
$this->format($data2,$mcache,$key[1]);
if($mcache!=false and $data2) $mcache->set(md5('su'.$pageid.$key[0]),$data2);
}
return $data2;
}
 
 
 
 public function format_one($v,$mcache=false){
 if(!is_array($v)) return $v;
$v['grouptext'] = M("Usergroup")->read($v['group'],$mcache,'name');
 return $v;
}
 public function user_read($user,$mcache=false,$size=''){
 if($mcache!=false) if($data=$mcache->get(md5(__CLASS__.$user))) return $data;
if($data=$this->format_one($this->find(array('id','user','pass','salt','avatar','atime','group','fans','follow','threads','posts','credits','gold','lang','ps'),array('user'=>$user))) and $mcache!=false) $mcache->set(md5(__CLASS__.$user),$data);
if($size and isset($data[$size])) return  $data[$size];
return $data;
 }
 public function email_read($email,$mcache=false){
   if($mcache!=false){if($data=$mcache->get(md5('mysql_email_'.$email))) return $data;}
   if($data=$this->find(array('id','user','etime','salt'),array('email'=>$email)) and $mcache!=false) $mcache->set(md5('mysql_email_'.$email),$data);
    return $data;
 }

 public function is_id($id,$mcache=false){
 return $this->read($id,$mcache,'id');
 }
  public function uid_to_user($id,$mcache=false){
 return $this->read($id,$mcache,'user');
 }

 
 public function is_user($user,$mcache=false){
 return $this->user_read($user,$mcache,'id');
 }
 public function is_email($email,$mcache=false){
 return $this->email_read($email,$mcache);
 }
 
 public function add_user($user,$pass,$email,$upuid=0,$group = 3,$gold=0){
 $salt = substr(md5(mt_rand(10000000, 99999999).NOW_TIME), 0, 8);
 $upuid= is_numeric($upuid)?$upuid:0;
 return $this->insert(array(
 'user'=>$user,
 'pass'=>L("User")->md5_md5($pass,$salt),
 'email'=>$email,
 'salt'=>$salt,
 'upuid'=>$upuid,
 'atime'=>NOW_TIME,
  'lang'=>NOW_LANG,
  'btime'=>NOW_TIME,
  'gold'=>$gold,
  'group'=> $GLOBALS['conf']['usergroup']
 ));
 
 }
public function up_int($id,$key,$mcache=false){
if($mcache!=false) $mcache->rm(__CLASS__.$id);
return $this->update($key,array('id'=>$id));
}
public function format(&$thread_list,$mcache=false,$key=false){
 if(empty($thread_list)) return false;
 if($key) {$k1=array();$k2=array();
 foreach ($key as  $value){$k1[]=$value;$k2[]='<b>'.$value.'</b>';}
 }
  foreach ($thread_list as &$v){
 if($key) $v['user']= str_ireplace($k1,$k2,$v['user']);
 }

 }


}
