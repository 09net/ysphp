<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Weibo extends Model {
private $sqlme	= '*';

 
public function read($id,$mcache=false){
 if($mcache!=false) $data=$mcache->get(__CLASS__.$id);
if(empty($data)) $data=$this->format_one($this->find($this->sqlme,array('id'=>$id)));
if($mcache!=false and $data) $mcache->set(__CLASS__.$id,$data);
return $data;
 } 
 
 public function so_list($pageid , $key = '',$mcache=false){
$data=array('LIMIT'=>array($pageid*10,10),'MATCH'=>array('columns'=>array('so'),'keyword'=>$key.' IN BOOLEAN MODE'));
if($mcache!=false) if($data2=$mcache->get(md5(__CLASS__.$pageid.'_'.$key))) return $data2;
if($data2=$this->select(array('id', 'fid', 'uid', 'atime', 'btime', 'posts', 'goods', 'nos', 'img', 'mode', 'v', 'state', 'views', 'gold', 'hashid'),$data) and $mcache!=false){$this->format($data2,$mcache);$mcache->set(md5(__CLASS__.$pageid.'_'.$key),$data2);}
return $data2; 
}
 
public function del($id,$mcache=false){
if($mcache) $mcache->rm(__CLASS__.$id);
return  $this->delete(array('id'=>$id));
}
public function up_int($id,$key,$mcache=false){
if($mcache) $mcache->rm(__CLASS__.$id);
return $this->update($key,array('id'=>$id));
} 

public function read_list($pageid , $listnum = 10,$mode=0,$fid = -1,$uid = 0,$mcache=false){
$data = array('ORDER'=>'btime DESC','LIMIT' => array(0,$listnum));
if($pageid<1) $pageid=ceil(NOW_TIME/300)*300;
if($mode>2) $mode=0;
if($fid != -1){/*栏目*/
  if($mode>0) $data['AND']=array('fid'=>$fid,'mode'=>$mode,'btime[<]'=>$pageid);else $data['AND']=array('fid'=>$fid,'btime[<]'=>$pageid);
}elseif($uid != 0){/*UID*/
$data['AND']=array('uid'=>$uid,'btime[<]'=>$pageid);
 
 }else{/*多语言*/
  if($mode>0)  $data['AND']=array('lang'=>NOW_LANG,'mode'=>$mode,'btime[<]'=>$pageid); else $data['AND']=array('lang'=>NOW_LANG,'btime[<]'=>$pageid);
 }

if($mcache!=false) $data2=$mcache->get('wl'.$uid.'_'.$mode.$fid.NOW_LANG.$pageid);
if(empty($data2)) $data2=$this->select($this->sqlme,$data);
$this->format($data2,$mcache);
if($mcache!=false and $data2) $mcache->set('wl'.$uid.'_'.$mode.$fid.NOW_LANG.$pageid,$data2);
return $data2;
 }
 

 

 public function search_list($pageid,$listnum,$key,$mcache=false){
if($mcache!=false) $data2=$mcache->get(md5('wts'.$pageid.$key[0]));
if(empty($data2)) $data2=$this->select($this->sqlme,array('LIMIT'=>array($listnum*$pageid,$listnum),'MATCH'=>array('columns'=>array('so'),'keyword'=>$key[0].' IN NATURAL LANGUAGE MODE')));
$this->format($data2,$mcache,$key[1]);
if($mcache!=false and $data2) $mcache->set(md5('wts'.$pageid.$key[0]),$data2);
return $data2;
}
public function format_one($v,$mcache=false){
 if(!is_array($v)) return $v;
 $User = M("User"); 
$v['summary'] = conkeys(M('Hash')->read($v['hashid'],$mcache));
$v['title']=mb_substr(strip_tags($v['summary']), 0,50,'UTF-8');
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
 static $Hash_tmp = array();
$Hash = M("Hash");
 foreach ($thread_list as &$v){
 if(empty($user_tmp[$v['uid']])) $user_tmp[$v['uid']] = $User->read($v['uid'],$mcache);
 $v['user'] = $user_tmp[$v['uid']]['user'];
 $v['avatar']=$user_tmp[$v['uid']]['avatar'];
 if(empty($Hash_tmp[$v['hashid']])) $Hash_tmp[$v['hashid']] = $Hash->read($v['hashid'],$mcache); 
$v['summary'] = conkeys($Hash_tmp[$v['hashid']]);
 
 if($key) $v['summary']= str_ireplace($k1,$k2,$v['summary']);
 }

 }




}
