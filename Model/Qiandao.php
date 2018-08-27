<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Qiandao extends Model {
public function read($uid,$mcache=false){
if($mcache) if($data=$mcache->get('Qiandao'.$uid)) return $data;
if($data=$this->find('atime',array('uid'=>$uid)) and $mcache) $mcache->set('Qiandao'.$uid,$data);
return $data;
}  
public function up_int($uid,$key,$mcache){
if($mcache) $mcache->rm("Qiandao".$uid);
return $this->update($key,array('uid'=>$uid));
}
}
