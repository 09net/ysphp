<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Sl extends Model {
private $sqlme	= array('id','title','mkey','mdes','name', 'img', 'btime', 'name2');
public function in($arr,$mcache=false){
return $this->insert($arr);
}
 
public function read($id,$mcache=false){
 if($mcache!=false) $data=$mcache->get(__CLASS__.$id);
if(empty($data)) $data=$this->find($this->sqlme,array('id'=>$id));
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

public function read_list($pageid , $listnum = 10,$mcache=false){
$data = array('ORDER'=>'btime DESC','LIMIT' => array(0,$listnum));
if($pageid<1) $pageid=ceil(NOW_TIME/300)*300;
$data['AND']=array('lang'=>NOW_LANG,'btime[<]'=>$pageid);
if($mcache!=false) if($data2=$mcache->get('sl'.NOW_LANG.$pageid)) return $data2;
if($data2=$this->select($this->sqlme,$data) and $mcache!=false) $mcache->set('sl'.NOW_LANG.$pageid,$data2);
return $data2;
 }
 





}
