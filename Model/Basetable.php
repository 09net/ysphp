<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Basetable extends Model {
private $sqlme	= array('id', 'pid', 'name','val');
public function readname($id,$mcache=false){
if(empty($id)) return fy('未设置'); 
$data=false;
if($mcache!=false) $data=$mcache->get('Basetable'.$id);
if(!empty($data)) return $data;
$data=$this->find('name',array('id'=>$id));
if(!empty($data)) $mcache->set('Basetable'.$id,$data);
return $data;
}

public function read($id,$mcache=false,$size='*'){
if($mcache==false){
if($size=='*'){return $this->find('*',array('id'=>$id));}else{return $this->find($size,array('id'=>$id));}
}else{
$data=$mcache->get('Bt_'.$id);
if(empty($data)){$data=$this->find('*',array('id'=>$id));$mcache->set('Bt_'.$id,$data);}
if($size=='*'){return $data;}else{ if(isset($data[$size])) return $data[$size];}
  }
 return false; 
 
 }
public function getlist($pid,$mcache=false){
if($mcache==false){
$data=$this->select($this->sqlme,array("pid"=>$pid));
return $data;
}else{
$data=$mcache->get('Btl_'.$pid);
if(empty($data)){
$data=$this->select($this->sqlme,array("pid"=>$pid));
$mcache->set('Btl_'.$pid,$data);
}
 return $data;
 }}




}
