<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Asktiku extends Model {
private $sqlme	= '*';
public function read($id,$mcache=false){
 if($mcache!=false) $data=$mcache->get(__CLASS__.$id);
if(empty($data)) $data=$this->format_one($this->find($this->sqlme,array('id'=>$id)));
if($mcache!=false and $data) $mcache->set(__CLASS__.$id,$data);
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

if($mcache!=false) $data2=$mcache->get('at'.$uid.'_'.$mode.$fid.NOW_LANG.$pageid);
if(empty($data2)) $data2=$this->select($this->sqlme,$data);
$this->format($data2,$mcache);
if($mcache!=false and $data2) $mcache->set('at'.$uid.'_'.$mode.$fid.NOW_LANG.$pageid,$data2);
return $data2;
 }
 

 

 public function search_list($pageid,$listnum,$key,$mcache=false){
if($mcache!=false) $data2=$mcache->get(md5('ats'.$pageid.$key[0]));
if(empty($data2)) $data2=$this->select($this->sqlme,array('LIMIT'=>array($listnum*$pageid,$listnum),'MATCH'=>array('columns'=>array('so'),'keyword'=>$key[0].' IN NATURAL LANGUAGE MODE')));
$this->format($data2,$mcache,$key[1]);
if($mcache!=false and $data2) $mcache->set(md5('ats'.$pageid.$key[0]),$data2);
return $data2;
}
public function format_one($v,$mcache=false){
 if(!is_array($v)) return $v;
 $User = M("User"); 
$v['user'] = $User->read_size('user',$v['uid'],$mcache);
$v['avatar']=bucketcdn.$User->read_size('ava',$v['uid'],$mcache);

$v['summary'] =  str_replace(array('[op]','[op>','[img]','[/img]','[/u]','[u=','[x]','[/x]',']','{m}'),array('<br>','<br>','<img src="','" />','</a>','<a href=','<u>','</u>','>',bucketcdn),$hash->read($v['hashid'],$mcache));
$v['jxcon'] =preg_replace('/\{m\}([A-Za-z0-9\/]+.(png|jpg|jpeg|gif|bmp|webp))/is','<img src="'.icdn.'upload/'.'$1'.'" />', str_replace(array('[img]','[/img]','[/u]','[u=','[x]','[/x]',']'),array('<img src="','" />','</a>','<a href=','<u>','</u>','>'),$hash->read($v['jx'],$mcache)));


$v['title']=mb_substr(strip_tags($v['summary']), 0,50,'UTF-8');
$items=explode(' ',$v['op']);
foreach($items as $item) $v['opitem'][]=array('hashid'=>$item,'con'=>conkeys($hash->read($item,$mcache)));
shuffle($v['opitem']);
$v['v'] = str_replace('{m}',bucketcdn,$v['v']);
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
 
static $Hash_tmp = array();
$Hash = M("Hash");
 foreach ($thread_list as &$v){
  if(empty($Hash_tmp[$v['hashid']])) $Hash_tmp[$v['hashid']] = $Hash->read($v['hashid'],$mcache); 
$v['summary'] = str_replace(array('[op]','[op>','[img]','[/img]','[/u]','[u=','[x]','[/x]',']','{m}'),array('<br>','<br>','<img src="','" />','</a>','<a href=','<u>','</u>','>',bucketcdn),$Hash_tmp[$v['hashid']]);
$items=explode(' ',$v['op']);
$v['opitem']=array();
foreach($items as $item) $v['opitem'][]=array('hashid'=>$item,'con'=>str_replace(array('[img]','[/img]','[/u]','[u=','[x]','[/x]',']','{m}'),array('<img src="','" />','','','','','',bucketcdn),$Hash->read($item,$mcache)));
$v['v'] = str_replace('{m}',bucketcdn,$v['v']);
 if($key) $v['summary']= str_ireplace($k1,$k2,$v['summary']);
 }

 }




}